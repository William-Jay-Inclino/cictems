<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_E_Confirmation extends CI_Model{

	private function count_all(){
		$query = $this->db->query("SELECT total FROM counter2 WHERE module = 'enrol_requests' LIMIT 1");
		$rs = $query->row();
		if($rs){
			return $rs->total;
		}else{
			return 0;
		}
	}

	function read($option = 's.controlNo',$search_val = NULL, $page = '1', $per_page = '10', $termID){
		$start = ($page - 1) * $per_page;
		$search_val = strtr($search_val, '_', ' ');
		if(trim($search_val) == ''){
			$query = $this->db->query("
				SELECT DISTINCT s.studID,y.yearDesc,s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name,c.courseCode
				FROM studclass sc 
				INNER JOIN student s ON sc.studID = s.studID 
				INNER JOIN class ON sc.classID = class.classID 
				INNER JOIN year y ON s.yearID = y.yearID 
				INNER JOIN studprospectus sp ON s.studID = sp.studID 
				INNER JOIN prospectus p ON sp.prosID = p.prosID 
				INNER JOIN course c ON p.courseID = c.courseID
				INNER JOIN users u ON s.uID = u.uID
				WHERE class.termID = $termID AND sc.status = 'Pending'
				LIMIT $start, $per_page
			");
			$num_records = $this->count_all();
		}else{
			if($option == 'name'){
				$option = "CONCAT(u.ln,', ',u.fn,' ',u.mn)";
			}
			$query = $this->db->query("
				SELECT DISTINCT s.studID,y.yearDesc,s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name,c.courseCode
				FROM studclass sc 
				INNER JOIN student s ON sc.studID = s.studID 
				INNER JOIN class ON sc.classID = class.classID 
				INNER JOIN year y ON s.yearID = y.yearID 
				INNER JOIN studprospectus sp ON s.studID = sp.studID 
				INNER JOIN prospectus p ON sp.prosID = p.prosID 
				INNER JOIN course c ON p.courseID = c.courseID
				INNER JOIN users u ON s.uID = u.uID
				WHERE class.termID = $termID AND sc.status = 'Pending' AND $option LIKE '%".$search_val."%'
				LIMIT $start, $per_page"
			);
			$num_records = $query->num_rows();
		}
		$output = [
			'total_rows'=> $num_records, 
			'records' => $query->result()
		];
		echo json_encode($output);
	}

	function get_student($studID,$termID){
		$student = $this->db->query("
			SELECT CONCAT(u.ln,', ',u.fn,' ',u.mn) student FROM studclass sc
			INNER JOIN student s ON sc.studID = s.studID 
			INNER JOIN class ON sc.classID = class.classID 
			INNER JOIN users u ON s.uID = u.uID
			WHERE class.termID = $termID AND sc.status = 'Pending' AND sc.studID = $studID LIMIT 1
		")->row();
		if(!$student){
			show_404();
		}
		return $student->student;
	}

	function get_classes($studID, $termID){
		return $this->db->select("c.classCode,s.lec,s.lab,(s.lec + s.lab) units,s.subDesc,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time")
			->join('class c','sc.classID = c.classID')
			->join('subject s','c.subID = s.subID')
			->join('day d','c.dayID = d.dayID')
			->get_where('studclass sc', "sc.studID = $studID AND c.termID = $termID")->result();
	}

	function set_enrolled($termID){
		$studID = $this->input->post('studID');
		$this->db->trans_start();
		$this->db->query("UPDATE studclass INNER JOIN class ON studclass.classID = class.classID SET studclass.status = 'Enrolled' WHERE studID = $studID AND termID = $termID");
		$this->db->query("UPDATE counter2 SET total = total - 1 WHERE module = 'enrol_requests'");
		$this->db->query("UPDATE counter SET total = total + 1 WHERE module = 'enrol_studs' AND termID = $termID");
		$this->db->trans_complete();
	}

}

?>