<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Maintenance_Room extends MY_Controller{

	function __construct(){
		parent::__construct(6);
		$this->_data['module'] = 'maintenance_room';
		$this->load->model('mdl_room');

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
			$this->mdl_room->check_form_id($id[0]);
			$this->_data['record'] = $this->mdl_room->read_one($id[0]);
			$this->_data['module_view'] = 'update_form';
		}
		echo Modules::run($this->_template, $this->_data);
	}

	function show($id){
		$this->_data['module_view'] = 'show';
		$this->_data['record'] = $this->mdl_room->read_one($id[0]);
		echo Modules::run($this->_template, $this->_data);
	}

	function success_page($id){
		$this->_data['module_view'] = 'success';
		$this->_data['record'] = $this->mdl_room->read_one($id[0]);
		echo Modules::run($this->_template, $this->_data);
	}

	function create(){
		$this->mdl_room->create();
	}

	function read($data){ 
		$this->mdl_room->read($data[0], $data[1], $data[2], $data[3]);
	}

	function update(){ //parameter is an array since _remap method is used
		$this->mdl_room->update();
	}

	function delete($id){ //parameter is an array since _remap method is used
		$this->mdl_room->delete($id[0]);
	}

	function fetchSpec(){
		$this->mdl_room->fetchSpec();	
	}

	function populateSpec($id){
		$this->mdl_room->populateSpec($id[0]);		
	}
	
	function is_safe_delete($id){
		$this->mdl_room->is_safe_delete($id[0]);
	}

	function changeStatus(){
		$this->mdl_room->changeStatus();	
	}
	
	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>