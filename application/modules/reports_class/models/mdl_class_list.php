<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Class_List extends CI_Model{

	function download($termID){
		$arr = [];

		$sections = $this->db->query("
			SELECT DISTINCT s.secID,s.secName FROM section s 
			INNER JOIN class c ON s.secID = c.secID 
			WHERE c.termID = $termID ORDER BY s.secName ASC
			")->result();

		foreach($sections as $section){
			$classes = $this->db->query("
				SELECT c.classCode,s.subDesc,s.type,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time,r.roomName,CONCAT(u.ln,', ',u.fn) faculty
				FROM class c 
				INNER JOIN subject s ON c.subID = s.subID 
				INNER JOIN room r ON c.roomID = r.roomID 
				INNER JOIN day d ON c.dayID = d.dayID 
				INNER JOIN faculty f ON c.facID = f.facID 
				INNER JOIN users u ON f.uID = u.uID 
				WHERE c.secID = ".$section->secID." AND c.termID = $termID
				ORDER BY c.classID ASC
			")->result();
			$arr[] = ['secName' => $section->secName, 'classes' => $classes];
		}
		return $arr;
	}

	function get_term($termID){
		return $this->db->query("SELECT t.schoolYear, s.semDesc FROM term t INNER JOIN semester s ON t.semID=s.semID WHERE t.termID = $termID LIMIT 1")->row();
	}

	function get_class_list($termID, $val = NULL){
		$arr = [];

		$sections = $this->db->query("
			SELECT DISTINCT s.secID,s.courseID,s.secName FROM section s 
			INNER JOIN class c ON s.secID = c.secID 
			WHERE c.termID = $termID ORDER BY s.secName ASC
		")->result();
		
		
		foreach($sections as $section){
			$classes = $this->db->query("
				SELECT c.classCode,c.roomID,c.facID,s.subDesc,s.type,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time,r.roomName,u.ln,u.fn
				FROM class c 
				INNER JOIN subject s ON c.subID = s.subID 
				INNER JOIN room r ON c.roomID = r.roomID 
				INNER JOIN day d ON c.dayID = d.dayID 
				INNER JOIN faculty f ON c.facID = f.facID 
				INNER JOIN users u ON f.uID = u.uID 
				WHERE c.secID = ".$section->secID." AND c.termID = $termID
				ORDER BY c.classID ASC
			")->result();
			$arr[] = ['secName' => $section->secName,'courseID'=>$section->courseID, 'classes' => $classes];
		}
		if($val == NULL){
			echo json_encode($arr);
		}else{
			return $arr;
		}
		
	}

	function populate(){
		$data['terms'] = $this->db->query('SELECT t.termID, CONCAT(t.schoolYear," ",s.semDesc) term FROM term t INNER JOIN semester s ON t.semID=s.semID ORDER BY t.schoolYear DESC,s.semOrder DESC')->result();
		$data['courses'] = $this->db->query('SELECT courseID,courseCode FROM course ORDER BY courseCode ASC')->result();
		$active_term = $this->db->query("SELECT termID FROM term WHERE termStat = 'active' LIMIT 1")->row()->termID;
		$data['class_list'] = $this->get_class_list($active_term, 1);
		echo json_encode($data);
	}

}

?>