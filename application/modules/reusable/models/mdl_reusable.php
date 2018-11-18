<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class mdl_Reusable extends CI_Model{

	
	function get_all_term(&$terms = []){
		$query = $this->db->query('SELECT t.termID, CONCAT(t.schoolYear," ",s.semDesc) AS term FROM term t INNER JOIN semester s ON t.semID=s.semID ORDER BY t.schoolYear DESC,s.semOrder DESC');
		$terms = $query->result();
	}
	
	function search_student($search_value = ''){
		$search_value = strtr($search_value, '_', ' ');
		$search_sel = 'CONCAT(u.fn," ",u.mn," ",u.ln," | ",s.controlNo)';
		$query = $this->db->select('s.studID,'.$search_sel.' AS student')->like($search_sel, "$search_value")->order_by('s.studID','DESC')->get_where('student s,users u','s.uID=u.uID',10);
		echo json_encode($query->result());
	}

}

?>