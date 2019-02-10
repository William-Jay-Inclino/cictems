<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Class_List extends CI_Model{

	function download($value, $termID, &$view){
		if($value == 'faculty'){
			$view = 'download_faculty';
			return $this->get_faculty_list($termID);
		}else if($value == 'room'){
			$view = 'download_room';
			return $this->get_room_list($termID);
		}else{
			$view = 'download';
			return $this->get_class_list($termID);
		}
	}

	function get_faculty_list($termID){
		$arr = [];

		$faculties = $this->db->query("
			SELECT DISTINCT c.facID,u.ln,u.fn FROM faculty f 
			INNER JOIN class c ON f.facID = c.facID 
			INNER JOIN users u ON f.uID = u.uID  
			WHERE c.termID = $termID
		")->result();

		foreach($faculties as $faculty){
			$classes = $this->db->query("
				SELECT c.classCode,s.subDesc,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time,r.roomName,section.secName,
				(SELECT CONCAT('Merge with ',cc.classCode,' in section ',sec.secName) FROM class cc INNER JOIN section sec ON cc.secID = sec.secID WHERE cc.classID = c.merge_with) mergeClass
				FROM class c 
				INNER JOIN subject s ON c.subID = s.subID
				INNER JOIN section ON c.secID = section.secID 
				INNER JOIN day d ON c.dayID = d.dayID 
				INNER JOIN room r ON c.roomID = r.roomID 
				WHERE c.facID = ".$faculty->facID." AND c.termID = $termID
				ORDER BY day,c.timeIn ASC
			")->result();
			///echo $this->db->last_query(); die();
			$arr[] = ['ln' => $faculty->ln, 'fn' => $faculty->fn, 'classes' => $classes];
		}
		return $arr;

	}

	function get_room_list($termID){
		$arr = [];

		$rooms = $this->db->query("
			SELECT DISTINCT c.roomID,r.roomName FROM room r 
			INNER JOIN class c ON r.roomID = c.roomID 
			WHERE c.termID = $termID
		")->result();

		foreach($rooms as $room){
			$classes = $this->db->query("
				SELECT c.classCode,s.subDesc,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time,u.ln,u.fn,section.secName, 
				(SELECT CONCAT('Merge with ',cc.classCode,' in section ',sec.secName) FROM class cc INNER JOIN section sec ON cc.secID = sec.secID WHERE cc.classID = c.merge_with) mergeClass
				FROM class c 
				INNER JOIN subject s ON c.subID = s.subID 
				INNER JOIN section ON c.secID = section.secID 
				INNER JOIN day d ON c.dayID = d.dayID 
				INNER JOIN faculty f ON c.facID = f.facID 
				INNER JOIN users u ON f.uID = u.uID 
				WHERE c.roomID = ".$room->roomID." AND c.termID = $termID
				ORDER BY day,c.timeIn ASC
			")->result();
			///echo $this->db->last_query(); die();
			$arr[] = ['roomName' => $room->roomName, 'classes' => $classes];
		}
		return $arr;

	}

	function get_term($termID){
		return $this->db->query("SELECT t.schoolYear, s.semDesc FROM term t INNER JOIN semester s ON t.semID=s.semID WHERE t.termID = $termID LIMIT 1")->row();
	}

	function get_class_list($termID){
		$arr = [];

		$sections = $this->db->query("
			SELECT DISTINCT s.secID,s.courseID,s.secName FROM section s 
			INNER JOIN class c ON s.secID = c.secID 
			WHERE c.termID = $termID ORDER BY s.secName ASC
		")->result();
		
		
		foreach($sections as $section){
			$classes = $this->db->query("
				SELECT c.classCode,c.roomID,c.facID,s.subDesc,s.type,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time,r.roomName,u.ln,u.fn,sec.secName, 
				(SELECT CONCAT('Merge with ',cc.classCode,' in section ',sec.secName) FROM class cc INNER JOIN section sec ON cc.secID = sec.secID WHERE cc.classID = c.merge_with) mergeClass
				FROM class c 
				INNER JOIN subject s ON c.subID = s.subID 
				INNER JOIN section sec ON c.secID = sec.secID 
				INNER JOIN room r ON c.roomID = r.roomID 
				INNER JOIN day d ON c.dayID = d.dayID 
				INNER JOIN faculty f ON c.facID = f.facID 
				INNER JOIN users u ON f.uID = u.uID 
				WHERE c.secID = ".$section->secID." AND c.termID = $termID
				ORDER BY day,c.timeIn ASC
			")->result();
			$arr[] = ['secName' => $section->secName,'courseID'=>$section->courseID, 'classes' => $classes];
		}
		return $arr;
		
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