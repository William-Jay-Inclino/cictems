<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Classes extends MY_Controller{

	function __construct(){
		parent::__construct(1);
		$this->_data['module'] = 'classes';
		$this->load->model('mdl_classes');

	}

	function _remap($method, $params = []){
        if ($method != 'index' && $method != 'class_selected' && $method != 'grade_sheet'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function index(){
		$this->_data['module_view'] = 'index';
		//$this->_data['has_class_submitted'] = $this->mdl_classes->has_class_submitted($this->_data['current_term']->termID);
		echo Modules::run($this->_template, $this->_data);
	}

	function class_selected($id){
		$this->_data['module_view'] = 'class_selected';
		$this->_data['facID'] = $id[0];
		$this->_data['termID'] = $id[1];
		$this->_data['id'] = $id[2];
		$this->_data['prosID'] = $id[3];
		$this->_data['secID'] = $id[4];
		echo Modules::run($this->_template, $this->_data);
	}

	function grade_sheet($id){
		// require_once __DIR__ . '/vendor/autoload.php';
		$this->_data['facID'] = $id[0];
		$this->_data['data'] = $this->mdl_classes->grade_sheet($id[0],$id[1],$id[2],$id[3],$id[4]);

		$mpdf = new \Mpdf\Mpdf();

		$html = $this->load->view('classes/grade_sheet',$this->_data, true);

		$mpdf->WriteHTML($html);
		$mpdf->Output();
		
		// $this->load->view('classes/grade_sheet', $this->_data); 
	}

	function saveGrade(){
		$this->mdl_classes->saveGrade();
	}

	function get_faculties(){
		$this->mdl_classes->get_faculties();
	}

	function get_classes($data){
		$this->mdl_classes->get_classes($data[0],$data[1]);
	}

	function populate_class_sel($ids){
		$this->mdl_classes->populate_class_sel($ids[0],$ids[1],$ids[2],$ids[3],$ids[4]);
	}

	// function fetch_Students($classID){
	// 	$this->mdl_classes->fetch_Students($classID[0]);
	// }

	function finalized_grade(){
		$this->mdl_classes->finalized_grade();		
	}
	
	function add_student(){
		$this->mdl_classes->add_student();	
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>