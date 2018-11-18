<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Profile extends CI_Model{

	function get_user_info(){
		return $this->db->select('fn, mn, ln, dob, sex, cn, address, email')->get_where('users', 'uID = '.$this->session->userdata('uID'), 1)->row();
	}

	function save(){
		// print_r($_POST); die();
		$data = $this->input->post("data");
		$this->db->update('users', $data, 'uID = '.$this->session->userdata('uID'));
	}


}

?>