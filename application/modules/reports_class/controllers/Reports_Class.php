<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_Class extends MY_Controller{

	function __construct(){
		parent::__construct(22);
		$this->_data['module'] = 'reports_class';
		$this->load->model('mdl_class_list');
	}
		

	function _remap($method, $params = []){
        if ($method != 'index' && $method != 'download'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function index(){
		$this->_data['module_view'] = 'index';
		echo Modules::run($this->_template, $this->_data);
	}

	function download($data){

		$mpdf = new \Mpdf\Mpdf();
		$this->_data['data'] = $this->mdl_class_list->download($data[0]);
		$this->_data['term'] = $this->mdl_class_list->get_term($data[0]);

		$html = $this->load->view($this->_data['module'].'/download',$this->_data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function populate(){
		$this->mdl_class_list->populate();
	}

	function get_class_list($data){
		$this->mdl_class_list->get_class_list($data[0],$data[1]);
	}


	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>