<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Settings extends MY_Controller{

	function __construct(){
		parent::__construct(101);
		$this->_data['module'] = 'settings';
		$this->load->model('mdl_settings');
	}

	function _remap($method, $params = []){
        if ($method != 'index' && $method != 'reset_pw_form'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function index(){
		
		if($this->_data['roleID'] == 1){
			$view = 'admin_index';
		}else if($this->_data['roleID'] == 2){
			$view = 'faculty_index';
		}else if($this->_data['roleID'] == 3){
			$view = 'staff_index';
		}
		$this->_data['module_view'] = $view;
		$this->_data['record'] = $this->mdl_settings->read();
		echo Modules::run($this->_template, $this->_data);
	}

	function save(){
		$this->mdl_settings->save();
	}

	function save2(){
		$this->mdl_settings->save2();
	}

	function reset_pw_form(){
		$this->_data['module_view'] = 'reset_pw_form';
		$this->_data['record'] = $this->mdl_settings->populate_form();
		echo Modules::run($this->_template, $this->_data);
	}

	function updatePassword(){
		$this->mdl_settings->updatePassword();
	}

	function sendCode(){
		$this->mdl_settings->sendCode();
	}


	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>