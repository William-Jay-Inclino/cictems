<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Maintenance_Term extends MY_Controller{

	function __construct(){
		parent::__construct(5);
		$this->_data['module'] = 'maintenance_term';
		$this->load->model('mdl_term');

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
			$this->mdl_term->check_form_id($id[0]);
			$this->_data['record'] = $this->mdl_term->read_one($id[0]);
			$this->_data['module_view'] = 'update_form';
		}
		echo Modules::run($this->_template, $this->_data);
	}

	function show($id){
		$this->_data['module_view'] = 'show';
		$this->_data['record'] = $this->mdl_term->read_one($id[0]);
		echo Modules::run($this->_template, $this->_data);
	}

	function success_page($id){
		$this->_data['module_view'] = 'success';
		$this->_data['record'] = $this->mdl_term->read_one($id[0]);
		echo Modules::run($this->_template, $this->_data);
	}

	function create(){
		$this->mdl_term->create();
	}

	function read($data){ 
		$this->mdl_term->read($data[0], $data[1], $data[2]);
	}

	function update(){ //parameter is an array since _remap method is used
		$this->mdl_term->update();
	}

	function delete($id){ //parameter is an array since _remap method is used
		$this->mdl_term->delete($id[0]);
	}

	function is_safe_delete($id){
		$this->mdl_term->is_safe_delete($id[0]);
	}

	function set_active($id){
		$this->mdl_term->set_active($id[0]);
	}

	function get_semesters(){
		$this->mdl_term->get_semesters();
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>