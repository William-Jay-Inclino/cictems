<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Grade extends CI_Model{

	function get_student($studID){
		$query = $this->db->select('studID,CONCAT(u.fn," ",u.mn," ",u.ln," | ",s.controlNo) AS student')->get_where('student s,users u'," s.uID = u.uID AND s.studID = $studID",1);
		echo json_encode($query->row());
	}

	function get_grade_by_pros($studID){
		$holder2 = [];
		$query = $this->db->select('prosID')->get_where('studprospectus','studID='.$studID,1);
		$row = $query->row_array();

		$query2 = $this->db->select('CONCAT(c.courseDesc," (",c.courseCode,")") AS description,p.effectivity')->get_where('course c,prospectus p', 'p.courseID = c.courseID AND p.prosID = '.$row['prosID'], 1);
		$prospectus = $query2->row_array();

		$query3 = $this->db->select('y.yearID')->group_by('y.duration')->order_by('y.duration','ASC')->get_where('subject s, year y', 's.yearID=y.yearID AND s.prosID='.$row['prosID']);

		foreach($query3->result_array() as $row3){
			$query4 = $this->db->select('sem.semID,sem.semDesc,y.yearDesc')->group_by('sem.semID')->order_by('sem.semOrder','ASC')->get_where('subject s, semester sem, year y','s.yearID=y.yearID AND s.semID=sem.semID AND s.prosID = '.$row['prosID'].' AND s.yearID = '.$row3['yearID']);
			foreach($query4->result_array() as $row4){

				$term =  $row4['yearDesc'].' - '.$row4['semDesc'];

				$query5 = $this->db->select('s.subID, s.subCode,s.subDesc,s.type,s.units,(SELECT y.yearDesc FROM year_req yr,year y,subject s2 WHERE yr.subID=s2.subID AND yr.yearID=y.yearID AND s2.subID=s.subID LIMIT 1) year_req,(SELECT sg.sgGrade FROM studgrade sg,student stud,subject sub WHERE sg.studID=stud.studID AND sg.subID=sub.subID AND sg.studID = '.$studID.' AND sg.subID = s.subID ORDER BY sg.sgGrade ASC LIMIT 1) grade,(SELECT CONCAT(sg.grade_type,"|",t.schoolYear,"|",sem.semDesc) FROM term t,semester sem,studgrade sg WHERE sg.termID = t.termID AND t.semID=sem.semID AND sg.subID = s.subID AND sg.studID = '.$studID.') term')->get_where('subject s','s.prosID = '.$row['prosID'].' AND s.yearID = '.$row3['yearID'].' AND s.semID = '.$row4['semID']);
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
		echo json_encode($output);
	}

	function get_grade_by_class($studID){
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

		echo json_encode($arr2);
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