<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Schedule extends MY_Controller{

	function __construct(){
		parent::__construct(26);
		$this->_data['module'] = 'schedule';
		$this->load->model('mdl_schedule');

	}

	function _remap($method, $params = []){
        if ($method != 'index'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function index(){
		$this->_data['module_view'] = 'index';
		echo Modules::run($this->_template, $this->_data);
	}

	function checkConflict(){
		$this->mdl_schedule->checkConflict();
	}

	function populate(){
		$this->mdl_schedule->populate($this->_data['current_term']->termID);
	}

	function fetchYear($prosID){
		$this->mdl_schedule->fetchYear($prosID[0]);
	}

	function fetchClasses($ids){
		$this->mdl_schedule->fetchClasses($ids[0],$ids[1],$ids[2]);
	}

	function get_sec_info($id){
		$this->mdl_schedule->get_sec_info($id[0],$id[1]);
	}

	function get_added_sections($id){
		$this->mdl_schedule->get_added_sections($id[0]);
	}

	function create(){
		$this->mdl_schedule->create();
	}

	function search_subject($data){
		$this->mdl_schedule->search_subject($data[0],$data[1]);	
	}

	function is_safe_delete($classID){
		$this->mdl_schedule->is_safe_delete($classID[0]);	
	}

	function delete($classID){
		$this->mdl_schedule->delete($classID[0]);	
	}

	function add_class_to_section(){
		$this->mdl_schedule->add_class_to_section();		
	}

	function changeSection(){
		$this->mdl_schedule->changeSection();			
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>