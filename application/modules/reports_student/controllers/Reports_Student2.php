<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_Student extends MY_Controller{

	function __construct(){
		parent::__construct(19);
		$this->_data['module'] = 'reports_student';
		$this->load->model('mdl_student');
		$this->_current_module = 19;
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

	function populate(){
		$this->mdl_student->populate($this->_data['current_term']->termID);
	}

	function fetchData($data){
		$this->mdl_student->fetchData($data[0],$data[1],$data[2],$data[3],$data[4]);
	}

	function fetchSubjects($search_value){
		$this->mdl_student->fetchSubjects($search_value[0]);
	}

	function fetchStudent_sub($id){
		$this->mdl_student->fetchStudent_sub($id[0], $id[1]);
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>