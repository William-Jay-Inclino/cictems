<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Dashboard extends CI_Model{

	function populate($termID){

		// $cnt = $this->db->query("SELECT total FROM counter2")->result();

		// $data['terms'] = $cnt[0]->total;
		// $data['rooms'] = $cnt[1]->total;
		// $data['courses'] = $cnt[2]->total;
		// $data['prospectus'] = $cnt[3]->total;
		// $data['sections'] = $cnt[4]->total;
		// $facTotal = $cnt[5]->total;
		// $data['subjects'] = $cnt[6]->total;
		// $stafTotal = $cnt[7]->total;
		// $data['days'] = $cnt[11]->total;

		$data['faculties'] = $this->db->query("SELECT 1 FROM faculty f INNER JOIN users u ON f.uID = u.uID WHERE u.status = 'active' AND f.facID <> 0")->num_rows();
		$data['staffs'] = $this->db->query("SELECT 1 FROM staff s INNER JOIN users u ON s.uID = u.uID WHERE u.status = 'active'")->num_rows();

		$sql = $this->db->query("SELECT total FROM counter WHERE module = 'enrol_studs' AND termID = $termID LIMIT 1")->row();
		if($sql){
			$data['students'] = $sql->total;
		}else{
			$data['students'] = 0;
		}

		// $sql2 = $this->db->query("SELECT total FROM counter WHERE module = 'fees' AND termID = $termID LIMIT 1")->row();
		// if($sql2){
		// 	$data['fees'] = $sql2->total;
		// }else{
		// 	$data['fees'] = 0;
		// }

		//die(print_r($data['subjects2']));

		return $data;
	}

	function get_total_remarks($students){
		$passed = $failed = $inc = $dropped = $total_students = 0;

		foreach($students as $student){
			if($student->remarks == "Passed"){
				$passed += 1;
			}else if($student->remarks == "Failed"){
				$failed += 1;
			}else if($student->remarks == "Incomplete"){
				$inc += 1;
			}else if($student->remarks == "Dropped"){
				$dropped += 1;
			}
		}

		return [
			'passed' => $passed,
			'failed' => $failed,
			'inc' => $inc,
			'dropped' => $dropped
		];
		
	}

	function get_percentage(&$subjects){
		$i = 0;
		foreach($subjects as $subject){
			$subjects[$i]->passed_per = $subjects[$i]->failed_per = $subjects[$i]->inc_per = $subjects[$i]->dropped_per = '';

			if($subject->total_students > 0){
				$subjects[$i]->passed_per = (number_format(($subject->passed / $subject->total_students) * 100, 2, '.', '')).'%';
				$subjects[$i]->failed_per = (number_format(($subject->failed / $subject->total_students) * 100, 2, '.', '')).'%';
				$subjects[$i]->inc_per = (number_format(($subject->inc / $subject->total_students) * 100, 2, '.', '')).'%';
				$subjects[$i]->dropped_per = (number_format(($subject->dropped / $subject->total_students) * 100, 2, '.', '')).'%';
			}

			++$i;
		}
	}

	function populate2($termID){
		$this->get_subjects($termID, $data);
		$this->percentage_new_old_trans($termID, $data);
		$this->get_courses($data);
		$this->get_years($data);
		echo json_encode($data);
	}

	private function get_subjects($termID, &$data){
		$subjects = $this->db->query("SELECT c.classID,c.subID,s.subCode,s.subDesc,s.id,CONCAT(s.subCode,' | ',s.subDesc) subLabel FROM class c INNER JOIN subject s ON c.subID = s.subID WHERE c.termID = $termID AND c.status = 'locked'")->result();

		$sub_container = [];

		foreach($subjects as $subject){
			$exist = false;

			$students = $this->db->query("SELECT remarks FROM studclass WHERE classID = ".$subject->classID);
			$total_students = $students->num_rows();

			$i = 0;
			foreach($sub_container as $container){
				if($subject->subID == $container->subID){
					$sub_container[$i]->total_students += $total_students;

					$remarks = $this->get_total_remarks($students->result());
					
					$sub_container[$i]->passed += $remarks['passed'];
					$sub_container[$i]->failed += $remarks['failed'];
					$sub_container[$i]->inc += $remarks['inc'];
					$sub_container[$i]->dropped += $remarks['dropped'];

					$exist = true;
					break;
				}
				++$i;
			}

			if(!$exist){
				$subject->total_students = $total_students;
				$remarks = $this->get_total_remarks($students->result());
				$subject->passed = $remarks['passed'];
				$subject->failed = $remarks['failed'];
				$subject->inc = $remarks['inc'];
				$subject->dropped = $remarks['dropped'];
				$sub_container[] = $subject;
			}
		}

		$this->get_percentage($sub_container);
		$data['subjects'] = $sub_container;
		// echo json_encode($sub_container);
	}

	private function percentage_new_old_trans($termID, &$data){
		$data['students'] = $this->db->query("
			SELECT c.courseCode, y.yearDesc, spt.status,
			(SELECT CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) FROM users u INNER JOIN student s ON u.uID = s.uID WHERE s.studID = spt.studID LIMIT 1) name
			FROM studrec_per_term spt 
			INNER JOIN year y ON spt.yearID = y.yearID 
			INNER JOIN prospectus p ON spt.prosID = p.prosID 
			INNER JOIN course c ON p.courseID = c.courseID  
			WHERE spt.termID = $termID
		")->result();
	}

	private function get_courses(&$data){
		$data['courses'] = $this->db->query("SELECT courseID, courseCode FROM course ORDER BY courseCode ASC")->result();
	}

	private function get_years(&$data){
		$data['years'] = $this->db->order_by('duration')->get('year')->result();
	}


}

?>