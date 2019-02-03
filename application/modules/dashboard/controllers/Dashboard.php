<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Dashboard extends MY_Controller{

	function __construct(){
		parent::__construct(0);
		$this->_data['module'] = 'dashboard';
		$this->load->model('mdl_dashboard');
	}

	function _remap($method, $params = []){
        if ($method != 'index'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function index(){
		if($this->_data['roleID'] == 1){
			$view = 'admin';
			$this->_data['data'] = $this->mdl_dashboard->populate($this->_data['current_term']->termID);
		}else if($this->_data['roleID'] == 2){
			$view = 'faculty';
		}else if($this->_data['roleID'] == 3){
			$view = 'staff';
		}else if($this->_data['roleID'] == 4){
			// $view = 'student';
			redirect(base_url().'student/dashboard');
		}
		$this->_data['module_view'] = $view;
		echo Modules::run($this->_template, $this->_data);
	}

	function get_subjects(){
		$this->mdl_dashboard->get_subjects($this->_data['current_term']->termID);
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>