<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Room extends CI_Model{

	private function count_all(){
		$query = $this->db->query("SELECT total FROM counter2 WHERE module = 'room' LIMIT 1");
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
		$data['roomName'] = $this->input->post('rn');
		$data['roomLoc'] = $this->input->post('loc');
		$data['capacity'] = $this->input->post('cap');

		$this->check_exist($data,$exist);

		if($exist){
			$output = ['status' => 0];
		}else{
			$this->db->insert('room', $data);
			$output = ['status'=> 1,'id'=>$this->db->insert_id()];

			$query = $this->db->query("SELECT 1 FROM counter2 WHERE module = 'room' LIMIT 1");
			$row =  $query->row();
			if($row){
				$this->db->query("UPDATE counter2 SET total = total + 1 WHERE module = 'room'");
			}else{
				$this->db->query("INSERT INTO counter2(module,total) VALUES('room','1')");
			}
		}

		echo json_encode($output);
	}

	function read($option = 'roomName',$search_val = NULL, $page = '1', $per_page = '10'){
		$start = ($page - 1) * $per_page;
		$search_val = strtr($search_val, '_', ' ');
		if(trim($search_val) == ''){
			$query = $this->db->query("
				SELECT * FROM room 
				ORDER BY roomName ASC
				LIMIT $start, $per_page
			");
			$num_records = $this->count_all();
		}else{
			$query = $this->db->query("
				SELECT * FROM room 
				WHERE $option LIKE '%".$search_val."%' 
				ORDER BY roomName ASC
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
			SELECT * FROM room
			WHERE roomID = $id LIMIT 1
		");
		return $query->row();
	}

	function update(){
		$exist = false;
		$id = $this->input->post('id');
		$data['roomName'] = $this->input->post('rn');
		$data['roomLoc'] = $this->input->post('loc');
		$data['capacity'] = $this->input->post('cap');

		$this->check_exist($data,$exist,$id);

		if($exist){
			$output = ['status' => 0];
		}else{
			$this->db->update('room', $data, "roomID = $id");
			$output = ['status' => 1];
		}

		echo json_encode($output);
	}

	function delete($id){
		$this->db->delete('room', 'roomID = '.$id);
		$this->db->query("UPDATE counter2 SET total = total - 1 WHERE module = 'room'");
	}

	function check_exist($data,&$exist,$id = NULL){
		if($id == NULL){
			$query = $this->db->query("
				SELECT 1 FROM room WHERE roomName = '".$data['roomName']."'  LIMIT 1
			");
		}else{
			$query = $this->db->query("
				SELECT 1 FROM room WHERE roomID <> $id AND roomName = '".$data['roomName']."' LIMIT 1
			");
		}
		
		if($query->row()){
			$exist = true;
		}
	}

	function check_form_id($id){
		$query = $this->db->select('1')->get_where('room', 'roomID='.$id,1);
		if(!$query->row()){
			show_404();
		}
	}

	function is_safe_delete($id){
		$output = 0;
		$query = $this->db->select('1')->get_where('class', "roomID = $id", 1)->row();

		if(!$query){
			$output = 1;
		}

		echo $output;

	}


}

?>