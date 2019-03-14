<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Reports_deans_list extends MY_Controller{

	function __construct(){
		parent::__construct(23);
		$this->_data['module'] = 'reports_deans_list';
		$this->load->model('mdl_deans_list');
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

	function populate($data){
		$this->mdl_deans_list->populate($data[0]);
	}

	function download($data){
		// $this->mdl_deans_list->populate($data[0]);
		$mpdf = new \Mpdf\Mpdf();
		$this->_data['data'] = $this->mdl_deans_list->populate($data[0], 'dl');
		$this->_data['term'] = $this->mdl_deans_list->get_term($data[0]);

		$html = $this->load->view($this->_data['module'].'/download',$this->_data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>