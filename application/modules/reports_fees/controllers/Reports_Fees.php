<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_Fees extends MY_Controller{

	function __construct(){
		parent::__construct(21);
		$this->_data['module'] = 'reports_fees';
		$this->load->model('mdl_fees');
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

	function populate($termID){
		$this->mdl_fees->populate($termID[0]);
	}

	function changeTerm($termID){
		$this->mdl_fees->changeTerm($termID[0]);
	}

	function getStudents($feeID){
		$this->mdl_fees->getStudents($feeID[0]);
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>