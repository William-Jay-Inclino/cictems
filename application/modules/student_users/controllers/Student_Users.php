<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Student_Users extends MY_Controller{

	function __construct(){
		parent::__construct(0);
		$this->_data['module'] = 'student_users';
		$this->load->model('mdl_student_users');
		$this->shared_data();
	}

	function shared_data(){
		$this->_data['shared_data'] = $this->mdl_student_users->shared_data($this->_data['current_term']->termID);
	}

	function index(){
		$this->_data['current_module'] = 0;
		$this->_data['module_view'] = 'index';
		echo Modules::run($this->_template, $this->_data);
	}

	function enrolment(){
		$this->_data['current_module'] = 1;
		$this->_data['module_view'] = 'enrolment';
		$this->_data['data'] = $this->mdl_student_users->get_enrol_status($this->_data['current_term']->termID);
		echo Modules::run($this->_template, $this->_data);
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

	function fees(){
		$this->_data['current_module'] = 6;
		$this->_data['module_view'] = 'fees';
		$this->_data['data'] = $this->mdl_student_users->get_student_fees();
		echo Modules::run($this->_template, $this->_data);
	}

	function payment_logs(){
		$this->_data['current_module'] = 7;
		$this->_data['module_view'] = 'payment_logs';
		echo Modules::run($this->_template, $this->_data);
	}

	function enrolment_populate(){
		$this->mdl_student_users->enrolment_populate($this->_data['current_term']->termID);
	}

	function enrolment_section_add($secID){
		$this->mdl_student_users->enrolment_section_add($secID,$this->_data['current_term']->termID);
	}

	function enrolment_deleteClass($classID){
		$this->mdl_student_users->enrolment_deleteClass($classID);
	}

	function enrolment_get_classes($secID){
		$this->mdl_student_users->enrolment_get_classes($secID,$this->_data['current_term']->termID);
	}

	function enrolment_addClass($classID){
		$this->mdl_student_users->enrolment_addClass($classID);
	}

	function populate_payment_logs(){
		$this->mdl_student_users->populate_payment_logs();
	}

	function populate_class_sched(){
		$this->mdl_student_users->populate_class_sched();
	}

	function get_class_list($termID){
		echo json_encode($this->mdl_student_users->get_class_list($termID));
	}



}

?>