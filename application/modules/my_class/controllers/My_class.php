<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class My_Class extends MY_Controller{

	function __construct(){
		parent::__construct(24);
		$this->_verify_access();
		$this->_data['module'] = 'my_class';
		$this->load->model('mdl_myclass');
	}

	function _remap($method, $params = []){
        if ($method != 'index' && $method != 'class_selected' && $method != 'student_grade' 
        	&& $method != 'update_grade' && $method != 'grade_sheet'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function _verify_access(){
		if($this->_data['roleID'] != 2){
			show_404();
		}
	}

	function index(){
		$this->_data['module_view'] = 'index';
		echo Modules::run($this->_template, $this->_data);
	}

	function grade_sheet($id){
		$this->_data['data'] = $this->mdl_myclass->grade_sheet($id[0],$id[1],$id[2],$id[3]);

		$mpdf = new \Mpdf\Mpdf();

		$html = $this->load->view('classes/grade_sheet',$this->_data, true);

		$mpdf->WriteHTML($html);
		$mpdf->Output();
		
	}

	function get_classes($termID){
		$this->mdl_myclass->get_classes($termID[0]);
	}

	function class_selected($id){
		$this->_data['module_view'] = 'class_selected';
		$this->_data['termID'] = $id[0];
		$this->_data['id'] = $id[1];
		$this->_data['prosID'] = $id[2];
		$this->_data['secID'] = $id[3];
		echo Modules::run($this->_template, $this->_data);
	}

	function saveGrade(){
		$this->mdl_myclass->saveGrade();
	}


	function populate_class_sel($id){
		$this->mdl_myclass->populate_class_sel($id[0],$id[1],$id[2],$id[3]);
	}

	function fetch_Students($classID){
		$this->mdl_myclass->fetch_Students($classID[0]);
	}

	function add_student(){
		$this->mdl_myclass->add_student();	
	}

	function finalized_grade(){
		$this->mdl_myclass->finalized_grade();		
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>