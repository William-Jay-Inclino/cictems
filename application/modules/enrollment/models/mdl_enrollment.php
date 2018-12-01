<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Enrollment extends CI_Model{

	function get_enrolment_status(){
		return $this->db->select('some_value')->get_where('enrolment_settings', 'name = "status"')->row()->some_value;
	}

	function get_enrol_data($studID, $termID){
		$query = $this->db->select("c.classID,sc.status,s.subID,c.classCode,s.lec,s.lab,s.subDesc,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time")
		->join('class c','sc.classID = c.classID')
		->join('subject s','c.subID = s.subID')
		->join('day d','c.dayID = d.dayID')
		->get_where('studclass sc', "sc.studID = $studID AND c.termID = $termID");
		// echo $this->db->last_query(); die();
		$row = $query->result();
		if($row){
			$output = [
				'data'=>$row,
				'status'=>$row[0]->status
			];
		}else{
			$output = ['status'=>'Empty'];
		}
		
		$output['stud'] = $this->db->query("
			SELECT s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name,c.courseID,c.courseCode,y.yearID,y.yearDesc 
			FROM student s 
			INNER JOIN users u ON s.uID = u.uID 
			INNER JOIN studprospectus sp ON sp.studID = s.studID 
			INNER JOIN prospectus p ON sp.prosID = p.prosID 
			INNER JOIN course c ON p.courseID = c.courseID 
			INNER JOIN year y ON s.yearID = y.yearID 
			WHERE s.studID = $studID LIMIT 1    
		")->row();
		$output['sections'] = $this->db->query("
			SELECT s.secID,s.secName 
			FROM section s 
			WHERE yearID = ".$output['stud']->yearID." AND 
			semID = (SELECT semID FROM term WHERE termID = $termID LIMIT 1) AND
			courseID = ".$output['stud']->courseID."
		")->result();
		echo json_encode($output);

	}

	function section_add($secID, $studID, $termID){
		$sql = $this->db->select('1')->get_where('class', "termID = $termID AND secID = $secID", 1)->row();
		if(!$sql){
			die('error');
		}

		$classes = $this->db->query("
			SELECT c.classID,s.subID,c.classCode,s.subDesc,s.lec,s.lab,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time 
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

	function searchClass($search_value,$search_opt, $termID){
		$search_value = strtr($search_value, '_', ' ');
		$query = $this->db->select("c.classID,s.subID,c.classCode,s.subDesc,s.lec,s.lab,CONCAT(c.classCode,' (',s.subDesc,')') AS classLabel,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time,r.roomName,CONCAT(u.ln,', ',u.fn) faculty,sec.secName")->like($search_opt,$search_value)->get_where('class c,subject s,room r,day d, faculty f,users u,section sec,term t','c.subID=s.subID AND c.roomID=r.roomID AND c.dayID=d.dayID AND c.facID=f.facID AND f.uID=u.uID AND c.secID=sec.secID AND c.termID=t.termID AND t.termID = '.$termID, 10);
		echo json_encode($query->result());
	}

	function addClass(){
		$classID = $this->input->post('classID');
		$studID = $this->input->post('studID');
		$status = $this->input->post('status');

		if($status != 'Enrolled'){
			$status = 'Unenrolled';
		}
		
		$query = $this->db->select('1')->get_where('studclass', "classID = $classID AND studID = $studID");
		if($query->row()){
			echo 'exist';
		}else{
			$this->db->insert('studclass',['studID'=>$studID,'classID'=>$classID,'status'=>$status]);
		}
	}

	function deleteClass($classID,$studID){
		$this->db->delete('studclass', ['classID'=>$classID,'studID'=>$studID]);
	}

	function evaluate($termID){
		//print_r($_POST);	die();
		$coreq_subs = []; //use for storing subject corequisites
		$subs_in_form = []; // use for storing subIDs in form
		//on top variables is used for checking corequisite subjects
		$output = [];
		$studID = $this->input->post('studID');
		$classes  = $this->input->post('classes');
		// var_dump($classes); die();
		$failed_classes = [];

		$this->db->trans_start();
		foreach($classes as $class){
			$classID = $class['classID'];
			$subID = $class['subID'];
			$subs_in_form[] = $classID;
			$query = $this->db->query("SELECT
				(SELECT COUNT(1) FROM studclass WHERE classID = $classID) population,
				(SELECT r.capacity FROM class c, room r WHERE c.roomID = r.roomID AND c.classID = $classID LIMIT 1) capacity,
				(SELECT prosID FROM subject WHERE subID = $subID) class_prosID,
				(SELECT sp.prosID FROM studprospectus sp, student s WHERE sp.studID = s.studID AND s.studID = $studID LIMIT 1) student_prosID,
				(SELECT 1 FROM subject sub, subject_req sr WHERE sr.subID = sub.subID AND sub.subID = $subID LIMIT 1) requisite_check,
				(SELECT 1 FROM subject sub, year_req yr WHERE yr.subID = sub.subID AND sub.subID = $subID LIMIT 1) requisite_check2
			");

			$row = $query->row_array();
			if($row['population'] > $row['capacity']){
				$output[] = 'Room capacity is full';
			}
			if($row['class_prosID'] != $row['student_prosID']){
				$output[] = 'Subject is not in the student\'s prospectus';
			}
			if($row['requisite_check'] > 0){
				$output2 = [];
				//subject has requisite
				$query2 = $this->db->select('sr.req_type,sr.req_subID')->get_where('subject s, subject_req sr','sr.subID=s.subID AND s.subID = '.$subID);
				foreach ($query2->result_array() as $row2) {
					if($row2['req_type'] == 1){
						//prerequisite
						$query3 = $this->db->select('sgGrade')->order_by('sgGrade','ASC')->get_where('studgrade','studID='.$studID.' AND subID = '.$row2['req_subID'], 1);
						$row3 = $query3->row_array();

						if(!isset($row3)){
							$output2['nograde'] = '';
						}else{
							if($row3['sgGrade'] > 3){
								$output2['failed'] = '';
							}
						}
					}else if($row2['req_type'] == 2){
						//corequisite
						// $query3 = $this->db->select('1')->get_where('studclass sc,class c,term t','sc.classID=c.classID AND c.termID=t.termID AND t.termID = "$termID" AND sc.studID = '.$studID.' AND c.subID = '.$row2['req_subID'], 1);
						// $row3 = $query3->row_array();
						// if(!isset($row3)){
						// 	$output2['coreq'] = '';
						// }

						$coreq_subs[] = [
							'coreq' => $this->db
							->select('c.classID')
							->get_where('class c, subject s', "c.subID = s.subID", 1)
							->row()->classID,
							'classID' => $classID
						];
					}
				}
				if(isset($output2['nograde'])){
					$output[] = 'Student did not have a grade in the required subject/s';
				}
				if(isset($output2['failed'])){
					$output[] = 'Student did not passed the required passing grade';
				}
				// if(isset($output2['coreq'])){
				// 	$output[] = 'Student must first enroll the corequisite subject';
				// }
				$output2 = [];
			}
			if($row['requisite_check2'] > 0){
				//subject has required yearlevel
				$query3 = $this->db->select('(SELECT y.duration FROM subject sub, year_req yr, year y WHERE yr.subID=sub.subID AND yr.yearID = y.yearID AND sub.subID = '.$subID.' LIMIT 1) year_req,
					(SELECT y.duration FROM student s, year y WHERE s.yearID=y.yearID AND s.studID = '.$studID.' LIMIT 1) student_year')->get();
				$row3 = $query3->row_array();
				if($row3['year_req'] > $row3['student_year']){
					$output[] = 'Student did not passed the required yearlevel';
				}
			}
			if($output){
				$failed_classes[] = ['classID'=>$classID,'reason'=>$output];
			}
			$output = [];	
		}

		if($coreq_subs){
			foreach($coreq_subs as $cs){
				if(!in_array($cs['coreq'], $subs_in_form)){
					$is_exist = false;
					$reason = 'Student must first enroll the corequisite subject';
					$i = 0;
					foreach($failed_classes as $fc){
						if($fc == $cs['classID']){
							array_push($failed_classes[$i]['reason'], $reason);
							$is_exist = true;
							break;
						}
						++$i;
					}
					if($is_exist == false){
						$failed_classes[] = ['classID' => $cs['classID'], 'reason' => [$reason]];	
					}
					
				}
			}
		}


		$this->db->trans_complete();
		echo json_encode($failed_classes);
	}

	function change_status($status, $termID){
		$studID = $this->input->post('studID');
		$this->db->trans_start();
		$this->db->query("UPDATE studclass INNER JOIN class ON studclass.classID = class.classID SET studclass.status = '$status' WHERE studID = $studID AND termID = $termID");
		if($status == 'Pending'){
			$this->db->query("UPDATE counter2 SET total = total + 1 WHERE module = 'enrol_requests'");
		}else if($status == 'Enrolled'){
			$this->db->query("UPDATE counter SET total = total + 1 WHERE module = 'enrol_studs' AND termID = $termID");
		}
		else{
			$this->db->query("UPDATE counter2 SET total = total - 1 WHERE module = 'enrol_requests'");
		}
		$this->db->trans_complete();
	}

	function password(){
		$pw = $this->input->post('pw');
		$query = $this->db->select('1')->get_where('enrolment_settings',"name = 'enrollment_pw' AND some_value = '$pw'",1);
		if($query->row()){
			echo 'success';
		}
	}

	function change_enrolStatus($termID){
		$data['some_value'] = $this->input->post('status');

		$this->db->trans_start();
		if($data['some_value'] == 'inactive'){
			$classes = $this->db->query("
				SELECT classID FROM class WHERE termID = $termID
			")->result();
			foreach($classes as $class){
				$this->db->delete('studclass', "classID = $class->classID AND status <> 'Enrolled'");
			}
			$this->db->query("UPDATE counter2 SET total = 0 WHERE module = 'enrol_requests'");
		}

		$this->db->update('enrolment_settings', $data, "name = 'status'");
		$this->db->trans_complete();
	}

	function get_sections($termID){
		$sql = $this->db->query("SELECT DISTINCT c.secID, s.secName FROM class c INNER JOIN section s ON c.secID = s.secID WHERE c.termID = $termID ORDER BY s.secName ASC")->result();
		echo json_encode($sql);
	}

	function get_classes($termID, $secID){
		$sql = $this->db->query("
			SELECT c.classID,s.subID,c.classCode,s.subDesc,s.lec,s.lab,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time,r.roomName,CONCAT(u.ln,', ',u.fn) faculty
			FROM class c 
			INNER JOIN subject s ON c.subID = s.subID
			INNER JOIN room r ON c.roomID = r.roomID
			INNER JOIN day d ON c.dayID = d.dayID
			INNER JOIN faculty f ON c.facID = f.facID
			INNER JOIN users u ON f.uID = u.uID 
			WHERE c.termID = $termID AND c.secID = $secID LIMIT 10 
		")->result();
		echo json_encode($sql);
	}

}

?>