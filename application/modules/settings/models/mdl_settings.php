<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Settings extends CI_Model{

	function read(){
		return $this->db->query("
			SELECT userName,userPass,(SELECT some_value FROM enrolment_settings WHERE name = 'enrollment_pw' LIMIT 1) enrolPass 
			FROM users WHERE uID = ".$this->session->userdata('uID')." LIMIT 1
		")->row();
	}

	function save(){
		$output = 0;
		$ok = false;
		$data = $this->input->post("data");

		if(key($data) == 'userName'){
			$sql = $this->db->select('1')->get_where('users', "userName = '".$data['userName']."' AND uID <> ".$this->session->userdata('uID'), 1)->row();
			if($sql){
				$output = 1;
			}else{
				$ok = true;
			}
		}else if(key($data) == 'userPass'){
			$ok = true;
		}

		if($ok){
			$this->db->update('users', $data, 'uID = '.$this->session->userdata('uID'));
		}
		echo $output;
	}

	function save2(){
		$data = $this->input->post("data")['enrolPass'];
		$this->db->update('enrolment_settings', ['some_value'=>$data], "name = 'enrollment_pw'");
	}

	function updatePassword(){
		$code = $this->input->post('code');
		$new_pw = $this->input->post('new_pw');
		$code_from_db = $this->db->select('code')->get_where('resetpass_code', "uID = ".$this->session->userdata('uID'), 1)->row()->code;
		if($code != $code_from_db){
			die('1');
		}
		$this->db->trans_start();
		$this->db->delete('resetpass_code', "uID = ".$this->session->userdata('uID'));
		$this->db->update('users', ['userPass'=>$new_pw], "uID = ".$this->session->userdata('uID'));
		$this->db->trans_complete();
	}

	function populate_form(){
		$data = [];
		$data['email'] = $this->db->select('email')->get_where('users', "uID = ".$this->session->userdata('uID'), 1)->row()->email;
		$code = $this->db->select('code')->get_where('resetpass_code', "uID = ".$this->session->userdata('uID'), 1)->row();
		if($code){
			$data['has_code'] = true;
		}else{
			$data['has_code'] = false;
		}
		return $data;
	}

	function sendCode(){
		$data['uID'] = $this->session->userdata('uID');
		$data['code'] = $this->randomPassword(6);
		$sql = $this->db->select('1')->get_where('resetpass_code', "uID = ".$data['uID'], 1)->row();
		if($sql){
			$this->db->update('resetpass_code', $data, 'uID = '.$this->session->userdata('uID'));
		}else{
			$this->db->insert('resetpass_code', $data);
		}
	}

	function randomPassword($length = 8){
		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	}

}

?>