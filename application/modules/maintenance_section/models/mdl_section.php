<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Section extends CI_Model{

	private function count_all(){
		$query = $this->db->query("SELECT total FROM counter2 WHERE module = 'section' LIMIT 1");
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
		$data['secName'] = $this->input->post('sec');
		

		$this->check_exist($data,$exist);

		if($exist){
			$output = ['status' => 0];
		}else{
			$data['courseID'] = $this->input->post('course')['courseID'];
			$data['yearID'] = $this->input->post('year')['yearID'];
			$data['semID'] = $this->input->post('sem')['semID'];

			$this->db->insert('section', $data);
			$output = ['status'=> 1,'id'=>$this->db->insert_id()];

			$query = $this->db->query("SELECT 1 FROM counter2 WHERE module = 'section' LIMIT 1");
			$row =  $query->row();
			if($row){
				$this->db->query("UPDATE counter2 SET total = total + 1 WHERE module = 'section'");
			}else{
				$this->db->query("INSERT INTO counter2(module,total) VALUES('section','1')");
			}
		}

		echo json_encode($output);
	}

	function read($option = 's.secName',$search_val = NULL, $page = '1', $per_page = '10'){
		$start = ($page - 1) * $per_page;
		$search_val = strtr($search_val, '_', ' ');
		if(trim($search_val) == ''){
			$query = $this->db->query("
				SELECT s.secID,s.secName,c.courseCode,y.yearDesc,sem.semDesc 
				FROM section s 
				INNER JOIN course c ON s.courseID = c.courseID 
				INNER JOIN year y ON s.yearID = y.yearID 
				INNER JOIN semester sem ON s.semID = sem.semID 
				ORDER BY s.secName ASC
				LIMIT $start, $per_page
			");
			$num_records = $this->count_all();
		}else{
			$query = $this->db->query("
				SELECT s.secID,s.secName,c.courseCode,y.yearDesc,sem.semDesc
				FROM section s 
				INNER JOIN course c ON s.courseID = c.courseID 
				INNER JOIN year y ON s.yearID = y.yearID 
				INNER JOIN semester sem ON s.semID = sem.semID 
				WHERE $option LIKE '%".$search_val."%' 
				ORDER BY s.secName ASC
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
			SELECT s.secID,s.secName, c.courseID, c.courseCode,y.yearID,y.yearDesc,sem.semID,sem.semDesc FROM section s 
			INNER JOIN course c ON s.courseID = c.courseID 
			INNER JOIN year y ON s.yearID = y.yearID 
			INNER JOIN semester sem ON s.semID = sem.semID 
			WHERE s.secID = $id LIMIT 1
		");
		return $query->row();
	}

	function update(){
		$exist = false;
		$id = $this->input->post('id');
		$data['secName'] = $this->input->post('sec');
		
		$this->check_exist($data,$exist,$id);

		if($exist){
			$output = ['status' => 0];
		}else{
			$data['courseID'] = $this->input->post('course')['courseID'];
			$data['yearID'] = $this->input->post('year')['yearID'];
			$data['semID'] = $this->input->post('sem')['semID'];
			$this->db->update('section', $data, "secID = $id");
			$output = ['status' => 1];
		}

		echo json_encode($output);
	}

	function delete($id){
		$this->db->delete('section', 'secID = '.$id);
		$this->db->query("UPDATE counter2 SET total = total - 1 WHERE module = 'section'");
	}

	function check_exist($data,&$exist,$id = NULL){
		if($id == NULL){
			$query = $this->db->query("
				SELECT 1 FROM section WHERE secName = '".$data['secName']."'  LIMIT 1
			");
		}else{
			$query = $this->db->query("
				SELECT 1 FROM section WHERE secID <> $id AND secName = '".$data['secName']."' LIMIT 1
			");
		}
		
		if($query->row()){
			$exist = true;
		}
	}

	function check_form_id($id){
		$query = $this->db->select('1')->get_where('section', 'secID='.$id,1);
		if(!$query->row()){
			show_404();
		}
	}

	function is_safe_delete($id){
		$output = 0;
		$query = $this->db->select('1')->get_where('class', "secID = $id", 1)->row();

		if(!$query){
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


}

?>