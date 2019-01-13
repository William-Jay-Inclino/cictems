<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Student_Users extends CI_Model{

	function shared_data($termID){
		$data['stud_enrol_status'] = 'Unenrolled';
		
		$data['enrol_status'] = $this->db->select('some_value')->get_where('enrolment_settings', "name = 'status'", 1)->row()->some_value;
		$stud_enrol_status = $this->db->query("SELECT sc.status FROM studclass sc INNER JOIN class c ON sc.classID = c.classID WHERE c.termID = $termID AND sc.studID = (SELECT studID FROM student WHERE uID = ".$this->session->userdata('uID')." LIMIT 1) LIMIT 1")->row();

		if($stud_enrol_status){
			$data['stud_enrol_status'] = $stud_enrol_status->status;
		}
		return $data;
	}

	function get_enrol_status($termID){
		$sql = $this->db->query("SELECT sc.status FROM studclass sc INNER JOIN class c ON sc.classID=c.classID WHERE c.termID = $termID AND sc.studID = (SELECT studID FROM student WHERE uID = ".$this->session->userdata('uID')." LIMIT 1) LIMIT 1")->row();
		if(!$sql){
			$data['status'] = 'Unenrolled';
		}else{
			$data['status'] = $sql->status;
		}
		return $data;
	}

	function get_student_classes($termID){
		return $this->db->query("
			SELECT s.subCode,s.subDesc,s.type,s.units,d.dayDesc,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time,r.roomName,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) faculty
			FROM studclass sc
			INNER JOIN class c ON sc.classID = c.classID 
			INNER JOIN day d ON c.dayID = d.dayID 
			INNER JOIN subject s ON c.subID = s.subID 
			INNER JOIN room r ON c.roomID = r.roomID
			INNER JOIN faculty f ON c.facID = f.facID
			INNER JOIN users u ON f.uID = u.uID  
			WHERE sc.status = 'Enrolled' AND c.termID = $termID AND sc.studID = (SELECT studID FROM student WHERE uID = ".$this->session->userdata('uID')." LIMIT 1)
			ORDER BY d.dayDesc,c.timeIn
		")->result();
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
				SELECT c.classCode,c.roomID,c.facID,s.subDesc,s.type,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time,r.roomName,u.ln,u.fn
				FROM class c 
				INNER JOIN subject s ON c.subID = s.subID 
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

	function populate_class_sched(){
		$data['terms'] = $this->db->query('SELECT t.termID, CONCAT(t.schoolYear," ",s.semDesc) term FROM term t INNER JOIN semester s ON t.semID=s.semID ORDER BY t.schoolYear DESC,s.semOrder DESC')->result();
		$data['courses'] = $this->db->query('SELECT courseID,courseCode FROM course ORDER BY courseCode ASC')->result();
		$active_term = $this->db->query("SELECT termID FROM term WHERE termStat = 'active' LIMIT 1")->row()->termID;
		$data['class_list'] = $this->get_class_list($active_term, 1);
		echo json_encode($data);
	}

	function get_grades_by_prospectus(){
		$studID = $this->session->userdata('uID');
		$query = $this->db->select('prosID')->get_where('studprospectus','studID='.$studID,1);
		$row = $query->row_array();

		$query2 = $this->db->select('CONCAT(c.courseDesc," (",c.courseCode,")") AS description,p.effectivity')->get_where('course c,prospectus p', 'p.courseID = c.courseID AND p.prosID = '.$row['prosID'], 1);
		$prospectus = $query2->row_array();

		$query3 = $this->db->select('y.yearID')->group_by('y.duration')->order_by('y.duration','ASC')->get_where('subject s, year y', 's.yearID=y.yearID AND s.prosID='.$row['prosID']);

		foreach($query3->result_array() as $row3){
			$query4 = $this->db->select('sem.semID,sem.semDesc,y.yearDesc')->group_by('sem.semID')->order_by('sem.semOrder','ASC')->get_where('subject s, semester sem, year y','s.yearID=y.yearID AND s.semID=sem.semID AND s.prosID = '.$row['prosID'].' AND s.yearID = '.$row3['yearID']);
			foreach($query4->result_array() as $row4){

				$term =  $row4['yearDesc'].' - '.$row4['semDesc'];

				$query5 = $this->db->select('s.subID, s.subCode,s.subDesc,s.units,(SELECT y.yearDesc FROM year_req yr,year y,subject s2 WHERE yr.subID=s2.subID AND yr.yearID=y.yearID AND s2.subID=s.subID LIMIT 1) year_req,(SELECT sg.sgGrade FROM studgrade sg,student stud,subject sub WHERE sg.studID=stud.studID AND sg.subID=sub.subID AND sg.studID = '.$studID.' AND sg.subID = s.subID ORDER BY sg.sgGrade ASC LIMIT 1) grade,(SELECT CONCAT(sg.grade_type,"|",t.schoolYear,"|",sem.semDesc) FROM term t,semester sem,studgrade sg WHERE sg.termID = t.termID AND t.semID=sem.semID AND sg.subID = s.subID AND sg.studID = '.$studID.') term')->get_where('subject s','s.prosID = '.$row['prosID'].' AND s.yearID = '.$row3['yearID'].' AND s.semID = '.$row4['semID']);
				$row5 = $query5->result_array();

				foreach($row5 as $val){

					$query6 = $this->db->select('sr.req_subID,req_type, (SELECT subCode FROM subject WHERE subID = sr.req_subID) req_code')->get_where('subject s, subject_req sr','sr.subID=s.subID AND s.subID = '.$val['subID']);
					$row6 = $query6->result_array();

					$holder[] = ['subject'=>$val,'sub_req'=>$row6];
				}

				$holder2[] = array(
									'term' => $term,
									'subjects' => $holder
								);
				$holder = [];
			}
		}

		$output = ['prospectus'=>$prospectus, 'subjects'=>$holder2];
		return $output;
	}

	function get_grades_by_class(){
		$studID = $this->session->userdata('uID');
		$arr = [];
		$arr2 = [];
		$metric = '';

		$terms = $this->db->query("
				SELECT DISTINCT t.termID,CONCAT(t.schoolYear,' ',s.semDesc) term FROM studclass sc 
				INNER JOIN class c ON sc.classID = c.classID 
				INNER JOIN term t ON c.termID = t.termID 
				INNER JOIN semester s ON t.semID = s.semID 
				WHERE sc.studID = $studID
				ORDER BY term DESC,s.semOrder DESC
		")->result();

		$m = $this->db->query("
			SELECT prelim,midterm,prefi,final FROM grade_formula 
		")->row();

		foreach ($terms as $term) {
			$sql2 = $this->db->query("
				SELECT c.classID,c.classCode,s.subDesc,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time,r.roomName,CONCAT(u.ln,', ',u.fn,' ',u.mn) faculty,sc.prelim,sc.midterm,sc.prefi,sc.final,sc.finalgrade,sc.remarks
				FROM studclass sc  
				INNER JOIN class c ON sc.classID = c.classID 
				INNER JOIN subject s ON c.subID = s.subID  
				INNER JOIN room r ON c.roomID=r.roomID
				INNER JOIN day d ON c.dayID=d.dayID
				INNER JOIN faculty f ON c.facID=f.facID
				INNER JOIN users u ON f.uID=u.uID
				WHERE sc.studID = $studID AND c.termID = ".$term->termID."
			")->result();
			foreach($sql2 as $s){
				if($s->prelim && $s->midterm && $s->prefi && $s->final){

					if(is_numeric($s->prelim) && is_numeric($s->midterm) && is_numeric($s->prefi) && is_numeric($s->final)){
						$fg = round(round(($s->prelim * $m->prelim) + ($s->midterm * $m->midterm) + ($s->prefi * $m->prefi) + ($s->final * $m->final), 2));
						$metric = $this->db->query("SELECT metric FROM grade_metric WHERE grade = $fg LIMIT 1")->row();
						$metric = ($metric) ? $metric->metric : '5.0';
					}

				}
				
				$arr[] = ['class' => $s, 'equiv' => $metric];
				$metric = '';
			}
			$arr2[] = ['term' => $term->term, 'class2' => $arr];
			$arr = [];
		}

		return $arr2;

	}

	function get_student_fees(){
		return $this->db->query("
			SELECT f.feeName,f.amount,sf.payable,sf.receivable FROM stud_fee sf INNER JOIN fees f ON sf.feeID=f.feeID 
			WHERE (sf.payable > 0.00 OR sf.receivable > 0.00) AND sf.studID = (SELECT studID FROM student WHERE uID = ".$this->session->userdata('uID')." LIMIT 1) 
			ORDER BY f.dueDate DESC
		")->result();
	}

	function enrolment_populate($termID){
		$data['sections'] = [];
		$data['classes'] = [];

		$sql = $this->db->query("
			SELECT p.courseID,s.yearID
			FROM studprospectus sp
			INNER JOIN student s ON sp.studID = s.studID 
			INNER JOIN users u ON s.uID = u.uID 
			INNER JOIN prospectus p ON sp.prosID = p.prosID 
			WHERE u.uID = ".$this->session->userdata('uID')." LIMIT 1    
		")->row();
		
		$sections = $this->db->query("
			SELECT DISTINCT s.secID,s.secName 
			FROM class c 
			INNER JOIN section s ON c.secID = s.secID
			WHERE c.termID = $termID AND s.yearID = ".$sql->yearID." AND 
			s.semID = (SELECT semID FROM term WHERE termID = $termID LIMIT 1) AND
			s.courseID = ".$sql->courseID."
		")->result();
		if($sections){
			$data['sections'] = $sections;
		}

		$classes = $this->db->query("
			SELECT c.classID,c.classCode,s.subDesc,s.units,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time 
			FROM studclass sc 
			INNER JOIN class c ON sc.classID = c.classID
			INNER JOIN subject s ON c.subID = s.subID 
			INNER JOIN day d ON c.dayID = d.dayID 
			WHERE sc.studID = (SELECT studID FROM student WHERE uID = ".$this->session->userdata('uID')." LIMIT 1)
		")->result();
		if($classes){
			$data['classes'] = $classes;
		}

		$active_sections = $this->db->query("SELECT DISTINCT c.secID, s.secName FROM class c INNER JOIN section s ON c.secID = s.secID WHERE c.termID = $termID ORDER BY s.secName ASC")->result();

		if($active_sections){
			$data['active_sections'] = $active_sections;
		}

		echo json_encode($data);
	}

	function enrolment_section_add($secID, $termID){
		$studID = $this->db->select('studID')->get_where('student', "uID = ".$this->session->userdata('uID'), 1)->row()->studID;

		$classes = $this->db->query("
			SELECT c.classID,c.classCode,s.subDesc,s.units,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time 
			FROM class c 
			INNER JOIN subject s ON c.subID = s.subID 
			INNER JOIN day d ON c.dayID = d.dayID 
			WHERE c.termID = $termID AND c.secID = $secID
		")->result();

		$this->db->trans_start();
		foreach($classes as $class){
			$this->db->insert('studclass', ['classID' => $class->classID, 'studID' => $studID]);
		}
		$this->db->trans_complete();
		echo json_encode($classes);
	}

	function enrolment_deleteClass($classID){
		$this->db->query("DELETE FROM studclass WHERE classID = $classID AND studID = (SELECT studID FROM student WHERE uID = ".$this->session->userdata('uID')." LIMIT 1)");
	}

	function enrolment_get_classes($secID, $termID){
		$sql = $this->db->query("
			SELECT c.classID,s.subID,c.classCode,s.subDesc,s.units,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time,r.roomName,CONCAT(u.ln,', ',u.fn) faculty
			FROM class c 
			INNER JOIN subject s ON c.subID = s.subID
			INNER JOIN room r ON c.roomID = r.roomID
			INNER JOIN day d ON c.dayID = d.dayID
			INNER JOIN faculty f ON c.facID = f.facID
			INNER JOIN users u ON f.uID = u.uID 
			WHERE c.termID = $termID AND c.secID = $secID
		")->result();
		echo json_encode($sql);
	}

	function enrolment_addClass($classID){
		$studID = $this->db->select('studID')->get_where('student', "uID = ".$this->session->userdata('uID'), 1)->row()->studID;
		$query = $this->db->select('1')->get_where('studclass', "classID = $classID AND studID = $studID");
		if(!$query->row()){
			$this->db->insert('studclass',['studID'=>$studID,'classID'=>$classID,'status'=>'Unenrolled']);
		}
	}

	function populate_payment_logs(){
		//die(print_r($_POST));
		$page = $this->input->post("page");
		$per_page = $this->input->post("per_page");
		$filteredDate = $this->input->post("filteredDate");
		$studID = $this->session->userdata('uID');

		$start = ($page - 1) * $per_page;

		if($filteredDate){
			$dateFrom = $this->input->post("filteredDate")['dateFrom'];
			$dateTo = $this->input->post("filteredDate")['dateTo'];

			$records = $this->db->query("
				SELECT CONCAT(uu.ln,', ',uu.fn,' ',LEFT(uu.mn,1)) faculty,
				f.feeName,p.paidDate,p.amount,p.action,p.or_number
				FROM payments p
				INNER JOIN users uu ON p.uID = uu.uID  
				INNER JOIN fees f ON p.feeID = f.feeID 
				WHERE p.paidDate BETWEEN '$dateFrom' AND DATE_ADD('$dateTo', INTERVAL 1 DAY) AND 
				p.studID = $studID
				ORDER BY p.paidDate DESC
				LIMIT $start, $per_page
			");
			$data['total_rows'] = $this->db->query("SELECT COUNT(1) total_rows FROM payments WHERE paidDate BETWEEN '$dateFrom' AND DATE_ADD('$dateTo', INTERVAL 1 DAY) AND 
				studID = $studID")->row()->total_rows;
		}else{
			$records = $this->db->query("
				SELECT CONCAT(uu.ln,', ',uu.fn,' ',LEFT(uu.mn,1)) faculty,
				f.feeName,p.paidDate,p.amount,p.action,p.or_number
				FROM payments  p
				INNER JOIN users uu ON p.uID = uu.uID  
				INNER JOIN fees f ON p.feeID = f.feeID 
				WHERE p.studID = $studID
				ORDER BY p.paidDate DESC
				LIMIT $start, $per_page
			");
			$data['total_rows'] = $this->db->query("SELECT COUNT(1) total_rows FROM payments WHERE studID = $studID")->row()->total_rows;
		}

		$data['records'] = $records->result();
		echo json_encode($data);

	}

}

?>