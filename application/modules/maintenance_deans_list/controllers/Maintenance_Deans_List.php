<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Maintenance_Deans_List extends MY_Controller{

	function __construct(){
		parent::__construct(12.5);
		$this->_data['module'] = 'maintenance_deans_list';
		$this->load->model('mdl_deans_list');
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

	function populate($data){
		$this->mdl_deans_list->populate($data[0]);
	}

	function update(){
		$this->mdl_deans_list->update();	
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>