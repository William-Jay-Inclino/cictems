<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Reusable extends MY_Controller{

	function __construct(){
		parent::__construct(0);
		$this->load->model('mdl_reusable');
	}

	function _remap($method, $params = []){
        $this->prevent_url_access();
        $this->$method($params);
	}

	function get_all_term(){
		$terms = [];
		$this->mdl_reusable->get_all_term($terms);
		echo json_encode($terms);
	}

	function search_student($search_value){
		$this->mdl_reusable->search_student($search_value[0]);
	}

	// function changeTerm($termID){
	// 	$this->db->update('term',['termStat' => 'inactive'], "termStat = 'active'");
	// 	$this->db->update('term',['termStat' => 'active'], "termID = ".$termID[0]);
	// }

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>