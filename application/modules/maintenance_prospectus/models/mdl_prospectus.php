<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Prospectus extends CI_Model{

	private function count_all(){
		$query = $this->db->query("SELECT total FROM counter2 WHERE module = 'prospectus' LIMIT 1");
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
		$data['prosCode'] = $this->input->post('pc');
		$data['prosDesc'] = $this->input->post('desc');
		$data['courseID'] = $this->input->post('course')['courseID'];
		$data['duration'] = $this->input->post('duration');
		$data['effectivity'] = $this->input->post('effect');
		$data['prosType'] = $this->input->post('type')['type'];

		$this->check_exist($data,$exist);

		if($exist){
			$output = ['status' => 0];
		}else{
			$this->db->insert('prospectus', $data);
			$output = ['status'=> 1,'id'=>$this->db->insert_id()];

			$query = $this->db->query("SELECT 1 FROM counter2 WHERE module = 'prospectus' LIMIT 1");
			$row =  $query->row();
			if($row){
				$this->db->query("UPDATE counter2 SET total = total + 1 WHERE module = 'prospectus'");
			}else{
				$this->db->query("INSERT INTO counter2(module,total) VALUES('prospectus','1')");
			}
		}

		echo json_encode($output);
	}

	function read($option = 'prosCode',$search_val = NULL, $page = '1', $per_page = '10'){
		$start = ($page - 1) * $per_page;
		$search_val = strtr($search_val, '_', ' ');
		if(trim($search_val) == ''){
			$query = $this->db->query("
				SELECT p.prosID,p.prosCode,p.prosDesc,c.courseCode,p.effectivity,p.duration,p.prosType
				FROM prospectus p
				INNER JOIN course c ON p.courseID=c.courseID 
				ORDER BY p.prosCode ASC
				LIMIT $start, $per_page
			");
			$num_records = $this->count_all();
		}else{
			$query = $this->db->query("
				SELECT p.prosID,p.prosCode,p.prosDesc,c.courseCode,p.effectivity,p.duration,p.prosType
				FROM prospectus p
				INNER JOIN course c ON p.courseID=c.courseID
				WHERE $option LIKE '%".$search_val."%' 
				ORDER BY p.prosCode ASC
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
			SELECT p.prosID,c.courseID,p.prosCode,p.prosDesc,c.courseCode,p.effectivity,p.duration,p.prosType
			FROM prospectus p
			INNER JOIN course c ON p.courseID=c.courseID 
			WHERE prosID = $id LIMIT 1
		")->row();
		return $query;
	}

	function update(){
		$exist = false;
		$id = $this->input->post('id');
		$data['prosCode'] = $this->input->post('pc');
		$data['prosDesc'] = $this->input->post('desc');
		$data['courseID'] = $this->input->post('course')['courseID'];
		$data['duration'] = $this->input->post('duration');
		$data['effectivity'] = $this->input->post('effect');
		$data['prosType'] = $this->input->post('type')['type'];

		$this->check_exist($data,$exist,$id);

		if($exist){
			$output = ['status' => 0];
		}else{
			$this->db->update('prospectus', $data, "prosID = $id");
			$output = ['status' => 1];
		}

		echo json_encode($output);
	}

	function delete($id){
		$this->db->delete('prospectus', 'prosID = '.$id);
		$this->db->query("UPDATE counter2 SET total = total - 1 WHERE module = 'prospectus'");
	}

	function check_exist($data,&$exist,$id = NULL){
		if($id == NULL){
			$query = $this->db->query("
				SELECT 1 FROM prospectus WHERE prosCode = '".$data['prosCode']."'  LIMIT 1
			");
		}else{
			$query = $this->db->query("
				SELECT 1 FROM prospectus WHERE prosID <> $id AND prosCode = '".$data['prosCode']."' LIMIT 1
			");
		}
		
		if($query->row()){
			$exist = true;
		}
	}

	function check_form_id($id){
		$query = $this->db->select('1')->get_where('prospectus', 'prosID='.$id,1);
		if(!$query->row()){
			show_404();
		}
	}

	function is_safe_delete($id){
		$output = 0;
		$query = $this->db->select('1')->get_where('studprospectus', "prosID = $id", 1)->row();
		$query2 = $this->db->select('1')->get_where('subject', "prosID = $id", 1)->row();

		if(!$query && !$query2){
			$output = 1;
		}

		echo $output;

	}

	function get_courses(){
		$query = $this->db->query("
			SELECT courseID,courseCode FROM course ORDER BY courseCode ASC
		")->result();
		echo json_encode($query);
	}


}

?>