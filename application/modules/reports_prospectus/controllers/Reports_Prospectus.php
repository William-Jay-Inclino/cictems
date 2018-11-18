<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_Prospectus extends MY_Controller{

	function __construct(){
		parent::__construct(18);
		$this->_data['module'] = 'reports_prospectus';
		$this->load->model('mdl_prospectus');
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

	function get_subjects($data){
		$this->mdl_prospectus->get_subjects($data[0]);
	}

	function get_prospectuses(){
		$this->mdl_prospectus->get_prospectuses();
	}

	function search($value){
		$this->mdl_prospectus->search($value[0]);
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>