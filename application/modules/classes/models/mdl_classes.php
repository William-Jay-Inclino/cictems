<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Classes extends CI_Model{

	function saveGrade(){
		$has_error = false;
		$prelim = $midterm = $prefi = $final = $remarks = $fg = $equiv = '';

		$studID = $this->input->post('studID');
		$classID = $this->input->post('classID');
		$grade = $this->input->post('grade');
		$gradeDesc = $this->input->post('gradeDesc');
		$midterm = $this->input->post('midterm');
		$prefi = $this->input->post('prefi');
		$final = $this->input->post('final');
		//die(var_dump($final));
		$data[$gradeDesc] = $grade;

		if($gradeDesc == 'prelim'){
			if($grade == 'Dropped' && ($midterm['grade'] != '' || $prefi['grade'] != '' || $final['grade'] != '')){
				$has_error = true;
			}
		}else if($gradeDesc == 'midterm'){
			if($grade == 'Dropped' && ($prefi['grade'] != '' || $final['grade'] != '')){
				$has_error = true;
			}
		}else if($gradeDesc == 'prefi'){
			if($grade == 'Dropped' && $final['grade'] != ''){
				$has_error = true;
			}
		}

		if($has_error){
			$prevGrade = $this->db->select($gradeDesc)->get_where('studclass', "studID = $studID AND classID = $classID", 1)->row()->$gradeDesc;
			echo json_encode(['output'=>'error', 'prevGrade'=>$prevGrade]);
		}else{
			$this->db->trans_start();

			$this->db->update('studclass', $data, "studID = $studID AND classID = $classID");
			$g = $this->db->select('prelim,midterm,prefi,final')->get_where('studclass', "studID = $studID AND classID = $classID", 1)->row();

			$prelim = $g->prelim;
			$midterm = $g->midterm;
			$prefi = $g->prefi;
			$final = $g->final;

			if($prelim == 'Dropped' || $midterm == 'Dropped' || $prefi == 'Dropped' || $final == 'Dropped'){
				$remarks = 'Dropped';
				// $equiv = '5.0';
				if($prelim == '' || $prelim == 'Dropped'){$prelim = 50;}
				if($midterm == '' || $midterm == 'Dropped'){$midterm = 50;}
				if($prefi == '' || $prefi == 'Dropped'){$prefi = 50;}
				if($final == '' || $final == 'Dropped'){$final = 50;}
			}

			if($prelim != '' && $midterm != '' && $prefi != '' && $final != ''){
					
				if($prelim == 'INC' || $midterm == 'INC' || $prefi == 'INC' || $final == 'INC'){
					if($remarks != 'Dropped'){
						$remarks = 'Incomplete';	
					}
				}else{
					$gf = $this->db->get('grade_formula')->row();
					$fg = round(($prelim * $gf->prelim) + ($midterm * $gf->midterm) + ($prefi * $gf->prefi) + ($final * $gf->final), 2);
					$fg2 = round($fg);

					//if($remarks != 'Dropped'){
						if($fg2 < 75){
							if($remarks != 'Dropped'){
								$remarks = 'Failed';
							}
							$equiv = '5.0';
						}else{
							$remarks = 'Passed';
							$equiv = $this->db->select('metric')->get_where('grade_metric', "grade = $fg2", 1)->row()->metric;
						}
					//}
				}
			}

			$this->db->update('studclass',['finalgrade'=>$fg,'remarks'=>$remarks], "classID = $classID and studID = $studID");

			$this->db->trans_complete();
			echo json_encode([
				'prelim'=>$g->prelim, 'midterm'=>$g->midterm, 'prefi'=>$g->prefi, 'final'=>$g->final, 'finalgrade'=>$fg, 'equiv'=>$equiv, 'remarks'=>$remarks
			]);

		}

		
	}

	function get_faculties(){
		$query = $this->db->query("
			SELECT f.facID,CONCAT(u.ln,', ',u.fn,' ',u.mn) as name 
			FROM faculty f 
			INNER JOIN users u ON f.uID = u.uID
			ORDER BY name ASC"
		);
		echo json_encode($query->result());
	}

	function get_classes($facID,$termID){
		$query = $this->db->query("
			SELECT c.classID, s.subCode,s.subDesc,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time,
			r.roomName,sec.secName,c.status
			FROM class c 
			INNER JOIN subject s ON c.subID = s.subID
			INNER JOIN room r ON c.roomID = r.roomID
			INNER JOIN day d ON c.dayID = d.dayID
			INNER JOIN section sec ON c.secID = sec.secID
			WHERE facID = $facID AND termID = $termID
			"
		);
		echo json_encode($query->result());
	}

	function fetch_Class_Selected($classID){
		$query = $this->db->query("
			SELECT CONCAT(u.ln,', ',u.fn) as faculty,s.subCode,s.subDesc,d.dayDesc,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time, c.status,r.roomName,sec.secName,c.date_submitted
			FROM class c 
			INNER JOIN faculty f ON c.facID = f.facID
			INNER JOIN users u ON f.uID = u.uID
			INNER JOIN subject s ON c.subID = s.subID
			INNER JOIN room r ON c.roomID = r.roomID
			INNER JOIN day d ON c.dayID = d.dayID
			INNER JOIN section sec ON c.secID = sec.secID
			WHERE c.classID = $classID
			LIMIT 1
			"
		);
		echo json_encode($query->row());
	}

	function fetch_Students($classID){
		$query = $this->db->query("
			SELECT s.studID,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name,
			sc.prelim,sc.midterm,sc.prefi,sc.final,sc.finalgrade,sc.remarks,
			(SELECT metric FROM grade_metric WHERE grade = ROUND(sc.finalgrade) LIMIT 1) equiv
			FROM studclass sc
			INNER JOIN student s ON sc.studID = s.studID
			INNER JOIN users u ON s.uID = u.uID
			AND sc.classID = $classID
		");
		echo json_encode($query->result());
	}

	function add_student(){
		$classID = $this->input->post('classID');
		$studID = $this->input->post('studID');

		$this->db->trans_start();
		$query = $this->db->select('1')->get_where('studclass', "classID = $classID AND studID = $studID");
		if($query->row()){
			echo 'exist';
		}else{
			$termID = $this->db->select('termID')->get_where('class', "classID = $classID", 1)->row()->termID;
			$sql = $this->db->query("SELECT 1 FROM studclass sc INNER JOIN class c ON sc.classID = c.classID WHERE sc.studID = $studID AND c.termID = $termID LIMIT 1")->row();
			if(!$sql){
				$check_ctr = $this->db->query("SELECT 1 FROM counter WHERE module = 'enrol_studs' AND termID = $termID LIMIT 1")->row();
				if($check_ctr){
					$this->db->query("UPDATE counter SET total = total + 1 WHERE module = 'enrol_studs' AND termID = $termID");
				}else{
					$this->db->query("INSERT counter(module,termID,total) VALUES('enrol_studs', $termID, 1)");		
				}
			}

			$this->db->insert('studclass',['studID'=>$studID,'classID'=>$classID,'status'=>'Enrolled']);

			$query2 = $this->db->query("
				SELECT s.studID,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name,
				sc.prelim,sc.midterm,sc.prefi,sc.final,sc.finalgrade,sc.remarks
				FROM studclass sc
				INNER JOIN student s ON sc.studID = s.studID
				INNER JOIN users u ON s.uID = u.uID
				AND sc.classID = $classID AND sc.studID = $studID
			");

			$this->db->trans_complete();
			
			echo json_encode($query2->row());

		}

	}

	function get_metric_grade($fg){
		$fg2 = round($fg);
		if($fg2 < 75){
			$equiv = 5.0;
		}else{
			$equiv = $this->db->query("SELECT metric FROM grade_metric WHERE grade = $fg2 LIMIT 1")->row()->metric;
		}
		return $equiv;
	}
	
	function finalized_grade(){
		$id = $this->input->post('classID');
		$value = $this->input->post('value');
		$this->db->trans_start();

		$password = $this->db->select('userPass')->get_where('users',"uID = ".$this->session->userdata('uID'), 1)->row()->userPass;

		$class = $this->db->query("
			SELECT c.subID, f.uID,c.termID FROM class c 
			INNER JOIN faculty f ON c.facID = f.facID 
			WHERE c.classID = $id LIMIT 1
		")->row();

		if($value == $password){
			$students = $this->db->query("SELECT studID,finalgrade,remarks FROM studclass WHERE classID = $id")->result();
			
			foreach($students as $student){
				$equiv = $this->get_metric_grade($student->finalgrade);
				if($student->remarks == 'Incomplete'){
					$equiv = 0.0;
				}
				$this->db->insert('studgrade',['studID'=>$student->studID, 'subID'=>$class->subID, 'uID'=>$class->uID, 'termID'=>$class->termID, 'sgGrade'=>$equiv, 'remarks'=>$student->remarks ,'grade_type'=>'Class']);
			}

			$this->db->query("UPDATE class SET date_submitted = NOW(), status = 'locked' WHERE classID = $id");
			$ds = $this->db->query("SELECT date_submitted FROM class WHERE classID = $id")->row()->date_submitted;
			$output = ['status'=>'success','date_submitted'=>$ds];
			
		}else{
			$output = ['status'=>'error'];
		}
		$this->db->trans_complete();
		echo json_encode($output);
	}

}

?>