<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_Student extends MY_Controller{

	function __construct(){
		parent::__construct(19);
		$this->_data['module'] = 'reports_student';
		$this->load->model('mdl_student');
		$this->_current_module = 19;
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
		$this->_data['data'] = $this->mdl_student->download($data[0],$data[1],$data[2],$data[3], $this->_data['current_term']->termID);
		$this->_data['course'] = $data[1];
		$html = $this->load->view($this->_data['module'].'/download',$this->_data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function populate($termID){
		$this->mdl_student->populate($termID[0]);
	}

	function fetchData($data){
		$this->mdl_student->fetchData($data[0],$data[1],$data[2]);
	}

	function fetchSubjects($search_value){
		$this->mdl_student->fetchSubjects($search_value[0]);
	}

	function get_students_per_sub($data){
		$this->mdl_student->get_students_per_sub($data[0],$data[1]);	
	}

	function get_students_per_fac($data){
		$this->mdl_student->get_students_per_sub($data[0],$data[1],$data[2]);	
	}

	function get_subjects_of_instructor($data){
		$this->mdl_student->get_subjects_of_instructor($data[0],$data[1]);	
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>