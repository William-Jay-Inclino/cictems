<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_login extends CI_Model{

	function login_validation(){
		$un = $this->input->post('un');  
        $pw = $this->input->post('pw'); 
		$sql = $this->db->select('uID,roleID')->get_where('users', "userName = '$un' AND userPass = '$pw'", 1)->row();
		if($sql){
			$status = $this->db->select('status')->get_where('users', "uID = ".$sql->uID, 1)->row()->status;
			if($status == 'active'){
				$session_data['uID'] = $sql->uID;
	         	$this->session->set_userdata($session_data);  
	         	redirect(base_url() . 'dashboard');
			}else{
				$this->session->set_flashdata('error', 'Unable to login. Your account is inactive!');  
				redirect(base_url() . 'login');	
				// if($sql->is_new == 'yes' && ($sql->roleID == 2 || $sql->roleID == 3)){
				// 	$session_data['uID'] = $sql->uID;
	   //       		$this->session->set_userdata($session_data); 
				// 	redirect(base_url() . 'first-time-login');
				// }else{
				// 	$this->session->set_flashdata('error', 'Unable to login. Your account is inactive!');  
				// 	redirect(base_url() . 'login');	
				// }
			}
		}else{
			$this->session->set_flashdata('error', 'Invalid Username or Password!');  
			redirect(base_url() . 'login');
		}
	}

	// function check_access(){
	// 	$roleID = $this->db->select('roleID')->get_where('users', 'uID = '.$this->session->userdata('uID'), 1)->row()->roleID;
	// 	if(!$this->session->userdata('uID')){
	// 		show_404();
	// 	}
	// 	$is_new = $this->db->select('is_new')->get_where('users','uID = '.$this->session->userdata('uID'), 1)->row()->is_new;
	// 	if($is_new == 'no' || ($roleID != 2 && $roleID != 3)){
	// 		show_404();
	// 	}
	// }

	// function changePass(){
	// 	$np = $this->input->post('np');
	// 	$this->db->update('users',['userPass' => $np, 'is_new' => 'no', 'status' => 'active'], 'uID = '.$this->session->userdata('uID'));
	// 	redirect(base_url() . 'change-password-success');
	// }

	// function get_students($search_value){
	// 	$search_value = strtr($search_value, '_', ' ');
	// 	echo json_encode(
	// 		$this->db->select("s.studID,u.uID, CONCAT(u.ln,', ',u.fn,' ',u.mn) name")->like("CONCAT(u.ln,', ',u.fn,' ',u.mn)", "$search_value")->get_where('student s,users u','s.uID = u.uID',8)->result()
	// 	);

	// }

	// function un_generator($un, $uid = NULL){
	// 	$i = 1;
	// 	while(true){
	// 		if($uid == NULL){
	// 			$is_un_exist = $this->db->select('1')->get_where('registration', "userName = '$un'")->row();
	// 			$is_un_exist2 = $this->db->select('1')->get_where('users', "userName = '$un'")->row();
	// 		}else{
	// 			$is_un_exist = $this->db->select('1')->get_where('registration', "userName = '$un' AND uID <> $uid")->row();
	// 			$is_un_exist2 = $this->db->select('1')->get_where('users', "userName = '$un' AND uID <> $uid")->row();
	// 		}
			

	// 		if($is_un_exist || $is_un_exist2){
	// 			$un = $un.$i;
	// 		}else{
	// 			break;
	// 		}
	// 		++$i;
	// 	}
	// 	return $un;
	// }

	// function submit_registration(){
	// 	$data = $this->input->post('data');
	// 	$sex = '';
	// 	// $is_un_exist = $this->db->select('1')->get_where('registration', "userName = '".$data['userName']."'")->row();
	// 	// $is_un_exist2 = $this->db->select('1')->get_where('users', "userName = '".$data['userName']."'")->row();
	// 	// if($is_un_exist || $is_un_exist2){
	// 	// 	die('1');
	// 	// }
	// 	// while(true){
	// 	// 	$random_code = substr(str_shuffle("0123456789"), 0, 6);
	// 	// 	$is_code_exist = $this->db->select('1')->get_where('registration', "regCode = '$random_code'", 1)->row();
	// 	// 	if(!$is_code_exist){
	// 	// 		break;
	// 	// 	}
	// 	// }

	// 	// $data['regCode'] = $random_code;
		
	// 	if($data['role'] == 'Student'){
	// 		$data['roleID'] = 4;
	// 		$data['uID'] = $data['student']['uID'];
	// 		$sex = $this->db->query("SELECT sex FROM users WHERE uID = ".$data['uID']." LIMIT 1")->row()->sex;
	// 		$sql =  $this->db->select('fn,mn,ln')->get_where('users', 'uID = '.$data['uID'], 1)->row();
	// 		$data['fn'] = $sql->fn;
	// 		$data['mn'] = $sql->mn;
	// 		$data['ln'] = $sql->ln;
	// 		$data['userName'] = $this->un_generator($data['ln'],$data['uID']);
	// 	}else{
	// 		$data['uID'] = 0;
	// 		if($data['role'] == 'Faculty'){
	// 			$data['roleID'] = 2;
	// 		}else if($data['role'] == 'Staff'){
	// 			$data['roleID'] = 3;
	// 		}else if($data['role'] == 'Guardian'){
	// 			$data['userName'] = $this->un_generator($data['ln']);
	// 			$data['roleID'] = 5;
	// 			$students = array_splice($data, 12, 1)['students'];
	// 		}
	// 	}
	// 	array_splice($data, 0, 2);
		
	// 	//die(print_r($data));
	// 	$this->db->trans_start();
	// 	$this->db->insert('registration', $data);
	// 	$regID = $this->db->insert_id();
	// 	if($data['roleID'] == 5){
	// 		foreach($students as $student){
	// 			$this->db->insert('reg_guardian', ['regID'=>$regID, 'studID'=>$student['studID']]);
	// 		}
	// 	}

	// 	$query = $this->db->query("SELECT 1 FROM counter2 WHERE module = 'reg_requests' LIMIT 1");
	// 	$row =  $query->row();
	// 	if($row){
	// 		$this->db->query("UPDATE counter2 SET total = total + 1 WHERE module = 'reg_requests'");
	// 	}else{
	// 		$this->db->query("INSERT INTO counter2(module,total) VALUES('reg_requests','1')");
	// 	}

		
	// 	$this->db->trans_complete();	

	// 	echo json_encode(['output' => 'success','sex'=>$sex, 'un' => $data['userName']]);

	// }
	
}

?>