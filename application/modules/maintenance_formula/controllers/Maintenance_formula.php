<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Maintenance_Formula extends MY_Controller{

	function __construct(){
		parent::__construct(12);
		$this->_data['module'] = 'maintenance_formula';
		$this->load->model('mdl_formula');

	}

	function _remap($method, $params = []){
        if ($method != 'index'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function index(){
		$this->_data['module_view'] = 'index';
		$this->_data['percentage'] = $this->mdl_formula->get_percentage();
		echo Modules::run($this->_template, $this->_data);
	}

	function update(){
		$this->mdl_formula->update();
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>