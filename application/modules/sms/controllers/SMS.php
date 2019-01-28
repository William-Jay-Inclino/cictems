<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class SMS extends MY_Controller{

	function __construct(){
		parent::__construct(0);
		$this->_data['module'] = 'sms';
		$this->load->model('mdl_sms');

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

	function sendSMS(){
		$this->mdl_sms->sendSMS();
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>