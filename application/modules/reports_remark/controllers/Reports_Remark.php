<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_Remark extends MY_Controller{

	function __construct(){
		parent::__construct(20.5);
		$this->_data['module'] = 'reports_remark';
		$this->load->model('mdl_remark');
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

	function get_class_list($data){
		$this->mdl_remark->get_class_list($data[0]);
	}

	function fetchStudents($ids){
		$this->mdl_remark->fetchStudents($ids[0],$ids[1]);
	}

	function fetchStudents_by_course($ids){
		$this->mdl_remark->fetchStudents_by_course($ids[0],$ids[1],$ids[2]);
	}

	function fetchCourses(){
		$this->mdl_remark->fetchCourses();
	}

	function fetchClass($ids){
		$this->mdl_remark->fetchClass($ids[0],$ids[1]);
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>