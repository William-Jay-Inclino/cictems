<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Profile extends CI_Model{

	function get_user_info(){
		return $this->db->select('fn, mn, ln, dob, sex, cn, address, email')->get_where('users', 'uID = '.$this->session->userdata('uID'), 1)->row();
	}

	function shared_data($termID){
		$data['stud_enrol_status'] = 'Unenrolled';
		
		$data['enrol_status'] = $this->db->select('some_value')->get_where('enrolment_settings', "name = 'status'", 1)->row()->some_value;
		$stud_enrol_status = $this->db->query("SELECT sc.status FROM studclass sc INNER JOIN class c ON sc.classID = c.classID WHERE c.termID = $termID AND sc.studID = (SELECT studID FROM student WHERE uID = ".$this->session->userdata('uID')." LIMIT 1) LIMIT 1")->row();

		if($stud_enrol_status){
			$data['stud_enrol_status'] = $stud_enrol_status->status;
		}
		return $data;
	}
		
	function save(){
		// print_r($_POST); die();
		$data = $this->input->post("data");
		$this->db->update('users', $data, 'uID = '.$this->session->userdata('uID'));
	}


}

?>