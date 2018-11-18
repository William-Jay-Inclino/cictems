<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Classes extends MY_Controller{

	function __construct(){
		parent::__construct(1);
		$this->_data['module'] = 'classes';
		$this->load->model('mdl_classes');

	}

	function _remap($method, $params = []){
        if ($method != 'index' && $method != 'class_selected' && $method != 'student_grade' 
        	&& $method != 'update_grade'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function index(){
		$this->_data['module_view'] = 'index';
		//$this->_data['has_class_submitted'] = $this->mdl_classes->has_class_submitted($this->_data['current_term']->termID);
		echo Modules::run($this->_template, $this->_data);
	}

	function class_selected($classID){
		$this->_data['module_view'] = 'class_selected';
		$this->_data['classID'] = $classID[0];
		echo Modules::run($this->_template, $this->_data);
	}

	function saveGrade(){
		$this->mdl_classes->saveGrade();
	}

	function get_faculties(){
		$this->mdl_classes->get_faculties();
	}

	function get_classes($data){
		$this->mdl_classes->get_classes($data[0],$data[1]);
	}

	function fetch_Class_Selected($classID){
		$this->mdl_classes->fetch_Class_Selected($classID[0]);
	}

	function fetch_Students($classID){
		$this->mdl_classes->fetch_Students($classID[0]);
	}

	function finalized_grade(){
		$this->mdl_classes->finalized_grade();		
	}
	
	function add_student(){
		$this->mdl_classes->add_student();	
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>