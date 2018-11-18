<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Grade extends MY_Controller{

	function __construct(){
		parent::__construct(3);
		$this->_data['module'] = 'grade';
		$this->load->model('mdl_grade');
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

	function search_subject($data){
		$this->mdl_grade->search_subject($data[0],$data[1]);
	}

	function set_form($data){
		$this->mdl_grade->set_form($data[0],$data[1]);
	}

	function submit_grade(){
		$this->mdl_grade->submit_grade($this->_data['current_term']->termID);
	}

	function delete_grade(){
		$this->mdl_grade->delete_grade();
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>