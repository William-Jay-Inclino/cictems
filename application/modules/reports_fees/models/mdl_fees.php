<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Fees extends CI_Model{

	function download($termID, $type){
		switch ($type) {
			case 'paid':
				$students = [];
				$arr = $this->db->query("
					SELECT CONCAT(u.ln,', ',u.fn,' ',u.mn) name, sf.studID,SUM(f.amount) amount
					FROM fees f
					INNER JOIN stud_fee sf ON f.feeID = sf.feeID 
					INNER JOIN student s ON sf.studID = s.studID 
					INNER JOIN users u ON s.uID = u.uID 
					WHERE f.termID = $termID AND f.feeStatus <> 'cancelled'
					GROUP BY s.studID
					HAVING SUM(sf.payable) = 0
					ORDER BY name ASC
				")->result();
				foreach($arr as $stud){
					$fees = $this->db->query("
						SELECT f.feeName,f.amount FROM stud_fee sf INNER JOIN fees f ON sf.feeID = f.feeID 
						WHERE sf.payable = 0 AND f.feeStatus <> 'cancelled' AND sf.studID = ".$stud->studID."
					")->result();
					$students[] = ['student'=>$stud,'fees'=>$fees];
				}
				break;
			
			case 'unpaid':
				$students = [];
				$arr = $this->db->query("
					SELECT CONCAT(u.ln,', ',u.fn,' ',u.mn) name,sf.studID,
					SUM(sf.payable) AS amount
					FROM fees f
					INNER JOIN stud_fee sf ON f.feeID = sf.feeID 
					INNER JOIN student s ON sf.studID = s.studID 
					INNER JOIN users u ON s.uID = u.uID 
					WHERE f.termID = $termID AND f.feeStatus <> 'cancelled'
					GROUP BY s.studID
					HAVING amount > 0
					ORDER BY name ASC
				")->result();
				foreach($arr as $stud){
					$fees = $this->db->query("
						SELECT f.feeName,sf.payable amount FROM stud_fee sf INNER JOIN fees f ON sf.feeID = f.feeID 
						WHERE sf.payable > 0 AND sf.studID = ".$stud->studID."
					")->result();
					$students[] = ['student'=>$stud,'fees'=>$fees];
				}
				break;

			case 'refundable':
				$students = [];
				$arr = $this->db->query("
					SELECT CONCAT(u.ln,', ',u.fn,' ',u.mn) name, sf.studID,
					SUM(sf.receivable) AS amount
					FROM fees f
					INNER JOIN stud_fee sf ON f.feeID = sf.feeID 
					INNER JOIN student s ON sf.studID = s.studID 
					INNER JOIN users u ON s.uID = u.uID 
					WHERE f.termID = $termID
					GROUP BY s.studID
					HAVING amount > 0
					ORDER BY name ASC
				")->result();
				foreach($arr as $stud){
					$fees = $this->db->query("
						SELECT f.feeName,sf.receivable amount FROM stud_fee sf INNER JOIN fees f ON sf.feeID = f.feeID 
						WHERE sf.receivable > 0 AND sf.studID = ".$stud->studID."
					")->result();
					$students[] = ['student'=>$stud,'fees'=>$fees];
				}
				break;
				default:
				show_404();
		}
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