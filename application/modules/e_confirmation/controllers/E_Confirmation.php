<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class E_Confirmation extends MY_Controller{

	function __construct(){
		parent::__construct(25);
		$this->_data['module'] = 'e_confirmation';
		$this->load->model('mdl_e_confirmation');
	}

	function _remap($method, $params = []){
        if ($method != 'index' && $method != 'show'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function index(){
		$this->_data['module_view'] = 'index';
		echo Modules::run($this->_template, $this->_data);
	}

	function read($data){ 
		$this->mdl_e_confirmation->read($data[0], $data[1], $data[2], $data[3],$this->_data['current_term']->termID);
	}
	
	function show($studID){
		$this->_data['module_view'] = 'show';
		$this->_data['studID'] = $studID[0];
		$this->_data['student'] = $this->mdl_e_confirmation->get_student($studID[0],$this->_data['current_term']->termID);
		$this->_data['records'] = $this->mdl_e_confirmation->get_classes($studID[0],$this->_data['current_term']->termID);
		echo Modules::run($this->_template, $this->_data);
	}

	function set_enrolled(){
		$this->mdl_e_confirmation->set_enrolled($this->_data['current_term']->termID);
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>