<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_Payment_Logs extends MY_Controller{

	function __construct(){
		parent::__construct(21.5);
		$this->_data['module'] = 'reports_payment_logs';
		$this->load->model('mdl_payment_logs');
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
		$this->_data['data'] = $this->mdl_payment_logs->download($data[0],$data[1],$data[2]);

		$html = $this->load->view($this->_data['module'].'/download',$this->_data, true);

		$mpdf->WriteHTML($html);
		$mpdf->Output();
		
	}

	function populate(){
		$this->mdl_payment_logs->populate();
	}


	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>