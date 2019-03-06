<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Term extends CI_Model{

	private function count_all(){
		$query = $this->db->query("SELECT total FROM counter2 WHERE module = 'term' LIMIT 1");
		$rs = $query->row();
		if($rs){
			return $rs->total;
		}else{
			return 0;
		}
	}

	function create(){
		//print_r($_POST);
		$exist = false;
		$data['schoolYear'] = $this->input->post('sy')['sy'];
		$data['semID'] = $this->input->post('sem')['semID'];
		$data['termStat'] = 'inactive';

		$this->check_exist($data,$exist);

		if($exist){
			$output = ['status' => 0];
		}else{
			$this->db->trans_start();

			$this->db->insert('term', $data);
			$insertID = $this->db->insert_id();
			$output = ['status'=> 1,'id'=>$insertID];

			$this->db->insert('counter', ['module'=>'enrol_studs', 'termID'=>$insertID, 'total'=>0]);
			$this->db->insert('reports_date', ['termID'=>$insertID, 'module'=>'enrolled_students', 'updated_at'=>'2000-01-01']);
			$this->db->insert('reports_date', ['termID'=>$insertID, 'module'=>'fees', 'updated_at'=>'2000-01-01']);
			$this->db->insert('reports_date', ['termID'=>$insertID, 'module'=>'class_schedules', 'updated_at'=>'2000-01-01']);

			$this->insert_deans_list_qualifications($insertID);

			$query = $this->db->query("SELECT 1 FROM counter2 WHERE module = 'term' LIMIT 1");
			$row =  $query->row();
			if($row){
				$this->db->query("UPDATE counter2 SET total = total + 1 WHERE module = 'term'");
			}else{
				$this->db->query("INSERT INTO counter2(module,total) VALUES('term','1')");
			}
			$this->db->trans_complete();
		}

		echo json_encode($output);
	}

	function insert_deans_list_qualifications($termID){
		$prevQuals = $this->db->query("
			SELECT * FROM deanslist_reqs WHERE termID = (SELECT termID FROM term WHERE termStat = 'active' LIMIT 1)
		")->result();

		foreach($prevQuals as $pq){
			$data['termID'] = $termID;
			$data['min_units'] = $pq->min_units;
			$data['max_units'] = $pq->max_units;
			$data['min_gwa'] = $pq->min_gwa;
			$data['max_gwa'] = $pq->max_gwa;
			$data['discount'] = $pq->discount;

			$this->db->insert('deanslist_reqs', $data);
		}

	}

	function read($search_val = NULL, $page = '1', $per_page = '10'){
		$start = ($page - 1) * $per_page;
		$search_val = strtr($search_val, '_', ' ');
		if(trim($search_val) == ''){
			$query = $this->db->query("
				SELECT t.termID, t.schoolYear,t.termStat,s.semDesc FROM term t 
				INNER JOIN semester s ON t.semID=s.semID 
				ORDER BY t.schoolYear DESC, s.semOrder DESC
				LIMIT $start, $per_page
			");
			$num_records = $this->count_all();
		}else{
			$query = $this->db->query("
				SELECT t.termID, t.schoolYear,t.termStat,s.semDesc FROM term t 
				INNER JOIN semester s ON t.semID=s.semID 
				WHERE t.schoolYear LIKE '%".$search_val."%' 
				ORDER BY t.schoolYear DESC, s.semOrder DESC
				LIMIT $start, $per_page"
			);
			$num_records = $query->num_rows();
		}
		$output = [
			'total_rows'=> $num_records, 
			'records' => $query->result()
		];
		echo json_encode($output);
	}

	function read_one($id){
		$this->check_form_id($id);

		$query = $this->db->query("
			SELECT t.termID,s.semID, t.schoolYear,t.termStat,s.semDesc FROM term t 
			INNER JOIN semester s ON t.semID=s.semID
			WHERE t.termID = $id LIMIT 1
		");
		return $query->row();
	}

	function update(){
		$exist = false;
		$termID = $this->input->post('id');
		$data['schoolYear'] = $this->input->post('sy')['sy'];
		$data['semID'] = $this->input->post('sem')['semID'];

		$this->check_exist($data,$exist,$termID);

		if($exist){
			$output = ['status' => 0];
		}else{
			$this->db->update('term', $data, "termID = $termID");
			$output = ['status' => 1];
		}

		echo json_encode($output);
	}

	function delete($id){
		$this->db->trans_start();
		$this->db->delete('deanslist_reqs', 'termID = '.$id);
		$this->db->delete('reports_date', 'termID = '.$id);
		$this->db->delete('term', 'termID = '.$id);
		$this->db->query("UPDATE counter2 SET total = total - 1 WHERE module = 'term'");
		$this->db->trans_complete();
	}

	function set_active($id){
		$this->db->update('term',['termStat' => 'inactive'], "termStat = 'active'");
		$this->db->update('term',['termStat' => 'active'], "termID = $id");
	}

	function check_exist($data,&$exist,$termID = NULL){
		if($termID == NULL){
			$query = $this->db->query("
				SELECT schoolYear,semID FROM term WHERE schoolYear = '".$data['schoolYear']."' AND semID = '".$data['semID']."' LIMIT 1
			");
		}else{
			$query = $this->db->query("
				SELECT schoolYear,semID FROM term WHERE schoolYear = '".$data['schoolYear']."' AND semID = '".$data['semID']."' AND termID <> $termID LIMIT 1
			");
		}
		
		if($query->row()){
			$exist = true;
		}
	}

	function check_form_id($id){
		$query = $this->db->select('1')->get_where('term', 'termID='.$id,1);
		if(!$query->row()){
			show_404();
		}
	}

	function is_safe_delete($id){
		$output = 0;
		$stat = $this->db->select('termStat')->get_where('term', "termID = $id", 1)->row()->termStat;

		if($stat == 'inactive'){
			$query = $this->db->select('1')->get_where('class', "termID = $id", 1)->row();
			$query2 = $this->db->select('1')->get_where('fee', "termID = $id", 1)->row();
			$query3 = $this->db->select('1')->get_where('studgrade', "termID = $id", 1)->row();

			if(!$query && !$query3 && !$query2){
				$output = 1;
			}
		}else{
			$output = 2;
		}

		echo $output;

	}

	function get_semesters(){
		$query = $this->db->query("
			SELECT semID,semDesc FROM semester ORDER BY semOrder
		");
		echo json_encode($query->result());
	}


}

?>