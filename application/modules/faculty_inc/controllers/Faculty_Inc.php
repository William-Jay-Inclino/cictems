<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Faculty_Inc extends MY_Controller{

	function __construct(){
		parent::__construct(24.1);
		$this->_data['module'] = 'faculty_inc';
		$this->load->model('mdl_inc');
	}

	function _remap($method, $params = []){
        if ($method != 'index' && $method != 'classes' && $method != 'completion'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function index(){
		$this->_data['module_view'] = 'index';
		echo Modules::run($this->_template, $this->_data);
	}

	function read($data){ 
		$this->mdl_inc->read($data[0], $data[1], $data[2], $data[3], $data[4]);
	}

	function classes($data){
		$this->_data['module_view'] = 'inc_classes';
		$this->_data['studID'] = $data[0];
		$this->_data['record'] = $this->mdl_inc->get_stud_info($data[0]);
		$this->_data['classes'] = $this->mdl_inc->get_inc_classes($data[0]);
		echo Modules::run($this->_template, $this->_data);
	}

	function completion($data){
		$this->_data['module_view'] = 'completion';
		$this->_data['record'] = $this->mdl_inc->get_stud_info($data[1]);
		$this->_data['classes'] = $this->mdl_inc->get_class_info($data[0], $data[1], $data[2]);
		$this->_data['classID'] = $data[0];
		$this->_data['studID'] = $data[1];
		$this->_data['termID'] = $data[2];
		echo Modules::run($this->_template, $this->_data);
	}

	function fail_students($id){
		$this->mdl_inc->fail_students($id[0]);
	}

	function get_grades($id){
		$this->mdl_inc->get_grades($id[0],$id[1]);	
	}

	function comply(){
		$this->mdl_inc->comply();	
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>