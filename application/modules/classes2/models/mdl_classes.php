<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Classes extends CI_Model{

	function get_faculties(){
		$query = $this->db->query("
			SELECT f.facID,CONCAT(u.ln,', ',u.fn,' ',u.mn) as name 
			FROM faculty f 
			INNER JOIN users u ON f.uID = u.uID
			ORDER BY name ASC"
		);
		echo json_encode($query->result());
	}

	// function has_class_submitted($termID){
	// 	$x = false;
	// 	$query = $this->db->query("SELECT 1 FROM class WHERE termID = $termID and status = 'locked' LIMIT 1")->row();
	// 	if($query){
	// 		$x = true;
	// 	}
	// 	return $x;
	// }

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

	function fetch_Students_in_Class($grading, $classID){
		$x = 'sc.'.$grading;
		$query = $this->db->query("
			SELECT s.studID,sc.remarks,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name, 
			".$x." grading
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

		$query = $this->db->select('1')->get_where('studclass', "classID = $classID AND studID = $studID");
		if($query->row()){
			echo 'exist';
		}else{
			$this->db->insert('studclass',['studID'=>$studID,'classID'=>$classID,'status'=>'Enrolled']);

			$query2 = $this->db->query("
				SELECT s.studID,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name,
				sc.prelim,sc.midterm,sc.prefi,sc.final,sc.finalgrade,sc.remarks
				FROM studclass sc
				INNER JOIN student s ON sc.studID = s.studID
				INNER JOIN users u ON s.uID = u.uID
				AND sc.classID = $classID AND sc.studID = $studID
			");
			echo json_encode($query2->row());

		}

	}

	function fetch_stud_data_in_class($classID, $studID){
		$query = $this->db->query("
			SELECT sc.classID,sc.studID,sc.prelim,sc.midterm,sc.prefi,sc.final,sc.finalgrade,sc.remarks,sc.reason,sc.status,sc.enrolled_date,c.status as class_status 
			FROM studclass sc 
			INNER JOIN class c ON c.classID = sc.classID
			WHERE sc.classID = $classID AND sc.studID = $studID 
			LIMIT 1
		");
		$row = $query->row();
		$equiv = '';
		if($row->prelim != 0 && $row->midterm != 0 && $row->prefi != 0 && $row->final != 0){
			$query3 = $this->db->query("SELECT metric FROM grade_metric WHERE grade = ".$row->finalgrade." LIMIT 1");
			$row3 = $query3->row();
			if($row3){
				$equiv = $row3->metric;
			}else{
				$equiv = '5.0';
			}
		}

		$query2 = $this->db->query("
			SELECT CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) student_name FROM student s INNER JOIN users u ON s.uID = u.uID WHERE 
			studID = $studID LIMIT 1
		");

		$data = ['studclass' => $row, 'student' => $query2->row(), 'equiv'=>$equiv];

		echo json_encode($data);
	}

	function save_grade(){
		$studID = $this->input->post('studID');
		$classID = $this->input->post('classID');
		$grade = $this->input->post('grade');

		$this->db->trans_start();

		$this->db->update('studclass',$grade, "classID = $classID and studID = $studID");
		$query = $this->db->query("SELECT prelim,midterm,prefi,final,finalgrade,remarks FROM studclass WHERE classID = $classID AND studID = $studID LIMIT 1");
		$row = $query->row();
		$prelim = $row->prelim;
		$midterm = $row->midterm;
		$prefi = $row->prefi;
		$final = $row->final;
		$fg = $row->finalgrade;
		$remarks = $row->remarks;

		$query2 = $this->db->query("
			SELECT prelim,midterm,prefi,final FROM grade_formula 
		");
		$row2 = $query2->row();
		$pl = $row2->prelim;
		$mt = $row2->midterm;
		$pf = $row2->prefi;
		$fin = $row2->final;

		$fg = round(($prelim * $pl) + ($midterm * $mt) + ($prefi * $pf) + ($final * $fin), 2);
		$fg2 = round($fg);

		if($remarks != 'Incomplete'){
			if($prelim != 0 && $midterm != 0 && $prefi != 0 && $final != 0){
				if($fg2 < 75){
					$remarks = 'Failed';
				}else{
					$remarks = 'Passed';
				}
			}else{
				//$this->db->update('studclass',['remarks'=>''],"classID = $classID AND studID = $studID");
				$remarks = '';
			}
		}

		$this->db->update('studclass',['finalgrade'=>$fg,'remarks'=>$remarks], "classID = $classID and studID = $studID");

		$this->db->trans_complete();

		$query3 = $this->db->query("SELECT metric FROM grade_metric WHERE grade = $fg2 LIMIT 1");
		$row3 = $query3->row();
		$equiv = '';
		if($row3){
			$equiv = $row3->metric;
		}else{
			if($prelim != 0 && $midterm != 0 && $prefi != 0 && $final != 0){
				$equiv = '5.0';
			}
		}

		$data = ['prelim' => $prelim, 'midterm' => $midterm, 'prefi' => $prefi, 'final' => $final, 'fg' => $fg, 'equiv' => $equiv, 'remarks' => $remarks];

		echo json_encode($data);
	}

	function drop_or_inc(){
		$studID = $this->input->post('studID');
		$classID = $this->input->post('classID');
		$action = $this->input->post('action');
		$reason = $this->input->post('reason');

		$this->db->update('studclass',['remarks'=>$action,'reason'=>$reason],"studID = $studID AND classID = $classID");

	}

	function comply(){
		$studID = $this->input->post('studID');
		$classID = $this->input->post('classID');
		
		$query = $this->db->query("
			SELECT prelim,midterm,prefi,final,finalgrade FROM studclass WHERE studID = $studID AND classID = $classID LIMIT 1
		");
		$row = $query->row();
		$remarks = '';
		if($row->prelim != 0 && $row->midterm != 0 && $row->prefi != 0 && $row->final != 0){
			if($row->finalgrade < 74.5){
				$remarks = 'Failed';
			}else{
				$remarks = 'Passed';
			}
		}

		$this->db->update('studclass',['remarks'=>$remarks,'reason'=>''],"studID = $studID AND classID = $classID");

		echo $remarks;		
	}

	function comply2(){
		$studID = $this->input->post('studID');
		$classID = $this->input->post('classID');
		
		$grade = $this->db->query("SELECT prelim,midterm,prefi,final,finalgrade,remarks FROM studclass WHERE classID = $classID AND studID = $studID LIMIT 1")->row();
		if($grade->prelim == 0 || $grade->midterm == 0 || $grade->prefi == 0 || $grade->final == 0){
			$output = ['status'=>'error'];
		}else{
			$equiv = $this->get_metric_grade($grade->finalgrade);
			if($equiv <= 3.0){
				$rem = 'Passed';
			}else{
				$rem = 'Failed';
			}

			$this->db->trans_start();
			$this->db->update('studclass',['remarks'=>$rem,'reason'=>''], "classID = $classID AND studID = $studID");
			$subID = $this->db->query("SELECT subID FROM class WHERE classID = $classID LIMIT 1")->row()->subID;
			$this->db->update('studgrade',['sgGrade' => $equiv, 'remarks' => $rem], "subID = $subID AND studID = $studID");
			$this->db->trans_complete();
			$output = ['status'=>'success','remarks'=>$rem];
		}
		echo json_encode($output);
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

	function is_safe_to_remove($classID, $studID){
		$query = $this->db->query("
			SELECT prelim,midterm,prefi,final,finalgrade FROM studclass WHERE studID = $studID AND classID = $classID LIMIT 1
		");
		$row = $query->row();
		$x = 'no';
		if($row->prelim == 0 && $row->midterm == 0 && $row->prefi == 0 && $row->final == 0){
			$x = 'yes';
		}
		echo $x;
	}

	function remove_stud_from_class($classID, $studID){
		$this->db->delete('studclass', "classID = $classID AND studID = $studID");
	}

	function update_by_group(){
		$students = $this->input->post("students");
		$classID = $this->input->post("classID");
		$grading = $this->input->post("grading");
		$this->db->trans_start();	
		foreach($students as $student){
			if($student['remarks'] != 'Dropped'){
				$this->db->update(
					'studclass',[$grading => $student['grading']], "studID = ".$student['studID']." AND classID = $classID"
				);

				$query = $this->db->query("SELECT prelim,midterm,prefi,final,finalgrade,remarks FROM studclass WHERE classID = $classID AND studID = ".$student['studID']." LIMIT 1");
				$row = $query->row();
				$prelim = $row->prelim;
				$midterm = $row->midterm;
				$prefi = $row->prefi;
				$final = $row->final;
				$fg = $row->finalgrade;
				$remarks = $row->remarks;

				$query2 = $this->db->query("
					SELECT prelim,midterm,prefi,final FROM grade_formula 
				");
				$row2 = $query2->row();
				$pl = $row2->prelim;
				$mt = $row2->midterm;
				$pf = $row2->prefi;
				$fin = $row2->final;

				$fg = round(($prelim * $pl) + ($midterm * $mt) + ($prefi * $pf) + ($final * $fin), 2);
				$fg2 = round($fg);

				if($remarks != 'Incomplete'){
					if($prelim != 0 && $midterm != 0 && $prefi != 0 && $final != 0){
						if($fg2 < 75){
							$remarks = 'Failed';
						}else{
							$remarks = 'Passed';
						}
					}else{
						//$this->db->update('studclass',['remarks'=>''],"classID = $classID AND studID = $studID");
						$remarks = '';
					}
				}

				$this->db->update('studclass',['finalgrade'=>$fg,'remarks'=>$remarks], "classID = $classID and studID = ".$student['studID']);

			}
		}
		$this->db->trans_complete();
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