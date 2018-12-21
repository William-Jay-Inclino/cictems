<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_Prospectus extends MY_Controller{

	function __construct(){
		parent::__construct(18);
		$this->_data['module'] = 'reports_prospectus';
		$this->load->model('mdl_prospectus');
	}
		

	function _remap($method, $params = []){
        if ($method != 'index' && $method != 'download'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function index(){
		$this->_data['module_view'] = 'index';
		$this->_data['data'] = $this->mdl_prospectus->populate();
		echo Modules::run($this->_template, $this->_data);
	}

	function download($prosID){
		$mpdf = new \Mpdf\Mpdf();
		$this->_data['data'] = $this->mdl_prospectus->get_subjects($prosID[0], 'download');
		$this->_data['data2'] = $this->mdl_prospectus->populate($prosID[0]);

		$html = $this->load->view($this->_data['module'].'/download',$this->_data, true);

		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}	

	function updateReport(){
		$this->mdl_prospectus->updateReport();
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