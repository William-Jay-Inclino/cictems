<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Staff extends CI_Model{

	private function count_all(){
		$query = $this->db->query("SELECT total FROM counter2 WHERE module = 'staff' LIMIT 1");
		$rs = $query->row();
		if($rs){
			return $rs->total;
		}else{
			return 0;
		}
	}

	function un_generator($un){
		$i = 1;
		while(true){
			$query = $this->db->query("
				SELECT 1 FROM users WHERE userName = '$un' LIMIT 1
			")->row();
			if($query){
				$un = $un.$i;
			}else{
				break;
			}
			++$i;
		}
		return $un;
	}

	function create(){
		$this->get_form_data($data);
		
		$this->db->trans_start();

		$data['userPass'] = substr(str_shuffle("0123456789"), 0, 6);
		$data['userName'] = $this->un_generator($data['ln']);
		$data['roleID'] = 3;
		$this->get_form_data($data);
	
		$this->db->insert('users', $data);

		$data2['uID'] = $this->db->insert_id();
		$this->db->insert('staff', $data2);
		$staffID = $this->db->insert_id();

		$query = $this->db->query("SELECT 1 FROM counter2 WHERE module = 'staff' LIMIT 1");
		$row =  $query->row();
		if($row){
			$this->db->query("UPDATE counter2 SET total = total + 1 WHERE module = 'staff'");
		}else{
			$this->db->query("INSERT INTO counter2(module,total) VALUES('staff','1')");
		}

		//$this->send_mail($data);

		$this->db->trans_complete();

		echo $staffID;
		

	}

	function read($option = 'u.fn',$search_val = NULL, $page = '1', $per_page = '10', $termID){
		$start = ($page - 1) * $per_page;
		$search_val = strtr($search_val, '_', ' ');
		if(trim($search_val) == ''){
			$query = $this->db->query("
				SELECT s.staffID,u.uID,u.is_new,u.status,CONCAT(u.ln,', ',u.fn,' ',u.mn) name
				FROM staff s
				INNER JOIN users u ON s.uID = u.uID
				LIMIT $start, $per_page
			");
			$num_records = $this->count_all();
		}else{
			$query = $this->db->query("
				SELECT s.staffID,u.uID,u.is_new,u.status,CONCAT(u.ln,', ',u.fn,' ',u.mn) name
				FROM staff s
				INNER JOIN users u ON s.uID = u.uID
				WHERE $option LIKE '%".$search_val."%' 
				ORDER BY $option ASC
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

	function read_one($id,$termID){
		$this->check_form_id($id);

		$query = $this->db->query("
			SELECT s.staffID,u.userName,u.fn,u.userPass,u.is_new,u.mn,u.ln,u.dob,u.sex,u.cn,u.email,u.address
			FROM staff s
			INNER JOIN users u ON s.uID = u.uID
			WHERE s.staffID = $id LIMIT 1
		");
		return $query->row();
	}

	function read_user($id){
		$this->check_form_id($id);
		$arr = [];
		$data['staffID'] = $id;
		$data['user'] = $this->db->query("
			SELECT uID,userName,CONCAT(fn,' ',mn,' ',ln) name FROM users WHERE uID = (SELECT uID FROM staff WHERE staffID = $id LIMIT 1) LIMIT 1
		")->row(); 
		$modules = $this->db->query("
			SELECT modID FROM access_rights WHERE uID = ". $data['user']->uID
		)->result();
		foreach($modules as $m){
			$arr[] = $m->modID;
		}
		$data['modules'] = $arr;
		return $data;
	}

	function update(){
		$id = $this->input->post('id');
		$uID = $this->db->query("SELECT uID FROM staff WHERE staffID = $id LIMIT 1")->row()->uID;

		$this->get_form_data($data);
		
		$this->db->update('users', $data, "uID = $uID");

	}

	function updateAccess(){
		$uID = $this->input->post('uID');
		$modID = $this->input->post('modID');
		$sql = $this->db->query("SELECT 1 FROM access_rights WHERE uID = $uID AND modID = $modID LIMIT 1")->row();
		if($sql){
			$this->db->delete('access_rights', "uID = $uID AND modID = $modID");
		}else{
			$this->db->insert('access_rights', ['uID'=>$uID, 'modID'=>$modID]);
		}
	}

	function delete($id){
		$this->db->trans_start();
		$uID = $this->db->select('uID')->get_where('staff', "staffID = $id", 1)->row()->uID;
		$this->db->delete('staff', 'staffID = '.$id);
		$this->db->delete('access_rights', 'uID = '.$uID);
		$this->db->delete('users', 'uID = '.$uID);
		$this->db->query("UPDATE counter2 SET total = total - 1 WHERE module = 'staff'");
		$this->db->trans_complete();
	}

	function get_form_data(&$data){
		$data['email'] = $this->input->post('email');
		$data['fn'] = $this->input->post('fn');
		$data['mn'] = $this->input->post('mn');
		$data['ln'] = $this->input->post('ln');
		$data['dob'] = $this->input->post('dob');
		$data['sex'] = $this->input->post('sex')['sex'];
		$data['address'] = $this->input->post('address');
		$data['cn'] = $this->input->post('cn');

	}
	
	// function check_exist($un, $id = NULL){
	// 	$exist = false;
	// 	if($id == NULL){
	// 		$query = $this->db->query("
	// 			SELECT 1 FROM users WHERE userName = '$un' LIMIT 1
	// 		");
	// 	}else{
	// 		$query = $this->db->query("
	// 			SELECT 1 FROM users WHERE uID <> $id AND userName = '$un' LIMIT 1
	// 		");
	// 	}
		
	// 	if($query->row()){
	// 		$exist = true;
	// 	}
	// 	return $exist;
	// }

	function check_form_id($id){
		$query = $this->db->select('1')->get_where('staff', 'staffID='.$id,1);
		if(!$query->row()){
			show_404();
		}
	}

	function changeStatus(){
		$uID = $this->input->post('uID');
		$data['status'] = $this->input->post('status');
		$this->db->update('users', $data, "uID = $uID");
	}

	// function is_safe_delete($id){
	// 	$output = 0;
	// 	$query = $this->db->select('1')->get_where('class', "facID = $id", 1)->row();

	// 	if(!$query){
	// 		$output = 1;
	// 	}

	// 	echo $output;

	// }

}

?>