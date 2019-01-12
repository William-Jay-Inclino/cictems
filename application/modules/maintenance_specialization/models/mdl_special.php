<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Special extends CI_Model{

	private function count_all(){
		$query = $this->db->query("SELECT total FROM counter2 WHERE module = 'specialization' LIMIT 1");
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
		$data['specDesc'] = $this->input->post('spec');
		$data['prosID'] = $this->input->post('pros')['prosID'];

		$this->check_exist($data,$exist);

		if($exist){
			$output = ['status' => 0];
		}else{
			$this->db->insert('specialization', $data);
			$output = ['status'=> 1,'id'=>$this->db->insert_id()];

			$query = $this->db->query("SELECT 1 FROM counter2 WHERE module = 'specialization' LIMIT 1");
			$row =  $query->row();
			if($row){
				$this->db->query("UPDATE counter2 SET total = total + 1 WHERE module = 'specialization'");
			}else{
				$this->db->query("INSERT INTO counter2(module,total) VALUES('specialization','1')");
			}
		}

		echo json_encode($output);
	}

	function read($option = 's.specDesc',$search_val = NULL, $page = '1', $per_page = '10'){
		$start = ($page - 1) * $per_page;
		$search_val = strtr($search_val, '_', ' ');
		if(trim($search_val) == ''){
			$query = $this->db->query("
				SELECT s.specID, p.prosCode, s.specDesc 
				FROM specialization s
				INNER JOIN prospectus p ON s.prosID = p.prosID
				ORDER BY p.prosType,p.prosCode ASC
				LIMIT $start, $per_page
			");
			$num_records = $this->count_all();
		}else{
			$query = $this->db->query("
				SELECT s.specID, p.prosCode, s.specDesc 
				FROM specialization s
				INNER JOIN prospectus p ON s.prosID = p.prosID
				WHERE $option LIKE '%".$search_val."%' 
				ORDER BY p.prosType,p.prosCode ASC
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
			SELECT s.specID, s.specDesc, p.prosCode,s.prosID 
			FROM specialization s 
			INNER JOIN prospectus p ON s.prosID = p.prosID 
			WHERE specID = $id LIMIT 1
		");
		return $query->row();
	}

	function update(){
		$exist = false;
		$id = $this->input->post('id');
		$data['specDesc'] = $this->input->post('spec');
		$data['prosID'] = $this->input->post('pros')['prosID'];
		
		$this->check_exist($data,$exist,$id);

		if($exist){
			$output = ['status' => 0];
		}else{
			$this->db->update('specialization', $data, "specID = $id");
			$output = ['status' => 1];
		}

		echo json_encode($output);
	}

	function delete($id){
		$this->db->delete('specialization', 'specID = '.$id);
		$this->db->query("UPDATE counter2 SET total = total - 1 WHERE module = 'specialization'");
	}

	function check_exist($data,&$exist,$id = NULL){
		if($id == NULL){
			$query = $this->db->query("
				SELECT 1 FROM specialization WHERE specDesc = '".$data['specDesc']."' AND prosID = '".$data['prosID']."'  LIMIT 1
			");
		}else{
			$query = $this->db->query("
				SELECT 1 FROM specialization WHERE specID <> $id AND specDesc = '".$data['specDesc']."' AND prosID = '".$data['prosID']."' LIMIT 1
			");
		}
		
		if($query->row()){
			$exist = true;
		}
	}

	function check_form_id($id){
		$query = $this->db->select('1')->get_where('specialization', 'specID='.$id,1);
		if(!$query->row()){
			show_404();
		}
	}

	function is_safe_delete($id){
		$output = 0;
		$query = $this->db->select('1')->get_where('fac_spec', "specID = $id", 1)->row();
		$query2 = $this->db->select('1')->get_where('subject', "specID = $id", 1)->row();
		$query3 = $this->db->select('1')->get_where('room_spec', "specID = $id", 1)->row();

		if(!$query && !$query2 && !$query3){
			$output = 1;
		}

		echo $output;

	}

	function populate(){
		$data['courses'] = $this->db->select('courseID,courseCode')->get('course')->result();
		$data['sems'] = $this->db->select('semID,semDesc')->get('semester')->result();
		echo json_encode($data);
	}

	function fetchYears($courseID){
		echo json_encode(
			$this->db->query("
				SELECT yearID,yearDesc FROM year WHERE duration <= (SELECT duration FROM prospectus WHERE courseID = $courseID LIMIT 1)
			")->result()
		);
	}

	function get_prospectuses(){
		echo json_encode(
			$this->db->query("SELECT prosID, prosCode FROM prospectus ORDER BY prosType, prosCode ASC")->result()
		); 
	}

}

?>