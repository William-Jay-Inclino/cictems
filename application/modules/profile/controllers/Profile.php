<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Profile extends MY_Controller{

	function __construct(){
		parent::__construct(100);
		$this->_data['module'] = 'profile';
		$this->load->model('mdl_profile');
	}

	function _remap($method, $params = []){
        if ($method != 'index'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function index(){
		if($this->_data['roleID'] == 4){
			$this->_data['shared_data'] = $this->mdl_profile->shared_data($this->_data['current_term']->termID);
		}

		$this->_data['module_view'] = 'index';
		$this->_data['record'] = $this->mdl_profile->get_user_info();
		echo Modules::run($this->_template, $this->_data);
	}

	function save(){
		$this->mdl_profile->save();
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>