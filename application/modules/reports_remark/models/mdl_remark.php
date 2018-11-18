<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Remark extends CI_Model{

	function fetchCourses(){
		echo json_encode(
			$this->db->select('courseID,courseCode')->get('course')->result()
		);
	}

	function fetchStudents($termID, $remark){
		// if($remark == 'Incomplete'){
		// 	$query = $this->db->query("
		// 		SELECT DISTINCT s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name, c.courseCode, y.yearDesc FROM studgrade sg 
		// 		INNER JOIN student s ON sg.studID = s.studID
		// 		INNER JOIN users u ON s.uID = u.uID 
		// 		INNER JOIN studprospectus sp ON s.studID = sp.studID
		// 		INNER JOIN prospectus p ON sp.prosID = p.prosID 
		// 		INNER JOIN course c ON p.courseID = c.courseID 
		// 		INNER JOIN year y ON s.yearID = y.yearID 
		// 		WHERE sg.remarks = 'Incomplete'
		// 		ORDER BY name ASC 
		// 	")->result();
		// }else{
		// 	$query = $this->db->query("
		// 		SELECT DISTINCT s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name, c.courseCode, y.yearDesc FROM studgrade sg 
		// 		INNER JOIN student s ON sg.studID = s.studID
		// 		INNER JOIN users u ON s.uID = u.uID 
		// 		INNER JOIN studprospectus sp ON s.studID = sp.studID
		// 		INNER JOIN prospectus p ON sp.prosID = p.prosID 
		// 		INNER JOIN course c ON p.courseID = c.courseID 
		// 		INNER JOIN year y ON s.yearID = y.yearID 
		// 		WHERE sg.remarks = '$remark' AND sg.termID = $termID
		// 		ORDER BY name ASC 
		// 	")->result();
		// }
		$query = $this->db->query("
			SELECT DISTINCT s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name, c.courseCode, y.yearDesc FROM studgrade sg 
			INNER JOIN student s ON sg.studID = s.studID
			INNER JOIN users u ON s.uID = u.uID 
			INNER JOIN studprospectus sp ON s.studID = sp.studID
			INNER JOIN prospectus p ON sp.prosID = p.prosID 
			INNER JOIN course c ON p.courseID = c.courseID 
			INNER JOIN year y ON s.yearID = y.yearID 
			WHERE sg.remarks = '$remark' AND sg.termID = $termID
			ORDER BY name ASC 
		")->result();
		echo json_encode($query);
	}

	function fetchStudents_by_course($termID, $remark, $courseID){
		// if($remark == 'Incomplete'){
		// 	$query = $this->db->query("
		// 		SELECT DISTINCT s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name, c.courseCode, y.yearDesc FROM studgrade sg 
		// 		INNER JOIN student s ON sg.studID = s.studID
		// 		INNER JOIN users u ON s.uID = u.uID 
		// 		INNER JOIN studprospectus sp ON s.studID = sp.studID
		// 		INNER JOIN prospectus p ON sp.prosID = p.prosID 
		// 		INNER JOIN course c ON p.courseID = c.courseID 
		// 		INNER JOIN year y ON s.yearID = y.yearID 
		// 		WHERE sg.remarks = 'Incomplete' AND c.courseID = $courseID
		// 		ORDER BY name ASC 
		// 	")->result();
		// }else{
		// 	$query = $this->db->query("
		// 		SELECT DISTINCT s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name, c.courseCode, y.yearDesc FROM studgrade sg 
		// 		INNER JOIN student s ON sg.studID = s.studID
		// 		INNER JOIN users u ON s.uID = u.uID 
		// 		INNER JOIN studprospectus sp ON s.studID = sp.studID
		// 		INNER JOIN prospectus p ON sp.prosID = p.prosID 
		// 		INNER JOIN course c ON p.courseID = c.courseID 
		// 		INNER JOIN year y ON s.yearID = y.yearID 
		// 		WHERE sg.remarks = '$remark' AND sg.termID = $termID AND c.courseID = $courseID
		// 		ORDER BY name ASC 
		// 	")->result();
		// }
		$query = $this->db->query("
			SELECT DISTINCT s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name, c.courseCode, y.yearDesc FROM studgrade sg 
			INNER JOIN student s ON sg.studID = s.studID
			INNER JOIN users u ON s.uID = u.uID 
			INNER JOIN studprospectus sp ON s.studID = sp.studID
			INNER JOIN prospectus p ON sp.prosID = p.prosID 
			INNER JOIN course c ON p.courseID = c.courseID 
			INNER JOIN year y ON s.yearID = y.yearID 
			WHERE sg.remarks = '$remark' AND sg.termID = $termID AND c.courseID = $courseID
			ORDER BY name ASC 
		")->result();
		echo json_encode($query);
	}

	function fetchClass($termID, $remark){
		$arr = [];
		// if($remark == 'Incomplete'){
		// 	$classes = $this->db->query("
		// 		SELECT DISTINCT c.classID,c.classCode,s.subDesc,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time,r.roomName,CONCAT(u.ln,', ',u.fn,' ',u.mn) faculty, sec.secName 
		// 		FROM studgrade sg 
		// 		INNER JOIN subject s ON sg.subID = s.subID 
		// 		INNER JOIN class c ON s.subID = c.subID 
		// 		INNER JOIN day d ON c.dayID = d.dayID 
		// 		INNER JOIN room r ON c.roomID = r.roomID 
		// 		INNER JOIN faculty f ON c.facID = f.facID 
		// 		INNER JOIN users u ON f.uID = u.uID 
		// 		INNER JOIN section sec ON c.secID = sec.secID  
		// 		WHERE sg.remarks = 'Incomplete' AND sg.grade_type = 'Class'
		// 		ORDER BY c.classCode ASC 
		// 	")->result();

		// 	foreach($classes as $class){
		// 		$students = $this->db->query("
		// 			SELECT s.studID,s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name,c.courseCode,y.yearDesc 
		// 			FROM studclass sc 
		// 			INNER JOIN student s ON sc.studID = s.studID
		// 			INNER JOIN users u ON s.uID = u.uID 
		// 			INNER JOIN studprospectus sp ON s.studID = sp.studID
		// 			INNER JOIN prospectus p ON sp.prosID = p.prosID 
		// 			INNER JOIN course c ON p.courseID = c.courseID 
		// 			INNER JOIN year y ON s.yearID = y.yearID 
		// 			WHERE sc.classID = ".$class->classID." AND sc.remarks = 'Incomplete'
		// 			ORDER BY name ASC
		// 		")->result();
		// 		$arr[] = ['class' => $class, 'students' => $students];
		// 	}

		// }else{
		// 	$classes = $this->db->query("
		// 		SELECT DISTINCT c.classID,c.classCode,s.subDesc,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time,r.roomName,CONCAT(u.ln,', ',u.fn,' ',u.mn) faculty, sec.secName 
		// 		FROM studgrade sg 
		// 		INNER JOIN subject s ON sg.subID = s.subID 
		// 		INNER JOIN class c ON s.subID = c.subID 
		// 		INNER JOIN day d ON c.dayID = d.dayID 
		// 		INNER JOIN room r ON c.roomID = r.roomID 
		// 		INNER JOIN faculty f ON c.facID = f.facID 
		// 		INNER JOIN users u ON f.uID = u.uID 
		// 		INNER JOIN section sec ON c.secID = sec.secID  
		// 		WHERE sg.remarks = '$remark' AND sg.termID = $termID AND sg.grade_type = 'Class'
		// 		ORDER BY c.classCode ASC 
		// 	")->result();

		// 	foreach($classes as $class){
		// 		$students = $this->db->query("
		// 			SELECT s.studID,s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name,c.courseCode,y.yearDesc 
		// 			FROM studclass sc 
		// 			INNER JOIN student s ON sc.studID = s.studID
		// 			INNER JOIN users u ON s.uID = u.uID 
		// 			INNER JOIN studprospectus sp ON s.studID = sp.studID
		// 			INNER JOIN prospectus p ON sp.prosID = p.prosID 
		// 			INNER JOIN course c ON p.courseID = c.courseID 
		// 			INNER JOIN year y ON s.yearID = y.yearID 
		// 			WHERE sc.classID = ".$class->classID." AND sc.remarks = '$remark'
		// 			ORDER BY name ASC
		// 		")->result();
		// 		$arr[] = ['class' => $class, 'students' => $students];
		// 	}
			
		// }
		$classes = $this->db->query("
			SELECT DISTINCT c.classID,c.classCode,s.subDesc,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time,r.roomName,CONCAT(u.ln,', ',u.fn,' ',u.mn) faculty, sec.secName 
			FROM studgrade sg 
			INNER JOIN subject s ON sg.subID = s.subID 
			INNER JOIN class c ON s.subID = c.subID 
			INNER JOIN day d ON c.dayID = d.dayID 
			INNER JOIN room r ON c.roomID = r.roomID 
			INNER JOIN faculty f ON c.facID = f.facID 
			INNER JOIN users u ON f.uID = u.uID 
			INNER JOIN section sec ON c.secID = sec.secID  
			WHERE sg.remarks = '$remark' AND sg.termID = $termID AND sg.grade_type = 'Class'
			ORDER BY c.classCode ASC 
		")->result();

		foreach($classes as $class){
			$students = $this->db->query("
				SELECT s.studID,s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name,c.courseCode,y.yearDesc 
				FROM studclass sc 
				INNER JOIN student s ON sc.studID = s.studID
				INNER JOIN users u ON s.uID = u.uID 
				INNER JOIN studprospectus sp ON s.studID = sp.studID
				INNER JOIN prospectus p ON sp.prosID = p.prosID 
				INNER JOIN course c ON p.courseID = c.courseID 
				INNER JOIN year y ON s.yearID = y.yearID 
				WHERE sc.classID = ".$class->classID." AND sc.remarks = '$remark'
				ORDER BY name ASC
			")->result();
			$arr[] = ['class' => $class, 'students' => $students];
		}
		
		echo json_encode($arr);
	}

}

?>