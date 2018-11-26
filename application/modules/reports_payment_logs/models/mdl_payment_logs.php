<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Payment_Logs extends CI_Model{

	private function count_all(){
		$query = $this->db->query("SELECT total FROM counter2 WHERE module = 'payment_logs' LIMIT 1");
		$rs = $query->row();
		if($rs){
			return $rs->total;
		}else{
			return 0;
		}
	}

	function populate(){
		//die(print_r($_POST));
		$page = $this->input->post("page");
		$per_page = $this->input->post("per_page");
		$filteredDate = $this->input->post("filteredDate");
		$studID = $this->input->post("studID");

		$start = ($page - 1) * $per_page;

		if($filteredDate || $studID){
			if($filteredDate && !$studID){
				$dateFrom = $this->input->post("filteredDate")['dateFrom'];
				$dateTo = $this->input->post("filteredDate")['dateTo'];

				$records = $this->db->query("
					SELECT s.controlNo,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) student,CONCAT(uu.ln,', ',uu.fn,' ',LEFT(uu.mn,1)) faculty,
					f.feeName,p.paidDate,p.amount,p.action,p.or_number
					FROM payments p
					INNER JOIN student s ON p.studID = s.studID 
					INNER JOIN users u ON s.uID = u.uID 
					INNER JOIN users uu ON p.uID = uu.uID  
					INNER JOIN fees f ON p.feeID = f.feeID 
					WHERE p.paidDate BETWEEN '$dateFrom' AND DATE_ADD('$dateTo', INTERVAL 1 DAY)
					ORDER BY p.paidDate DESC
					LIMIT $start, $per_page
				");
				$data['total_rows'] = $this->db->query("SELECT COUNT(1) total_rows FROM payments WHERE paidDate BETWEEN '$dateFrom' AND DATE_ADD('$dateTo', INTERVAL 1 DAY)")->row()->total_rows;
			}else if(!$filteredDate && $studID){
				$records = $this->db->query("
					SELECT s.controlNo,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) student,CONCAT(uu.ln,', ',uu.fn,' ',LEFT(uu.mn,1)) faculty,
					f.feeName,p.paidDate,p.amount,p.action,p.or_number
					FROM payments p
					INNER JOIN student s ON p.studID = s.studID 
					INNER JOIN users u ON s.uID = u.uID 
					INNER JOIN users uu ON p.uID = uu.uID  
					INNER JOIN fees f ON p.feeID = f.feeID 
					WHERE s.studID = $studID
					ORDER BY p.paidDate DESC
					LIMIT $start, $per_page
				");
				$data['total_rows'] = $this->db->query("SELECT COUNT(1) total_rows FROM payments WHERE studID = $studID")->row()->total_rows;
			}else{
				$dateFrom = $this->input->post("filteredDate")['dateFrom'];
				$dateTo = $this->input->post("filteredDate")['dateTo'];

				$records = $this->db->query("
					SELECT s.controlNo,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) student,CONCAT(uu.ln,', ',uu.fn,' ',LEFT(uu.mn,1)) faculty,
					f.feeName,p.paidDate,p.amount,p.action,p.or_number
					FROM payments p
					INNER JOIN student s ON p.studID = s.studID 
					INNER JOIN users u ON s.uID = u.uID 
					INNER JOIN users uu ON p.uID = uu.uID  
					INNER JOIN fees f ON p.feeID = f.feeID 
					WHERE (p.paidDate BETWEEN '$dateFrom' AND DATE_ADD('$dateTo', INTERVAL 1 DAY)) AND (p.studID = $studID)
					ORDER BY p.paidDate DESC
					LIMIT $start, $per_page
				");
				$data['total_rows'] = $this->db->query("SELECT COUNT(1) total_rows FROM payments WHERE (paidDate BETWEEN '$dateFrom' AND DATE_ADD('$dateTo', INTERVAL 1 DAY)) AND studID = $studID")->row()->total_rows;
			}
		}else{
			$records = $this->db->query("
				SELECT s.controlNo,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) student,CONCAT(uu.ln,', ',uu.fn,' ',LEFT(uu.mn,1)) faculty,
				f.feeName,p.paidDate,p.amount,p.action,p.or_number
				FROM payments  p
				INNER JOIN student s ON p.studID = s.studID 
				INNER JOIN users u ON s.uID = u.uID 
				INNER JOIN users uu ON p.uID = uu.uID  
				INNER JOIN fees f ON p.feeID = f.feeID 
				ORDER BY p.paidDate DESC
				LIMIT $start, $per_page
			");
			$data['total_rows'] = $this->count_all();
		}

			
		$data['records'] = $records->result();
		echo json_encode($data);

	}	
	

}

?>