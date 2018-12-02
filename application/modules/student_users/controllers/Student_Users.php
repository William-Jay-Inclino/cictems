<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Student_Users extends MY_Controller{

	function __construct(){
		parent::__construct(0);
		$this->_data['module'] = 'student_users';
		$this->load->model('mdl_student_users');
	}

	function my_classes(){
		$this->_data['current_module'] = 2;
		$this->_data['module_view'] = 'my_classes';
		$this->_data['data'] = $this->mdl_student_users->get_student_classes($this->_data['current_term']->termID);
		echo Modules::run($this->_template, $this->_data);
	}

	function class_schedules(){
		$this->_data['current_module'] = 3;
		$this->_data['module_view'] = 'class_schedules';
		echo Modules::run($this->_template, $this->_data);
	}

	function grades_by_prospectus(){
		$this->_data['current_module'] = 4;
		$this->_data['module_view'] = 'grades_by_prospectus';
		$this->_data['data'] = $this->mdl_student_users->get_grades_by_prospectus();
		echo Modules::run($this->_template, $this->_data);
	}

	function grades_by_class(){
		$this->_data['current_module'] = 5;
		$this->_data['module_view'] = 'grades_by_class';
		$this->_data['data'] = $this->mdl_student_users->get_grades_by_class();
		echo Modules::run($this->_template, $this->_data);
	}

	function populate_class_sched(){
		$this->mdl_student_users->populate_class_sched();
	}

	function get_class_list($termID, $courseID){
		$this->mdl_student_users->get_class_list($termID, $courseID);
	}



}

?>