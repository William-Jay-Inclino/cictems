<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Users_Faculty extends MY_Controller{

	function __construct(){
		parent::__construct(15);
		$this->_data['module'] = 'users_faculty';
		$this->load->model('mdl_faculty');

	}

	function _remap($method, $params = []){
        if ($method != 'index' && $method != 'form' && $method != 'show' && $method != 'success_page' && $method != 'access_rights'){
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
			$this->mdl_faculty->check_form_id($id[0]);
			$this->_data['record'] = $this->mdl_faculty->read_one($id[0],$this->_data['current_term']->termID);
			$this->_data['module_view'] = 'update_form';
		}
		echo Modules::run($this->_template, $this->_data);
	}

	function show($id){
		$this->_data['module_view'] = 'show';
		$this->_data['record'] = $this->mdl_faculty->read_one($id[0],$this->_data['current_term']->termID);
		echo Modules::run($this->_template, $this->_data);
	}

	function success_page($id){
		$this->_data['module_view'] = 'success';
		$this->_data['record'] = $this->mdl_faculty->read_one($id[0],$this->_data['current_term']->termID);
		echo Modules::run($this->_template, $this->_data);
	}

	function access_rights($id){
		$this->_data['module_view'] = 'access_rights';
		$this->_data['record'] = $this->mdl_faculty->read_user($id[0]);
		echo Modules::run($this->_template, $this->_data);
	}

	function create(){
		$this->mdl_faculty->create();
	}

	function read($data){ 
		$this->mdl_faculty->read($data[0], $data[1], $data[2], $data[3], $this->_data['current_term']->termID);
	}

	function update(){ //parameter is an array since _remap method is used
		$this->mdl_faculty->update();
	}
	
	function delete($id){ //parameter is an array since _remap method is used
		$this->mdl_faculty->delete($id[0]);
	}

	function updateAccess(){
		$this->mdl_faculty->updateAccess();
	}

	function is_safe_delete($id){
		$this->mdl_faculty->is_safe_delete($id[0]);
	}

	function changeStatus(){
		$this->mdl_faculty->changeStatus();	
	}

	function fetchSpec(){
		$this->mdl_faculty->fetchSpec();	
	}

	function populateSpec($id){
		$this->mdl_faculty->populateSpec($id[0]);		
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>