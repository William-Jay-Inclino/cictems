<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Maintenance_Section extends MY_Controller{

	function __construct(){
		parent::__construct(9);
		$this->_data['module'] = 'maintenance_section';
		$this->load->model('mdl_section');

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
			$this->mdl_section->check_form_id($id[0]);
			$this->_data['record'] = $this->mdl_section->read_one($id[0]);
			$this->_data['module_view'] = 'update_form';
		}
		echo Modules::run($this->_template, $this->_data);
	}

	function show($id){
		$this->_data['module_view'] = 'show';
		$this->_data['record'] = $this->mdl_section->read_one($id[0]);
		echo Modules::run($this->_template, $this->_data);
	}

	function success_page($id){
		$this->_data['module_view'] = 'success';
		$this->_data['record'] = $this->mdl_section->read_one($id[0]);
		echo Modules::run($this->_template, $this->_data);
	}

	function create(){
		$this->mdl_section->create();
	}

	function read($data){ 
		$this->mdl_section->read($data[0], $data[1], $data[2], $data[3]);
	}

	function update(){ //parameter is an array since _remap method is used
		$this->mdl_section->update();
	}

	function delete($id){ //parameter is an array since _remap method is used
		$this->mdl_section->delete($id[0]);
	}

	function is_safe_delete($id){
		$this->mdl_section->is_safe_delete($id[0]);
	}

	function populate(){
		$this->mdl_section->populate();	
	}

	function fetchYears($id){
		$this->mdl_section->fetchYears($id[0]);	
	}

	// function get_prospectuses(){
	// 	$this->mdl_section->get_prospectuses();	
	// }

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>