<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Grade extends CI_Model{

	function download($type, $studID){
		if($type == 'download-by-prospectus'){
			$this->report_by_pros($studID, $data);
		}else if($type == 'download-by-class'){
			$this->report_by_class($studID, $data);
		}else{
			show_404();
		}
		return $data;
	}

	function report_by_pros($studID, &$data){
		$holder2 = [];
		$prosID = $this->db->select('prosID')->get_where('studprospectus', "studID = $studID", 1)->row()->prosID;

		$data['prospectus'] = $this->db->query("
			SELECT CONCAT(c.courseDesc,' (',c.courseCode,')') AS description,p.effectivity 
			FROM prospectus p  
			INNER JOIN course c ON p.courseID=c.courseID 
			WHERE p.prosID = $prosID LIMIT 1
		")->row();

		$data['specializations'] = $this->db->get('specialization')->result();

		$years = $this->db->query("SELECT y.yearID, y.yearDesc FROM subject s INNER JOIN year y ON s.yearID = y.yearID WHERE s.prosID = $prosID GROUP BY y.yearID ORDER BY y.duration ASC")->result();

		foreach($years as $y){
			$sems = $this->db->query("
				SELECT sem.semID, sem.semDesc FROM subject s 
				INNER JOIN semester sem ON s.semID=sem.semID 
				WHERE s.prosID = $prosID AND s.yearID = ".$y->yearID."
				GROUP BY sem.semID
				ORDER BY sem.semOrder ASC
			")->result();

			foreach($sems as $sem){
				$term = $y->yearDesc.' - '.$sem->semDesc;
				$holder = [];

				$subjects = $this->db->query("
					SELECT s.subID,s.id,s.subCode,s.subDesc,s.type,s.units,s.nonSub_pre,
					(SELECT yearDesc FROM year_req yr,year y,subject s2 WHERE yr.subID=s2.subID AND yr.yearID=y.yearID AND s2.subID=s.subID LIMIT 1) year_req,
					(SELECT sg.sgGrade FROM studgrade sg,student stud,subject sub WHERE sg.studID=stud.studID AND sg.subID=sub.subID AND sg.studID = $studID AND sg.subID = s.subID ORDER BY sg.sgGrade ASC LIMIT 1) grade,
					(SELECT CONCAT(sg.grade_type,'|',t.schoolYear,'|',sem.semDesc) FROM term t,semester sem,studgrade sg WHERE sg.termID = t.termID AND t.semID=sem.semID AND sg.subID = s.subID AND sg.studID = $studID) term

					FROM subject s
					WHERE s.prosID = $prosID AND s.yearID = ".$y->yearID." AND s.semID = ".$sem->semID."
				")->result();

				foreach($subjects as $subject){

					$sub_req = $this->db->query("
						SELECT sr.req_subID,req_type, (SELECT subCode FROM subject WHERE subID = sr.req_subID) req_code
						FROM subject s 
						INNER JOIN subject_req sr ON s.subID = sr.subID AND s.subID = ".$subject->subID."
					")->result();

					$holder[] = ['subject'=>$subject,'sub_req'=>$sub_req];

				}

				$holder2[] = ['term' => $term, 'subjects' => $holder];

			}

		}

		$data['subjects'] = $holder2;

	}

	function report_by_class($studID, &$data){
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
				SELECT c.classID,s.type,c.classCode,s.subDesc,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time,r.roomName,CONCAT(u.ln,', ',u.fn,' ',u.mn) faculty,sc.prelim,sc.midterm,sc.prefi,sc.final,sc.finalgrade,sc.remarks
				FROM studclass sc  
				INNER JOIN class c ON sc.classID = c.classID 
				INNER JOIN subject s ON c.subID = s.subID  
				INNER JOIN room r ON c.roomID=r.roomID
				INNER JOIN day d ON c.dayID=d.dayID
				INNER JOIN faculty f ON c.facID=f.facID
				INNER JOIN users u ON f.uID=u.uID
				WHERE sc.studID = $studID AND sc.status = 'Enrolled' AND c.termID = ".$term->termID."
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

		$data = $arr2;
	}

	function populate($studID = NULL){
		$sql = $this->db->query("SELECT name, description FROM reports WHERE module = 'reports_prospectus'")->row();
		$specs = $this->db->get('specialization')->result();
		$prosID = $this->db->select('prosID')->get_where('studprospectus', "studID = $studID", 1)->row()->prosID;

		foreach($specs as $s){
			$total = $this->db->query("SELECT SUM(units) total FROM subject WHERE prosID = $prosID AND specID = ".$s->specID)->row()->total;
			$holder[] = ['specID'=>$s->specID,'specDesc'=>$s->specDesc,'total'=>$total];
		}
		return ['populate'=>$sql, 'specializations'=>$holder];
	}

	function get_student($studID, $val = NULL){
		$query = $this->db->select('studID,CONCAT(u.fn," ",u.mn," ",u.ln," | ",s.controlNo) AS student')->get_where('student s,users u'," s.uID = u.uID AND s.studID = $studID",1);
		
		if($val == NULL){
			echo json_encode($this->db->select('studID,CONCAT(u.fn," ",u.mn," ",u.ln," | ",s.controlNo) AS student')->get_where('student s,users u'," s.uID = u.uID AND s.studID = $studID",1)->row());	
		}else{
			return $this->db->select('CONCAT(u.fn," ",u.mn," ",u.ln) AS student')->get_where('student s,users u'," s.uID = u.uID AND s.studID = $studID",1)->row();
		}
	}

	function get_grade_by_pros($studID){
		$this->report_by_pros($studID, $data);
		echo json_encode($data);
	}

	function get_grade_by_class($studID){
		$this->report_by_class($studID, $data);
		echo json_encode($data);
	}

	function check_id($id){
		$sql = $this->db->select('1')->get_where('student', "studID = $id", 1)->row();
		if(!$sql){
			show_404();
		}
		return $id;
	}

}

?>