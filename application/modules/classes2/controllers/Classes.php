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

	function student_grade($id){
		$this->_data['module_view'] = 'student_grade';
		$this->_data['classID'] = $id[0];
		$this->_data['studID'] = $id[1];
		echo Modules::run($this->_template, $this->_data);
	}

	function update_grade($data){
		$this->_data['module_view'] = 'update_grade';
		$this->_data['grading'] = $data[0];
		$this->_data['classID'] = $data[1];
		echo Modules::run($this->_template, $this->_data);
	}

	function update_by_group(){
		$this->mdl_classes->update_by_group();
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

	function add_student(){
		$this->mdl_classes->add_student();	
	}

	function fetch_stud_data_in_class($ids){
		$this->mdl_classes->fetch_stud_data_in_class($ids[0],$ids[1]);	
	}

	function fetch_Students_in_Class($data){
		$this->mdl_classes->fetch_Students_in_Class($data[0],$data[1]);
	}

	function save_grade(){
		$this->mdl_classes->save_grade();		
	}

	function drop_or_inc(){
		$this->mdl_classes->drop_or_inc();	
	}

	function comply(){
		$this->mdl_classes->comply();	
	}
	function comply2(){
		$this->mdl_classes->comply2();	
	}

	function is_safe_to_remove($ids){
		$this->mdl_classes->is_safe_to_remove($ids[0],$ids[1]);		
	}

	function remove_stud_from_class($ids){
		$this->mdl_classes->remove_stud_from_class($ids[0],$ids[1]);	
	}

	function finalized_grade(){
		$this->mdl_classes->finalized_grade();		
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>