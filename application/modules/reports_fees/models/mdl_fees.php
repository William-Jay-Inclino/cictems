<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Fees extends CI_Model{

	function populate($termID){
		$data['terms'] = $this->db->query('SELECT t.termID, CONCAT(t.schoolYear," ",s.semDesc) AS term FROM term t INNER JOIN semester s ON t.semID=s.semID ORDER BY t.schoolYear DESC,s.semOrder DESC')->result();

		$data['fees'] = $this->db->get_where('fees', "termID = $termID")->result();

		echo json_encode($data);
	}

	function changeTerm($termID){
		$data['fees'] = $this->db->get_where('fees', "termID = $termID")->result();
		echo json_encode($data);
	}

	function getStudents($feeID){
		$data['students'] = $this->db->query("
				SELECT s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name,c.courseCode,y.yearDesc,sf.payable,sf.receivable
				FROM stud_fee sf 
				INNER JOIN student s ON sf.studID = s.studID 
				INNER JOIN users u ON s.uID = u.uID 
				INNER JOIN year y ON s.yearID = y.yearID 
				INNER JOIN studprospectus sp ON s.studID = sp.studID  
				INNER JOIN prospectus p ON sp.prosID = p.prosID 
				INNER JOIN course c ON p.courseID = c.courseID 
				WHERE sf.feeID = $feeID 
				ORDER BY c.courseCode,y.duration,name ASC   
			")->result();

		$data['amount'] = $this->db->select('amount')->get_where('fees', "feeID = $feeID", 1)->row()->amount;

		echo json_encode($data);
	}

}

?>