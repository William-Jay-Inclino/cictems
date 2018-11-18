<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class My_Class extends MY_Controller{

	function __construct(){
		parent::__construct(24);
		$this->_verify_access();
		$this->_data['module'] = 'my_class';
		$this->load->model('mdl_myclass');
	}

	function _remap($method, $params = []){
        if ($method != 'index' && $method != 'class_selected' && $method != 'student_grade' 
        	&& $method != 'update_grade'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function _verify_access(){
		if($this->_data['roleID'] != 2){
			show_404();
		}
	}

	function index(){
		$this->_data['module_view'] = 'index';
		echo Modules::run($this->_template, $this->_data);
	}

	function get_classes($termID){
		$this->mdl_myclass->get_classes($termID[0]);
	}

	function class_selected($classID){
		$this->_data['module_view'] = 'class_selected';
		$this->_data['classID'] = $classID[0];
		echo Modules::run($this->_template, $this->_data);
	}

	function saveGrade(){
		$this->mdl_myclass->saveGrade();
	}


	function fetch_Class_Selected($classID){
		$this->mdl_myclass->fetch_Class_Selected($classID[0]);
	}

	function fetch_Students($classID){
		$this->mdl_myclass->fetch_Students($classID[0]);
	}

	function add_student(){
		$this->mdl_myclass->add_student();	
	}

	function finalized_grade(){
		$this->mdl_myclass->finalized_grade();		
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>