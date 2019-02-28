<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Student extends CI_Model{

	function get_date_updated($termID, $val = NULL){
		if($val == NULL){
			return $this->db->select("updated_at")->get_where('reports_date', "termID = $termID and module = 'enrolled_students'", 1)->row()->updated_at;
		}else{
			return $this->db->select("DATE_FORMAT(updated_at, '%M %d , %Y') updated_at")->get_where('reports_date', "termID = $termID and module = 'enrolled_students'", 1)->row()->updated_at;
		}
		
	}

	function updateSettings(){
		$termID = $this->input->post("termID");
		$data['updated_at'] = $this->input->post("updated_at");
		//die(print_r($_POST));
		$this->db->update('reports_date', $data, "termID = $termID AND module = 'enrolled_students'");
	}

	function download($action, $courseID, $yearID, $subID, $facID, $termID){
		$data['course'] = $data['faculty'] = $data['subCode'] = $data['yearDesc'] = '';
		
		$data['term'] = $this->db->query("SELECT CONCAT(t.schoolYear,' ',s.semDesc) term FROM term t INNER JOIN semester s ON t.semID = s.semID WHERE t.termID = $termID LIMIT 1")->row()->term;

		if($courseID != 'all-courses'){
			$data['course'] = $this->db->query("SELECT CONCAT(courseDesc,' (',courseCode,')') course FROM course WHERE courseID = $courseID LIMIT 1")->row()->course;
		}

		if($yearID != 'all-years'){
			$data['yearDesc'] = $this->db->query("SELECT yearDesc FROM year WHERE yearID = $yearID LIMIT 1")->row()->yearDesc;
		}

		if($action != 'all-students'){
			$data['subCode'] = $this->db->query("SELECT subCode FROM subject WHERE subID = $subID LIMIT 1")->row()->subCode;
		}

		if($action == 'per-subject'){
			if($courseID == 'all-courses' && $yearID == 'all-years'){
				$data['students'] = $this->db->query("
					SELECT DISTINCT s.controlNo,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name,c.courseCode, y.yearDesc,u.sex,u.address,u.dob
					FROM studclass sc 
					INNER JOIN class ON sc.classID = class.classID 
					INNER JOIN student s ON sc.studID = s.studID 
					INNER JOIN studrec_per_term spt ON s.studID = spt.studID 
					INNER JOIN year y ON spt.yearID = y.yearID
					INNER JOIN prospectus p ON spt.prosID = p.prosID
					INNER JOIN course c ON p.courseID = c.courseID
					INNER JOIN users u ON s.uID = u.uID 
					WHERE class.termID = $termID AND class.subID = $subID AND sc.status = 'Enrolled' AND spt.termID = $termID
					ORDER BY c.courseCode,y.duration,name ASC
				")->result();
			}else if($courseID != 'all-courses' && $yearID == 'all-years'){
				$data['students'] = $this->db->query("
					SELECT DISTINCT s.controlNo,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name, y.yearDesc,c.courseCode,u.sex,u.address,u.dob
					FROM studclass sc 
					INNER JOIN class ON sc.classID = class.classID 
					INNER JOIN student s ON sc.studID = s.studID 
					INNER JOIN studrec_per_term spt ON s.studID = spt.studID 
					INNER JOIN year y ON spt.yearID = y.yearID
					INNER JOIN prospectus p ON spt.prosID = p.prosID
					INNER JOIN course c ON p.courseID = c.courseID
					INNER JOIN users u ON s.uID = u.uID 
					WHERE class.termID = $termID AND class.subID = $subID AND c.courseID = $courseID AND sc.status = 'Enrolled' AND spt.termID = $termID
					ORDER BY c.courseCode,y.duration,name ASC
				")->result();
			}else if($courseID == 'all-courses' && $yearID != 'all-years'){
				$data['students'] = $this->db->query("
					SELECT DISTINCT s.controlNo,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name, y.yearDesc,c.courseCode,u.sex,u.address,u.dob
					FROM studclass sc 
					INNER JOIN class ON sc.classID = class.classID 
					INNER JOIN student s ON sc.studID = s.studID 
					INNER JOIN studrec_per_term spt ON s.studID = spt.studID 
					INNER JOIN year y ON spt.yearID = y.yearID
					INNER JOIN prospectus p ON spt.prosID = p.prosID
					INNER JOIN course c ON p.courseID = c.courseID
					INNER JOIN users u ON s.uID = u.uID 
					WHERE class.termID = $termID AND class.subID = $subID AND y.yearID = $yearID AND sc.status = 'Enrolled' AND spt.termID = $termID
					ORDER BY c.courseCode,y.duration,name ASC
				")->result();
			}else{
				$data['students'] = $this->db->query("
					SELECT DISTINCT s.controlNo,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name, y.yearDesc,c.courseCode,u.sex,u.address,u.dob
					FROM studclass sc 
					INNER JOIN class ON sc.classID = class.classID 
					INNER JOIN student s ON sc.studID = s.studID 
					INNER JOIN studrec_per_term spt ON s.studID = spt.studID 
					INNER JOIN year y ON spt.yearID = y.yearID
					INNER JOIN prospectus p ON spt.prosID = p.prosID
					INNER JOIN course c ON p.courseID = c.courseID
					INNER JOIN users u ON s.uID = u.uID 
					WHERE class.termID = $termID AND 
					class.subID = $subID AND 
					y.yearID = $yearID AND 
					c.courseID = $courseID AND sc.status = 'Enrolled' AND spt.termID = $termID
					ORDER BY c.courseCode,y.duration,name ASC
				")->result();
			}
			return $data;
		}else if($action == 'per-instructor'){
			$data['faculty'] = $this->db->query("
				SELECT CONCAT(u.ln,', ',u.fn) name,LEFT(u.mn,1) mn
				FROM faculty f 
				INNER JOIN users u ON f.uID = u.uID 
				WHERE f.facID = $facID LIMIT 1
			")->row();
			if($courseID == 'all-courses' && $yearID == 'all-years'){
				$data['students'] = $this->db->query("
					SELECT DISTINCT CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name,c.courseCode, y.yearDesc,u.sex,u.address,u.dob
					FROM studclass sc 
					INNER JOIN class ON sc.classID = class.classID 
					INNER JOIN student s ON sc.studID = s.studID 
					INNER JOIN studrec_per_term spt ON s.studID = spt.studID 
					INNER JOIN year y ON spt.yearID = y.yearID
					INNER JOIN prospectus p ON spt.prosID = p.prosID
					INNER JOIN course c ON p.courseID = c.courseID
					INNER JOIN users u ON s.uID = u.uID 
					WHERE class.termID = $termID AND class.subID = $subID AND class.facID = $facID AND sc.status = 'Enrolled' AND spt.termID = $termID
					ORDER BY c.courseCode,y.duration,name ASC
				")->result();
			}else if($courseID != 'all-courses' && $yearID == 'all-years'){
				$data['students'] = $this->db->query("
					SELECT DISTINCT CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name, y.yearDesc,c.courseCode,u.sex,u.address,u.dob
					FROM studclass sc 
					INNER JOIN class ON sc.classID = class.classID 
					INNER JOIN student s ON sc.studID = s.studID 
					INNER JOIN studrec_per_term spt ON s.studID = spt.studID 
					INNER JOIN year y ON spt.yearID = y.yearID
					INNER JOIN prospectus p ON spt.prosID = p.prosID
					INNER JOIN course c ON p.courseID = c.courseID
					INNER JOIN users u ON s.uID = u.uID 
					WHERE class.termID = $termID AND class.subID = $subID AND class.facID = $facID AND 
					c.courseID = $courseID AND sc.status = 'Enrolled' AND spt.termID = $termID
					ORDER BY c.courseCode,y.duration,name ASC
				")->result();
			}else if($courseID == 'all-courses' && $yearID != 'all-years'){
				$data['students'] = $this->db->query("
					SELECT DISTINCT CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name, y.yearDesc,c.courseCode,u.sex,u.address,u.dob
					FROM studclass sc 
					INNER JOIN class ON sc.classID = class.classID 
					INNER JOIN student s ON sc.studID = s.studID 
					INNER JOIN studrec_per_term spt ON s.studID = spt.studID 
					INNER JOIN year y ON spt.yearID = y.yearID
					INNER JOIN prospectus p ON spt.prosID = p.prosID
					INNER JOIN course c ON p.courseID = c.courseID
					INNER JOIN users u ON s.uID = u.uID 
					WHERE class.termID = $termID AND class.subID = $subID AND class.facID = $facID AND 
					y.yearID = $yearID AND sc.status = 'Enrolled' AND spt.termID = $termID
					ORDER BY c.courseCode,y.duration,name ASC
				")->result();
			}else{
				$data['students'] = $this->db->query("
					SELECT DISTINCT CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name, y.yearDesc,c.courseCode,u.sex,u.address,u.dob
					FROM studclass sc 
					INNER JOIN class ON sc.classID = class.classID 
					INNER JOIN student s ON sc.studID = s.studID 
					INNER JOIN studrec_per_term spt ON s.studID = spt.studID 
					INNER JOIN year y ON spt.yearID = y.yearID
					INNER JOIN prospectus p ON spt.prosID = p.prosID
					INNER JOIN course c ON p.courseID = c.courseID
					INNER JOIN users u ON s.uID = u.uID 
					WHERE class.termID = $termID AND class.subID = $subID AND class.facID = $facID AND 
					y.yearID = $yearID AND c.courseID = $courseID AND sc.status = 'Enrolled' AND spt.termID = $termID
					ORDER BY c.courseCode,y.duration,name ASC
				")->result();
			}
			return $data;
		}else{
			if($courseID == 'all-courses' && $yearID == 'all-years'){
				$data['students'] =$this->db->query("
					SELECT DISTINCT CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name,c.courseCode, y.yearDesc,u.sex,u.address,u.dob
					FROM studclass sc 
					INNER JOIN class ON sc.classID = class.classID 
					INNER JOIN student s ON sc.studID = s.studID 
					INNER JOIN studrec_per_term spt ON s.studID = spt.studID 
					INNER JOIN year y ON spt.yearID = y.yearID
					INNER JOIN prospectus p ON spt.prosID = p.prosID
					INNER JOIN course c ON p.courseID = c.courseID
					INNER JOIN users u ON s.uID = u.uID 
					WHERE class.termID = $termID AND sc.status = 'Enrolled' AND spt.termID = $termID
					ORDER BY c.courseCode,y.duration,name ASC
				")->result();
			}else if($courseID != 'all-courses' && $yearID == 'all-years'){
				$data['students'] =$this->db->query("
					SELECT DISTINCT CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name, y.yearDesc,c.courseCode,u.sex,u.address,u.dob
					FROM studclass sc 
					INNER JOIN class ON sc.classID = class.classID 
					INNER JOIN student s ON sc.studID = s.studID 
					INNER JOIN studrec_per_term spt ON s.studID = spt.studID 
					INNER JOIN year y ON spt.yearID = y.yearID
					INNER JOIN prospectus p ON spt.prosID = p.prosID
					INNER JOIN course c ON p.courseID = c.courseID
					INNER JOIN users u ON s.uID = u.uID 
					WHERE class.termID = $termID AND c.courseID = $courseID AND sc.status = 'Enrolled' AND spt.termID = $termID
					ORDER BY c.courseCode,y.duration,name ASC
				")->result();
			}else if($courseID == 'all-courses' && $yearID != 'all-years'){
				$data['students'] =$this->db->query("
					SELECT DISTINCT CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name, y.yearDesc,c.courseCode,u.sex,u.address,u.dob
					FROM studclass sc 
					INNER JOIN class ON sc.classID = class.classID 
					INNER JOIN student s ON sc.studID = s.studID 
					INNER JOIN studrec_per_term spt ON s.studID = spt.studID 
					INNER JOIN year y ON spt.yearID = y.yearID
					INNER JOIN prospectus p ON spt.prosID = p.prosID
					INNER JOIN course c ON p.courseID = c.courseID
					INNER JOIN users u ON s.uID = u.uID 
					WHERE class.termID = $termID AND y.yearID = $yearID AND sc.status = 'Enrolled' AND spt.termID = $termID
					ORDER BY c.courseCode,y.duration,name ASC
				")->result();
			}else{
				$data['students'] =$this->db->query("
					SELECT DISTINCT CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name, y.yearDesc,c.courseCode,u.sex,u.address,u.dob
					FROM studclass sc 
					INNER JOIN class ON sc.classID = class.classID 
					INNER JOIN student s ON sc.studID = s.studID 
					INNER JOIN studrec_per_term spt ON s.studID = spt.studID 
					INNER JOIN year y ON spt.yearID = y.yearID
					INNER JOIN prospectus p ON spt.prosID = p.prosID
					INNER JOIN course c ON p.courseID = c.courseID
					INNER JOIN users u ON s.uID = u.uID 
					WHERE class.termID = $termID AND y.yearID = $yearID AND c.courseID = $courseID AND sc.status = 'Enrolled' AND spt.termID = $termID
					ORDER BY c.courseCode,y.duration,name ASC
				")->result();
			}
			return $data;
		}

	}

	private function count_all($termID){
		$query = $this->db->query("SELECT total FROM counter WHERE module = 'enrol_studs' AND termID = $termID LIMIT 1");
		$rs = $query->row();
		if($rs){
			return $rs->total;
		}else{
			return 0;
		}
	}

	function populate($termID){
		$data['updated_at'] = $this->get_date_updated($termID);
		$data['faculties'] = $this->db->query("SELECT f.facID, CONCAT(u.ln,', ',u.fn,' ',u.mn) name FROM faculty f INNER JOIN users u ON f.uID = u.uID WHERE u.status = 'active'")->result();

		$data['terms'] = $this->db->query('SELECT t.termID, CONCAT(t.schoolYear," ",s.semDesc) AS term FROM term t INNER JOIN semester s ON t.semID=s.semID ORDER BY t.schoolYear DESC,s.semOrder DESC')->result();
		$data['courses'] = $this->db->query('SELECT courseID, courseCode FROM course ORDER BY courseCode ASC')->result();
		$data['years'] = $this->db->query('SELECT yearID, yearDesc FROM year ORDER BY duration ASC')->result();
		$data['students'] =$this->db->query("
			SELECT DISTINCT s.studID,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name,c.courseID, c.courseCode,y.yearID, y.yearDesc,u.sex,u.address,u.dob
			FROM studclass sc 
			INNER JOIN class ON sc.classID = class.classID 
			INNER JOIN student s ON sc.studID = s.studID 
			INNER JOIN studrec_per_term spt ON s.studID = spt.studID 
			INNER JOIN year y ON spt.yearID = y.yearID
			INNER JOIN prospectus p ON spt.prosID = p.prosID
			INNER JOIN course c ON p.courseID = c.courseID
			INNER JOIN users u ON s.uID = u.uID 
			WHERE class.termID = $termID AND sc.status = 'Enrolled' AND spt.termID = $termID
			ORDER BY y.yearDesc,name ASC
		")->result();
		$data['total_rows'] = $this->count_all($termID);
		echo json_encode($data);
	}

	function fetchSubjects($value){
		$search_value = strtr($value, '_', ' ');
		$query = $this->db->select('subID,subCode,type')->like('subCode', "$search_value")->get('subject', 10);
		echo json_encode($query->result());
	}

	function get_students_per_sub($termID, $subID){
		echo json_encode(
			$this->db->query("
				SELECT DISTINCT s.studID,s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name,c.courseID, c.courseCode,y.yearID, y.yearDesc
				FROM studclass sc 
				INNER JOIN class ON sc.classID = class.classID 
				INNER JOIN student s ON sc.studID = s.studID 
				INNER JOIN studprospectus sp ON s.studID = sp.studID
				INNER JOIN prospectus p ON sp.prosID = p.prosID 
				INNER JOIN course c ON p.courseID = c.courseID 
				INNER JOIN year y ON s.yearID = y.yearID
				INNER JOIN users u ON s.uID = u.uID 
				WHERE class.termID = $termID AND class.subID = $subID
				ORDER BY name ASC
			")->result()
		);
	}

	function get_students_per_fac($termID, $subID, $facID){
		echo json_encode(
			$this->db->query("
				SELECT DISTINCT s.studID,s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name,c.courseID, c.courseCode,y.yearID, y.yearDesc
				FROM studclass sc 
				INNER JOIN class ON sc.classID = class.classID 
				INNER JOIN student s ON sc.studID = s.studID 
				INNER JOIN studprospectus sp ON s.studID = sp.studID
				INNER JOIN prospectus p ON sp.prosID = p.prosID 
				INNER JOIN course c ON p.courseID = c.courseID 
				INNER JOIN year y ON s.yearID = y.yearID
				INNER JOIN users u ON s.uID = u.uID 
				WHERE class.termID = $termID AND class.subID = $subID AND class.facID = $facID
				ORDER BY name ASC
			")->result()
		);
	}

	function get_subjects_of_instructor($termID, $facID){
		echo json_encode(
			$this->db->query("
				SELECT s.subID, s.subCode FROM class c INNER JOIN subject s ON c.subID = s.subID WHERE c.facID = $facID AND c.termID = $termID ORDER BY subCode ASC
			")->result()
		);
	}

}

?>