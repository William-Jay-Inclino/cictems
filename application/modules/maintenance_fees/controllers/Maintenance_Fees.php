<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Maintenance_Fees extends MY_Controller{

	function __construct(){
		parent::__construct(13);
		$this->_data['module'] = 'maintenance_fees';
		$this->load->model('mdl_fees');

	}

	function _remap($method, $params = []){
        if ($method != 'index' && $method != 'form' && $method != 'show' && $method != 'success_page' && $method != 'involved_page' && $method != 'transfer_fee'){
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
			$this->mdl_fees->check_form_id($id[0]);
			$this->_data['record'] = $this->mdl_fees->read_one($id[0]);
			$this->_data['module_view'] = 'update_form';
		}
		echo Modules::run($this->_template, $this->_data);
	}

	function show($id){
		$this->_data['module_view'] = 'show';
		$this->_data['record'] = $this->mdl_fees->read_one($id[0]);
		echo Modules::run($this->_template, $this->_data);
	}

	function success_page($id){
		$this->_data['module_view'] = 'success';
		$this->_data['record'] = $this->mdl_fees->read_one($id[0]);
		echo Modules::run($this->_template, $this->_data);
	}

	function involved_page($id){
		$this->_data['module_view'] = 'involved';
		$this->_data['record'] = $this->mdl_fees->read_one($id[0]);
		echo Modules::run($this->_template, $this->_data);
	}

	function transfer_fee($id){
		$this->_data['module_view'] = 'transfer_fee';
		$this->_data['record'] = $this->mdl_fees->read_one($id[0]);
		echo Modules::run($this->_template, $this->_data);
	}

	function create(){
		$this->mdl_fees->create();
	}

	function read($data){ 
		$this->mdl_fees->read($data[0], $data[1], $data[2], $data[3]);
	}

	function update(){ //parameter is an array since _remap method is used
		$this->mdl_fees->update();
	}

	function delete($id){ //parameter is an array since _remap method is used
		$this->mdl_fees->delete($id[0],$id[1]);
	}

	function is_safe_delete($id){
		$this->mdl_fees->is_safe_delete($id[0]);
	}

	function populate($id){
		$this->mdl_fees->populate($id[0]);	
	}

	function generateFilter(){
		$this->mdl_fees->generateFilter();			
	}

	function search_student($data){
		$this->mdl_fees->search_student($data[0],$data[1]);
	}

	function addStudents(){
		$this->mdl_fees->addStudents();	
	}

	function removeStud(){
		$this->mdl_fees->removeStud();		
	}

	function removeFilter(){
		$this->mdl_fees->removeFilter();		
	}

	function cancelPayment($id){
		$this->mdl_fees->cancelPayment($id[0]);			
	}

	function populate_transfer_fee($id){
		$this->mdl_fees->populate_transfer_fee($id[0],$id[1]);				
	}

	function transferFee(){
		$this->mdl_fees->transferFee();					
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>