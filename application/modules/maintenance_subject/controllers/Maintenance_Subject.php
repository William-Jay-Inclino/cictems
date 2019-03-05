<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Maintenance_Subject extends MY_Controller{

	function __construct(){
		parent::__construct(10);
		$this->_data['module'] = 'maintenance_subject';
		$this->load->model('mdl_subject');

	}

	function _remap($method, $params = []){
        if ($method != 'index' && $method != 'form' && $method != 'show' && $method != 'success_page'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function index(){
		$this->_data['module_view'] = 'index';
		echo Modules::run($this->_template, $this->_data);
	}

	function form($id = NULL){
		if($id == NULL){
			$this->_data['module_view'] = 'add_form';
		}else{
			$this->mdl_subject->check_form_id($id[0],$id[1]);
			$this->_data['records'] = $this->mdl_subject->read_one($id[0],$id[1]);
			$this->_data['module_view'] = 'update_form';
			$this->_data['id'] = $id[0];
			$this->_data['prosID'] = $id[1];
		}
		echo Modules::run($this->_template, $this->_data);
	}

	function show($id){
		$this->_data['module_view'] = 'show';
		$this->_data['id'] = $id[0];
		$this->_data['prosID'] = $id[1];
		echo Modules::run($this->_template, $this->_data);
	}

	function success_page($id){
		$this->_data['module_view'] = 'success';
		$this->_data['records'] = $this->mdl_subject->read_one($id[0],$id[1]);
		echo Modules::run($this->_template, $this->_data);
	}

	function create(){
		$this->mdl_subject->create();
	}

	function read($data){ 
		$this->mdl_subject->read($data[0], $data[1], $data[2], $data[3]);
	}

	function update(){ //parameter is an array since _remap method is used
		$this->mdl_subject->update();
	}

	function delete($id){ //parameter is an array since _remap method is used
		$this->mdl_subject->delete($id[0]);
	}

	function is_safe_delete($ids){
		$this->mdl_subject->is_safe_delete($ids[0],$ids[1]);
	}

	function get_prospectuses(){
		$this->mdl_subject->get_prospectuses();	
	}

	function get_years($data){
		$this->mdl_subject->get_years($data[0]);	
	}

	function get_semesters(){
		$this->mdl_subject->get_semesters();	
	}

	function get_reqs($data){
		$this->mdl_subject->get_reqs($data[0],$data[1],$data[2],$data[3]);		
	}

	function get_requisites($data){
		$this->mdl_subject->get_requisites($data[0]);		
	}

	function fetchYearReq($data){
		$this->mdl_subject->fetchYearReq($data[0]);		
	}

	function populate($id){
		$this->mdl_subject->populate($id[0]);			
	}

	function populate2(){
		$this->mdl_subject->populate2();			
	}

	function save_unit($data){
		$this->mdl_subject->save_unit($data[0],$data[1]);				
	}

	function save_hr($data){
		$this->mdl_subject->save_hr($data[0],$data[1]);					
	}

	function populateShow($ids){
		$this->mdl_subject->populateShow($ids[0],$ids[1]);					
	}

	function saveAddUnit(){
		$this->mdl_subject->saveAddUnit();						
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>