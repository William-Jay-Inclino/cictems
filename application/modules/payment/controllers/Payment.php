<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Payment extends MY_Controller{

	function __construct(){
		parent::__construct(4);
		$this->_data['module'] = 'payment';
		$this->load->model('mdl_payment');
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

	function populate($id){
		$this->mdl_payment->populate($id[0]);
	}

	function collectPayment(){
		$this->mdl_payment->collectPayment();
	}

	function refundPayment(){
		$this->mdl_payment->refundPayment();
	}	

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>