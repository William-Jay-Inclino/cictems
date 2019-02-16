<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_Grade extends MY_Controller{

	function __construct(){
		parent::__construct(20);
		$this->_data['module'] = 'reports_grade';
		$this->load->model('mdl_grade');
	}
		

	function _remap($method, $params = []){
        if ($method != 'index' && $method != 'by_class' && $method != 'download_by_prospectus' && $method != 'download_by_class'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function index($data = NULL){
		$this->_data['studID'] = ($data == NULL) ? 0 : $data[0];
		$this->_data['module_view'] = 'index';
		echo Modules::run($this->_template, $this->_data);
	}

	function by_class($id){
		$this->_data['module_view'] = 'by_class';
		$this->_data['studID'] = $this->mdl_grade->check_id($id[0]);
		echo Modules::run($this->_template, $this->_data);
	}

	function download_by_prospectus($data){
		$mpdf = new \Mpdf\Mpdf();
		$this->_data['data'] = $this->mdl_grade->download_by_prospectus($data[0]);
		$this->_data['student'] = $this->mdl_grade->get_student($data[0], 'dl');
		$this->_data['data2'] = $this->mdl_grade->populate($data[0]);
		$html = $this->load->view($this->_data['module'].'/download',$this->_data, true);

		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function download_by_class($data){
		$mpdf = new \Mpdf\Mpdf();
		$this->_data['data'] = $this->mdl_grade->download_by_class($data[0],$data[1],$data[2]);
		$this->_data['student'] = $this->mdl_grade->get_student($data[1], 'dl');
		if($data[2] == 'tg'){$view = 'termgrade';}
		else if($data[2] == 'pr'){$view = 'prelim';}
		else if($data[2] == 'md'){$view = 'midterm';}
		else if($data[2] == 'sf'){$view = 'prefi';}
		else if($data[2] == 'f'){$view = 'finals';}
		else if($data[2] == 'rc'){$view = 'reportcard';}
		else{show_404();}

		$html = $this->load->view($this->_data['module'].'/'.$view,$this->_data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	// function download($data){
	// 	$mpdf = new \Mpdf\Mpdf();
	// 	$this->_data['data'] = $this->mdl_grade->download($data[0],$data[1]);
	// 	$this->_data['student'] = $this->mdl_grade->get_student($data[1], 'dl');
	// 	if($data[0] == 'download-by-prospectus'){
	// 		$this->_data['data2'] = $this->mdl_grade->populate($data[1]);
	// 		$view = 'download';
	// 	}else{
	// 		if($data[2] == 'tg'){$view = 'termgrade';}
	// 		else if($data[2] == 'pr'){$view = 'prelim';}
	// 		else if($data[2] == 'md'){$view = 'midterm';}
	// 		else if($data[2] == 'sf'){$view = 'prefi';}
	// 		else if($data[2] == 'f'){$view = 'finals';}
	// 		else if($data[2] == 'rc'){$view = 'reportcard';}
	// 		else{show_404();}
	// 	}

	// 	$html = $this->load->view($this->_data['module'].'/'.$view,$this->_data, true);

	// 	$mpdf->WriteHTML($html);
	// 	$mpdf->Output();
	// }

	function get_grade_by_pros($data){
		$this->mdl_grade->get_grade_by_pros($data[0]);
	}

	function get_grade_by_class($data){
		$this->mdl_grade->get_grade_by_class($data[0],$data[1]);
	}

	function get_student($studID){
		$this->mdl_grade->get_student($studID[0]);
	}

	function search($value){
		$this->mdl_grade->search($value[0]);
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>