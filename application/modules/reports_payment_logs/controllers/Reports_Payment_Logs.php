<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_Payment_Logs extends MY_Controller{

	function __construct(){
		parent::__construct(21.5);
		$this->_data['module'] = 'reports_payment_logs';
		$this->load->model('mdl_payment_logs');
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
		$this->mdl_payment_logs->populate($termID[0]);
	}

	function changeTerm($termID){
		$this->mdl_payment_logs->changeTerm($termID[0]);
	}

	function getStudents($feeID){
		$this->mdl_payment_logs->getStudents($feeID[0]);
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>