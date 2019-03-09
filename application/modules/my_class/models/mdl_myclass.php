<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_myclass extends CI_Model{

	function grade_sheet($termID, $id, $prosID, $secID){

		$term = $this->db->query("SELECT s.semDesc, t.schoolYear FROM term t INNER JOIN semester s ON t.semID = s.semID WHERE termID = $termID LIMIT 1")->row();
		$data['sem'] = $term->semDesc;
		$data['sy'] = $term->schoolYear;

		$data['class'] = $this->db->query("
			SELECT c.classID,CONCAT(u.ln,', ',u.fn) as faculty,s.subCode,s.subDesc,c.status,sec.secName
			FROM class c 
			INNER JOIN faculty f ON c.facID = f.facID
			INNER JOIN users u ON f.uID = u.uID
			INNER JOIN subject s ON c.subID = s.subID
			INNER JOIN section sec ON c.secID = sec.secID
			WHERE c.facID = (SELECT facID FROM faculty WHERE uID = ".$this->session->userdata('uID').") AND c.termID = $termID AND s.id = $id AND s.prosID = $prosID AND c.secID = $secID LIMIT 1
			"
		)->row();

		$data['students'] = $this->db->query("
			SELECT s.studID,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name,
			sc.prelim,sc.midterm,sc.prefi,sc.final,sc.finalgrade,UPPER(sc.remarks) remarks,
			(SELECT metric FROM grade_metric WHERE grade = ROUND(sc.finalgrade) LIMIT 1) equiv
			FROM studclass sc
			INNER JOIN student s ON sc.studID = s.studID
			INNER JOIN users u ON s.uID = u.uID
			AND sc.classID = ".$data['class']->classID."
			ORDER BY name ASC
		")->result();
		//die(var_dump($data['students']));
		$grades = $this->db->order_by('metric','ASC')->get('grade_metric')->result();

		$arr = $new_grade = $new_grade2 = $new_grade3 = [];

		foreach($grades as $grade){

			$exist = false;
			$arr_grade = $remove = [];

			if(in_array($grade->metric, $arr)){
				$exist = true;
			}

			if($exist){
				$i = 0;
				foreach($new_grade as $ng){
					if($ng['metric'] == $grade->metric){
						foreach($ng['grade'] as $ngg){
							$arr_grade[] = $ngg;	
						}
						$arr_grade[] = $grade->grade;
						array_splice($new_grade, $i, 1);
						break;
					}
					++$i;
				}
			}else{
				$arr_grade[] = $grade->grade;
			}
			$new_grade[] = ['metric'=>$grade->metric, 'grade' => $arr_grade];
			$arr[] = $grade->metric;
		}

		foreach($new_grade as $ng){
			if(count($ng['grade']) > 1){
				$x = min($ng['grade']).'-'.max($ng['grade']);	
			}else{
				$x = $ng['grade'][0];
			}
			
			$new_grade2[] = ['metric'=>$ng['metric'], 'grade'=>$x];
		}

		$data['grades'] = $new_grade2;

		return $data;
	}

	function saveGrade(){
		$has_error = false;
		$prelim = $midterm = $prefi = $final = $remarks = $fg = $equiv = '';

		$studID = $this->input->post('studID');

		$classIDs = $this->input->post('classIDs');
		$classID = $classIDs[0];

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

			foreach($classIDs as $c){
				$this->db->update('studclass', $data, "studID = $studID AND classID = ".$c);
			}


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

			foreach($classIDs as $c){
				$this->db->update('studclass',['finalgrade'=>$fg,'remarks'=>$remarks], "classID = ".$c." and studID = $studID");
			}


			$this->db->trans_complete();
			echo json_encode([
				'prelim'=>$g->prelim, 'midterm'=>$g->midterm, 'prefi'=>$g->prefi, 'final'=>$g->final, 'finalgrade'=>$fg, 'equiv'=>$equiv, 'remarks'=>$remarks
			]);

		}

		
	}

	function get_classes($termID){
		echo json_encode(
			$this->db->query("
				SELECT DISTINCT c.termID,s.id,s.prosID,s.subCode,s.id,s.subDesc,sec.secName,c.status,c.secID
				FROM class c 
				INNER JOIN subject s ON c.subID = s.subID
				INNER JOIN section sec ON c.secID = sec.secID
				WHERE termID = $termID AND c.facID = (SELECT facID FROM faculty WHERE uID = ".$this->session->userdata('uID').")
				"
			)->result()
		);
	}

	function populate_class_sel($termID, $id, $prosID,$secID){
		$data['class'] = $this->db->query("
			SELECT c.classID,CONCAT(u.ln,', ',u.fn) as faculty,s.type,s.subCode,s.subDesc,d.dayDesc,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time, c.status,r.roomName,sec.secName,c.date_submitted
			FROM class c 
			INNER JOIN faculty f ON c.facID = f.facID
			INNER JOIN users u ON f.uID = u.uID
			INNER JOIN subject s ON c.subID = s.subID
			INNER JOIN room r ON c.roomID = r.roomID
			INNER JOIN day d ON c.dayID = d.dayID
			INNER JOIN section sec ON c.secID = sec.secID
			WHERE c.facID = (SELECT facID FROM faculty WHERE uID = ".$this->session->userdata('uID').") AND c.termID = $termID AND s.id = $id AND s.prosID = $prosID AND c.secID = $secID
			"
		)->result();

		$data['students'] = $this->db->query("
			SELECT s.studID,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name,
			sc.prelim,sc.midterm,sc.prefi,sc.final,sc.finalgrade,sc.remarks,
			(SELECT metric FROM grade_metric WHERE grade = ROUND(sc.finalgrade) LIMIT 1) equiv
			FROM studclass sc
			INNER JOIN student s ON sc.studID = s.studID
			INNER JOIN users u ON s.uID = u.uID
			WHERE sc.status = 'Enrolled' AND sc.classID = ".$data['class'][0]->classID."
			ORDER BY name ASC
		")->result();

		echo json_encode($data);
	}

	// function fetch_Students($classID){
	// 	$query = $this->db->query("
	// 		SELECT s.studID,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name,
	// 		sc.prelim,sc.midterm,sc.prefi,sc.final,sc.finalgrade,sc.remarks,
	// 		(SELECT metric FROM grade_metric WHERE grade = ROUND(sc.finalgrade) LIMIT 1) equiv
	// 		FROM studclass sc
	// 		INNER JOIN student s ON sc.studID = s.studID
	// 		INNER JOIN users u ON s.uID = u.uID
	// 		AND sc.classID = $classID
	// 	");
	// 	echo json_encode($query->result());
	// }

	function add_student(){
		$classIDs = $this->input->post('classIDs');
		$studID = $this->input->post('studID');

		$this->db->trans_start();

		$ctr = 0;
		foreach($classIDs as $c){
			$query = $this->db->select('1')->get_where('studclass', "classID = ".$c." AND studID = $studID");
			if($query->row()){
				die('exist');
			}else{
				if($ctr == 0){
					$termID = $this->db->select('termID')->get_where('class', "classID = ".$c, 1)->row()->termID;
					$sql = $this->db->query("SELECT 1 FROM studclass sc INNER JOIN class c ON sc.classID = c.classID WHERE sc.studID = $studID AND c.termID = $termID LIMIT 1")->row();
					if(!$sql){
						$check_ctr = $this->db->query("SELECT 1 FROM counter WHERE module = 'enrol_studs' AND termID = $termID LIMIT 1")->row();
						if($check_ctr){
							$this->db->query("UPDATE counter SET total = total + 1 WHERE module = 'enrol_studs' AND termID = $termID");
						}else{
							$this->db->query("INSERT counter(module,termID,total) VALUES('enrol_studs', $termID, 1)");		
						}
					}
				}
				
				$this->db->insert('studclass',['studID'=>$studID,'classID'=>$c,'status'=>'Enrolled']);

				// $query2 = $this->db->query("
				// 	SELECT s.studID,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name,
				// 	sc.prelim,sc.midterm,sc.prefi,sc.final,sc.finalgrade,sc.remarks
				// 	FROM studclass sc
				// 	INNER JOIN student s ON sc.studID = s.studID
				// 	INNER JOIN users u ON s.uID = u.uID
				// 	AND sc.classID = ".$c['classID']." AND sc.studID = $studID
				// ");

			}	
			++$ctr;
		}

		$this->db->trans_complete();
		// echo json_encode($query2->row());

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
		$basic  = new \Nexmo\Client\Credentials\Basic('40a92841', 'shf74GcIMk3uvizb');
		$client = new \Nexmo\Client($basic);

		$ids = $this->input->post('classIDs');
		$id = $ids[0];

		$value = $this->input->post('value');
		$classes = [];
		$this->db->trans_start();

		$msgData = $this->db->query("SELECT c.classCode, CONCAT(u.fn,' ',u.ln) faculty FROM class c INNER JOIN faculty f ON c.facID = f.facID INNER JOIN users u ON f.uID = u.uID WHERE c.classID = $id LIMIT 1")->row();

		$password = $this->db->select('userPass')->get_where('users',"uID = ".$this->session->userdata('uID'), 1)->row()->userPass;

		if($value == $password){

			foreach($ids as $id){
				$classes[] = $this->db->query("
					SELECT c.subID, f.uID,c.termID FROM class c 
					INNER JOIN faculty f ON c.facID = f.facID 
					WHERE c.classID = ".$id." LIMIT 1
				")->row();
			}
			
			$students = $this->db->query("SELECT studID,finalgrade,remarks FROM studclass WHERE classID = $id")->result();
			
			foreach($students as $student){
				$equiv = $this->get_metric_grade($student->finalgrade);
				if($student->remarks == 'Incomplete'){
					$equiv = 0.0;
				}

				foreach($classes as $class){
					$this->db->insert('studgrade',['studID'=>$student->studID, 'subID'=>$class->subID, 'uID'=>$class->uID, 'termID'=>$class->termID, 'sgGrade'=>$equiv, 'remarks'=>$student->remarks ,'grade_type'=>'Class']);
				}

				if($this->send_sms($student, $equiv, $msgData, $client)){
					//echo "sent";
				}

			}

			foreach($ids as $id){
				$this->db->query("UPDATE class SET date_submitted = NOW(), status = 'locked' WHERE classID = ".$id);
				$ds = $this->db->query("SELECT date_submitted FROM class WHERE classID = ".$id)->row()->date_submitted;
			}

			
			$output = ['status'=>'success','date_submitted'=>$ds];
			
		}else{
			$output = ['status'=>'error'];
		}
		$this->db->trans_complete();
		echo json_encode($output);
	}

	function send_sms($student, $equiv, $msgData, $client){
		$msg = '';
		$sql = $this->db->query("
			SELECT u.cn FROM student s INNER JOIN users u ON s.uID = u.uID WHERE s.studID = ".$student->studID." LIMIT 1
		")->row();

		if(!$sql){
			return false;
		}else{
			$msg .= "Class ".$msgData->classCode." have been submitted by ".$msgData->faculty.". ";
			if($student->remarks == 'Incomplete'){
				$msg .= 'Your remark is INC';
			}else{
				$msg .= 'Your remark is '.$student->remarks.' and your grade is '.$equiv;
			}
			$msg .= "\n\nFrom the College of ICTE WLC.\n\n";
			$msg .= '.';

			try{
				$message = $client->message()->send([
				    'to' => '63'.$sql->cn,
				    'from' => 'CICTE Dep. of WLC',
				    'text' => $msg
				]);	
				return true;
			}catch(Exception $e){
				return false;
			}
			// $message = $client->message()->send([
			//     'to' => '63'.$sql->cn,
			//     'from' => 'CICTE Dep. of WLC',
			//     'text' => $msg
			// ]);
		}

		
	}



}

?>