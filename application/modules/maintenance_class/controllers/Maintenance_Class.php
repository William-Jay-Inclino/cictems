<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Maintenance_Class extends MY_Controller{

	function __construct(){
		parent::__construct(11);
		$this->_data['module'] = 'maintenance_class';
		$this->load->model('mdl_class_list');

	}

	function _remap($method, $params = []){
        if ($method != 'index' && $method != 'form' && $method != 'show' && $method != 'success_page' && $method != 'batch_success_page' && $method != 'form_batch'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function index($id = NULL){
		$this->_data['secID'] = 0;
		if($id != NULL){
			$this->_data['secID'] = $id[0];
		}
		$this->_data['module_view'] = 'index';
		echo Modules::run($this->_template, $this->_data);
	}

	function form($id = NULL){
		if($id == NULL){
			$this->_data['module_view'] = 'add_form';
		}else{
			$this->mdl_class_list->check_form_id($id[0]);
			$this->_data['record'] = $this->mdl_class_list->read_one($id[0]);
			$this->_data['module_view'] = 'update_form';
		}
		echo Modules::run($this->_template, $this->_data);
	}

	function form_batch($id = NULL){
		if($id == NULL){
			$this->_data['module_view'] = 'batch_add_form';
		}else{
			$this->mdl_class_list->check_form_id($id[0],$id[1]);
			$this->_data['secID'] = $id[0];
			$this->_data['termID'] = $id[1];
			$this->_data['module_view'] = 'batch_update_form';
		}
		echo Modules::run($this->_template, $this->_data);
	}

	function show($id){
		$this->_data['module_view'] = 'show';
		$this->_data['record'] = $this->mdl_class_list->read_one($id[0]);
		echo Modules::run($this->_template, $this->_data);
	}

	function success_page($id){
		$this->_data['module_view'] = 'success';
		$this->_data['record'] = $this->mdl_class_list->read_one($id[0]);
		echo Modules::run($this->_template, $this->_data);
	}

	function batch_success_page($id){
		$this->_data['module_view'] = 'batch_success';
		$this->mdl_class_list->check_form_id($id[0],$id[1]);
		$this->_data['record'] = $this->mdl_class_list->populate_update_batch($id[0],$id[1],'success');
		echo Modules::run($this->_template, $this->_data);
	}

	function checkConflict(){
		$this->mdl_class_list->checkConflict();
	}

	function populate_update_batch($ids){
		$this->mdl_class_list->populate_update_batch($ids[0],$ids[1]);
	}

	function fetchClasses($ids){
		$this->mdl_class_list->fetchClasses($ids[0],$ids[1],$ids[2]);
	}

	function create(){
		$this->mdl_class_list->create();
	}

	function create_batch(){
		$this->mdl_class_list->create_batch();
	}

	function read($data){ 
		$this->mdl_class_list->read($data[0],$data[1]);
	}

	function update(){ //parameter is an array since _remap method is used
		$this->mdl_class_list->update();
	}

	function update_batch(){
		$this->mdl_class_list->update_batch();
	}

	function delete($id){ //parameter is an array since _remap method is used
		$this->mdl_class_list->delete($id[0]);
	}

	function is_safe_delete($class_id){
		$this->mdl_class_list->is_safe_delete($class_id[0]);
	}

	function get_secName($id){
		$this->mdl_class_list->get_secName($id[0]);
	}

	function populate(){
		$this->mdl_class_list->populate();
	}

	function populate2(){
		$this->mdl_class_list->populate2();
	}

	function fetch_YS($prosID){
		$this->mdl_class_list->fetch_YS($prosID[0]);
	}

	function getSections($prosID){
		$this->mdl_class_list->getSections($prosID[0]);	
	}

	function get_subjects($data){
		$this->mdl_class_list->get_subjects($data[0],$data[1]);
	}


	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>