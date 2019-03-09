<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Enrollment extends MY_Controller{

	function __construct(){
		parent::__construct(2);
		$this->_data['module'] = 'enrollment';
		$this->load->model('mdl_enrollment');
	}

	function _remap($method, $params = []){
        if ($method != 'index'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function index(){
		$this->_data['module_view'] = 'index';
		$this->_data['status'] = $this->mdl_enrollment->get_enrolment_status();
		echo Modules::run($this->_template, $this->_data);
	}

	function populate(){
		$this->mdl_enrollment->populate($this->_data['current_term']->termID);
	}

	function search($search_value){
		$this->mdl_enrollment->search($search_value[0]);
	}

	function get_enrol_data($studID){
		$this->mdl_enrollment->get_enrol_data($studID[0],$this->_data['current_term']->termID);
	}

	function section_add($ids){
		$this->mdl_enrollment->section_add($ids[0],$ids[1],$this->_data['current_term']->termID);	
	}

	function searchClass($search){
		$this->mdl_enrollment->searchClass($search[0],$search[1],$this->_data['current_term']->termID);
	}

	function addClass(){
		$this->mdl_enrollment->addClass('Unenrolled');
	}

	function deleteClass($id){
		$this->mdl_enrollment->deleteClass($id[0],$id[1], $id[2]);
	}

	function evaluate(){
		$this->mdl_enrollment->evaluate($this->_data['current_term']->termID);
	}

	function set_pending(){
		$this->mdl_enrollment->change_status('Pending', $this->_data['current_term']->termID);
		// if($this->mdl_enrollment->student_is_updated($this->_data['current_term']->termID)){
		// 	$this->mdl_enrollment->change_status('Pending', $this->_data['current_term']->termID);
		// }else{
		// 	echo "You need to update first the yearlevel of student.";
		// }
	}	

	function cancel_pending(){
		$this->mdl_enrollment->change_status('Unenrolled', $this->_data['current_term']->termID);
	}	

	function password(){
		$this->mdl_enrollment->password();
	}

	function set_enrolled(){
		$this->mdl_enrollment->change_status('Enrolled', $this->_data['current_term']->termID);	
	}

	function change_enrolStatus(){
		$this->mdl_enrollment->change_enrolStatus($this->_data['current_term']->termID);
	}

	function updateStudent(){
		$this->mdl_enrollment->updateStudent();	
	}
	// function get_sections(){
	// 	$this->mdl_enrollment->get_sections($this->_data['current_term']->termID);
	// }

	function get_classes($secID){
		$this->mdl_enrollment->get_classes($this->_data['current_term']->termID, $secID[0]);
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>