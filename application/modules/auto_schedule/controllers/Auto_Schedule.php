<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Auto_Schedule extends MY_Controller{

	function __construct(){
		parent::__construct(27);
		$this->_data['module'] = 'auto_schedule';
		$this->load->model('mdl_auto_sched');
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
		$this->mdl_auto_sched->populate($termID[0]);
	}

	function createSchedule(){
		$this->mdl_auto_sched->createSchedule();	
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>