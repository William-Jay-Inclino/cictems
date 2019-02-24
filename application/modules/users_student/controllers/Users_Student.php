<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Users_Student extends MY_Controller{

	function __construct(){
		parent::__construct(14);
		$this->_data['module'] = 'users_student';
		$this->load->model('mdl_student');

	}

	function _remap($method, $params = []){
        if ($method != 'index' && $method != 'form' && $method != 'show' && $method != 'success_page' && $method != 'credit_subjects'){
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
			$this->mdl_student->check_form_id($id[0]);
			$this->_data['record'] = $this->mdl_student->read_one($id[0]);
			$this->_data['module_view'] = 'update_form';
		}
		echo Modules::run($this->_template, $this->_data);
	}

	function show($id){
		//die(phpinfo());
		$this->_data['module_view'] = 'show';
		$this->_data['record'] = $this->mdl_student->read_one($id[0]);
		echo Modules::run($this->_template, $this->_data);
	}

	function success_page($id){
		$this->_data['module_view'] = 'success';
		$this->_data['record'] = $this->mdl_student->read_one($id[0]);
		echo Modules::run($this->_template, $this->_data);
	}

	function credit_subjects($id){
		$this->_data['module_view'] = 'credit_subjects';
		$this->_data['studID'] = $id[0];
		echo Modules::run($this->_template, $this->_data);
	}

	function create(){
		$this->mdl_student->create($this->_data['current_term']->termID);
	}

	function read($data){ 
		$this->mdl_student->read($data[0], $data[1], $data[2], $data[3]);
	}

	function update(){ //parameter is an array since _remap method is used
		$this->mdl_student->update($this->_data['current_term']->termID);
	}

	function delete($id){ //parameter is an array since _remap method is used
		$this->mdl_student->delete($id[0]);
	}

	function is_safe_delete($id){
		$this->mdl_student->is_safe_delete($id[0]);
	}

	function get_courses(){
		$this->mdl_student->get_courses();	
	}

	function get_prospectuses($data){
		$this->mdl_student->get_prospectuses($data[0]);	
	}

	function get_years($data){
		$this->mdl_student->get_years($data[0]);	
	}

	function changeStatus(){
		$this->mdl_student->changeStatus();		
	}

	function get_credited_subjects($studID){
		$this->mdl_student->get_credited_subjects($studID[0]);
	}

	function searchSubjects(){
		$this->mdl_student->searchSubjects();
	}

	function add_credit(){
		$this->mdl_student->add_credit();	
	}

	function remove_credit(){
		$this->mdl_student->remove_credit();	
	}
	
	function sendLogin(){
		$this->mdl_student->sendLogin();	
		
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>