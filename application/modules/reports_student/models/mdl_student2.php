<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Student extends CI_Model{

	private function count_all($termID){
		$query = $this->db->query("SELECT total FROM counter WHERE module = 'enrol_studs' AND termID = $termID LIMIT 1");
		$rs = $query->row();
		if($rs){
			return $rs->total;
		}else{
			return 0;
		}
	}

	function populate($termID, $page = '1', $per_page = '10'){
		$start = ($page - 1) * $per_page;
		$data['terms'] = $this->db->query('SELECT t.termID, CONCAT(t.schoolYear," ",s.semDesc) AS term FROM term t INNER JOIN semester s ON t.semID=s.semID ORDER BY t.schoolYear DESC,s.semOrder DESC')->result();
		$data['courses'] = $this->db->query('SELECT courseID, courseCode FROM course ORDER BY courseCode ASC')->result();
		$data['students'] = $this->fetchAll($termID, $page, $per_page);
		$data['total_rows'] = $this->count_all($termID);
		echo json_encode($data);
	}

	function fetchData($filter, $termID, $page = '1', $per_page = '10', $id = NULL){
		if($filter == 0){
			$data['students'] = $this->fetchAll($termID, $page, $per_page);
			$data['total_rows'] = $this->count_all($termID);
		}else if($filter == 1){
			$res = $this->fetch_by_course($termID, $page, $per_page, $id);
			$data['students'] = $res['students'];
			$data['total_rows'] = count($data['students']);
			//$data['total_rows'] = $res['rows'];
		}
		echo json_encode($data);
	}

	function fetch_by_course($termID, $page, $per_page, $courseID){
		$start = ($page - 1) * $per_page;
		$data['students'] = $this->db->query("
			SELECT DISTINCT s.studID,s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name, c.courseCode, y.yearDesc
			FROM studclass sc 
			INNER JOIN class ON sc.classID = class.classID 
			INNER JOIN student s ON sc.studID = s.studID 
			INNER JOIN studprospectus sp ON s.studID = sp.studID
			INNER JOIN prospectus p ON sp.prosID = p.prosID 
			INNER JOIN course c ON p.courseID = c.courseID 
			INNER JOIN year y ON s.yearID = y.yearID
			INNER JOIN users u ON s.uID = u.uID 
			WHERE class.termID = $termID AND c.courseID = $courseID
			ORDER BY y.yearDesc,name ASC
		")->result();
		// $sql = $this->db->query("
		// 	SELECT DISTINCT s.studID
		// 	FROM studclass sc 
		// 	INNER JOIN class ON sc.classID = class.classID 
		// 	INNER JOIN student s ON sc.studID = s.studID 
		// 	INNER JOIN studprospectus sp ON s.studID = sp.studID
		// 	INNER JOIN prospectus p ON sp.prosID = p.prosID 
		// 	WHERE class.termID = $termID AND p.courseID = $courseID
		// ");
		// $data['rows'] = $sql->num_rows();
		return $data;
	}

	function fetchAll($termID, $page = '1', $per_page = '10'){
		$start = ($page - 1) * $per_page;
		$sql = $this->db->query("
			SELECT DISTINCT s.studID,s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name, c.courseCode, y.yearDesc
			FROM studclass sc 
			INNER JOIN class ON sc.classID = class.classID 
			INNER JOIN student s ON sc.studID = s.studID 
			INNER JOIN studprospectus sp ON s.studID = sp.studID
			INNER JOIN prospectus p ON sp.prosID = p.prosID 
			INNER JOIN course c ON p.courseID = c.courseID 
			INNER JOIN year y ON s.yearID = y.yearID
			INNER JOIN users u ON s.uID = u.uID 
			WHERE class.termID = $termID
			ORDER BY y.yearDesc,name ASC
			LIMIT $start, $per_page
		")->result();
		
		return $sql;
	}

	function get_student_list($termID, $courseID){
		if($courseID == 'all'){
			$ctr = 0;
			$courses = $this->db->query("SELECT courseID, courseCode FROM course ORDER BY courseCode ASC")->result();
			foreach($courses as $course){
				$enrolled_students = $this->db->query("
					SELECT DISTINCT s.studID,s.controlNo,u.fn,u.mn,u.ln
					FROM studclass sc 
					INNER JOIN class c ON sc.classID = c.classID 
					INNER JOIN student s ON sc.studID = s.studID 
					INNER JOIN studprospectus sp ON s.studID = sp.studID
					INNER JOIN prospectus p ON sp.prosID = p.prosID 
					INNER JOIN users u ON s.uID = u.uID 
					WHERE c.termID = $termID AND p.courseID = $course->courseID
				")->result();
				$data[] = ['courseCode' => $course->courseCode, 'students' => $enrolled_students];
				$ctr += count($enrolled_students);
			}
			$count = $ctr;
		}else{
			$courseCode = $this->db->query("SELECT courseCode FROM course WHERE courseID = $courseID LIMIT 1")->row()->courseCode;
			$enrolled_students = $this->db->query("
				SELECT DISTINCT s.studID,s.controlNo,u.fn,u.mn,u.ln
				FROM studclass sc 
				INNER JOIN class c ON sc.classID = c.classID 
				INNER JOIN student s ON sc.studID = s.studID 
				INNER JOIN studprospectus sp ON s.studID = sp.studID
				INNER JOIN prospectus p ON sp.prosID = p.prosID 
				INNER JOIN users u ON s.uID = u.uID 
				WHERE c.termID = $termID AND p.courseID = $courseID
			")->result();
			$data[] = ['courseCode' => $courseCode, 'students' => $enrolled_students];
			$count = count($enrolled_students);
		}
		$data2 = ['stud_list' => $data, 'total_count' => $count];
		echo json_encode($data2);
		
	}

	function fetchSubjects($value){
		$search_value = strtr($value, '_', ' ');
		$query = $this->db->select('subID,subCode')->like('subCode', "$search_value")->get('subject', 10);
		echo json_encode($query->result());
	}

	function fetchStudent_sub($subID, $termID){
		$sql = $this->db->query("
			SELECT DISTINCT s.studID,s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name, c.courseCode, y.yearDesc
			FROM studclass sc 
			INNER JOIN class ON sc.classID = class.classID 
			INNER JOIN student s ON sc.studID = s.studID 
			INNER JOIN studprospectus sp ON s.studID = sp.studID
			INNER JOIN prospectus p ON sp.prosID = p.prosID 
			INNER JOIN course c ON p.courseID = c.courseID 
			INNER JOIN year y ON s.yearID = y.yearID
			INNER JOIN users u ON s.uID = u.uID 
			WHERE class.termID = $termID AND class.subID = $subID
			ORDER BY y.yearDesc,name ASC
		")->result();

		echo json_encode($sql);

	}

}

?>