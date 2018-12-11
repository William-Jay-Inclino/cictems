<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Fees extends CI_Model{

	function download($termID, $type){
		switch ($type) {
			case 'paid':
				$students = $this->db->query("
					SELECT CONCAT(u.ln,', ',u.fn,' ',u.mn) name
					FROM fees f
					INNER JOIN stud_fee sf ON f.feeID = sf.feeID 
					INNER JOIN student s ON sf.studID = s.studID 
					INNER JOIN users u ON s.uID = u.uID 
					WHERE f.termID = $termID AND f.feeStatus <> 'cancelled'
					GROUP BY sf.sfID
					HAVING SUM(sf.payable) = 0 AND SUM(sf.receivable) = 0
					ORDER BY name ASC
				")->result();
				break;
			
			case 'unpaid':
				$students = $this->db->query("
					SELECT CONCAT(u.ln,', ',u.fn,' ',u.mn) name, 
					SUM(sf.payable) AS amount
					FROM fees f
					INNER JOIN stud_fee sf ON f.feeID = sf.feeID 
					INNER JOIN student s ON sf.studID = s.studID 
					INNER JOIN users u ON s.uID = u.uID 
					WHERE f.termID = $termID AND f.feeStatus <> 'cancelled'
					GROUP BY sf.sfID
					HAVING amount > 0 AND SUM(sf.receivable) = 0
					ORDER BY name ASC
				")->result();
				break;

			default:
				$students = $this->db->query("
					SELECT CONCAT(u.ln,', ',u.fn,' ',u.mn) name, 
					SUM(sf.receivable) AS amount
					FROM fees f
					INNER JOIN stud_fee sf ON f.feeID = sf.feeID 
					INNER JOIN student s ON sf.studID = s.studID 
					INNER JOIN users u ON s.uID = u.uID 
					WHERE f.termID = $termID
					GROUP BY sf.sfID
					HAVING SUM(sf.payable) = 0 AND amount > 0
					ORDER BY name ASC
				")->result();
				break;
		}
		// $students = $this->db->query("
		// 	SELECT s.controlNo,sf.feeID,sf.studID, CONCAT(u.ln,', ',u.fn,' ',u.mn) name,
		// 	(SELECT SUM(payable) FROM stud_fee WHERE feeID = sf.feeID AND studID = sf.studID) total_payable,
		// 	(SELECT SUM(receivable) FROM stud_fee WHERE feeID = sf.feeID AND studID = sf.studID)  total_receivable
		// 	FROM fees f
		// 	INNER JOIN stud_fee sf ON f.feeID = sf.feeID 
		// 	INNER JOIN student s ON sf.studID = s.studID 
		// 	INNER JOIN users u ON s.uID = u.uID 
		// 	WHERE f.termID = $termID
		// ")->result();
		$data['students'] = $students;
		$data['term'] = $this->db->query("SELECT CONCAT(t.schoolYear,' ',s.semDesc) term FROM term t INNER JOIN semester s ON t.semID = s.semID WHERE t.termID = $termID LIMIT 1")->row()->term;
		return $data;

	}

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