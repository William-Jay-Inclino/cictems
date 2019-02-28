<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_Fees extends MY_Controller{

	function __construct(){
		parent::__construct(21);
		$this->_data['module'] = 'reports_fees';
		$this->load->model('mdl_fees');
	}
		

	function _remap($method, $params = []){
        if ($method != 'index' && $method != 'download'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function index(){
		$this->_data['module_view'] = 'index';
		$this->_data['date_updated'] = $this->mdl_fees->get_date_updated($this->_data['current_term']->termID);
		echo Modules::run($this->_template, $this->_data);
	}

	function download($data){
		$mpdf = new \Mpdf\Mpdf();
		$this->_data['data'] = $this->mdl_fees->download($data[0],$data[1], $view);
		$this->_data['type'] = $data[1];
		//die(print_r($this->_data['data']));
		$this->_data['date_updated'] = $this->mdl_fees->get_date_updated($data[0], 'download');
		$html = $this->load->view($this->_data['module'].'/'.$view,$this->_data, true);

		$mpdf->WriteHTML($html);
		$mpdf->Output();
		
	}

	function populate($termID){
		$this->mdl_fees->populate($termID[0]);
	}

	function changeTerm($termID){
		$this->mdl_fees->changeTerm($termID[0]);
	}

	function getStudents($feeID){
		$this->mdl_fees->getStudents($feeID[0]);
	}

	function updateSettings(){
		$this->mdl_fees->updateSettings();	
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>