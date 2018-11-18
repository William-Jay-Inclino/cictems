<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Registration extends MY_Controller{

	function __construct(){
		parent::__construct(16.5);
		$this->_data['module'] = 'registration';
		$this->load->model('mdl_registration');
	}

	function _remap($method, $params = []){
        if ($method != 'index' && $method != 'show'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function index(){
		$this->_data['module_view'] = 'index';
		echo Modules::run($this->_template, $this->_data);
	}

	function read($data){ 
		$this->mdl_registration->read($data[0], $data[1], $data[2], $data[3]);
	}

	function delete($id){
		$this->mdl_registration->delete($id[0]);	
	}
	
	function show($id){
		$this->_data['module_view'] = 'show';
		$this->_data['record'] = $this->mdl_registration->read_one($id[0]);
		echo Modules::run($this->_template, $this->_data);
	}

	function is_ok_confirm($id){
		$this->mdl_registration->is_ok_confirm($id[0]);
	}

	function confirmRequest($id){
		$this->mdl_registration->confirmRequest($id[0]);
	}

	function fetchStudents($id){
		$this->mdl_registration->fetchStudents($id[0]);
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>