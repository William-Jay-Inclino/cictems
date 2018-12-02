<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templates extends MY_Controller {

	function admin($data){
		$this->load->view('admin_template', $data);	
	}

	function faculty($data){
		$this->load->view('faculty_template', $data);	
	}

	function staff($data){
		$this->load->view('staff_template', $data);	
	}

	function student($data){
		$this->load->view('student_template', $data);	
	}

	function outside($data){
		$this->load->view('outside_template', $data);		
	}

}
