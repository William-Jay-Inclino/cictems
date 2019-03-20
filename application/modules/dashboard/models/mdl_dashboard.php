<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Dashboard extends CI_Model{

	private $enrolled_students = [];

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
		$this->get_students($termID, $data);
		$this->get_courses($data);
		$this->get_years($data);
		$this->get_terms($termID, $data);
		echo json_encode($data);
	}

	function get_prevStudents($prevTermID){
		echo json_encode(
			$this->db->query("
				SELECT p.courseID, spt.yearID, spt.studID
				FROM studrec_per_term spt 
				INNER JOIN prospectus p ON spt.prosID = p.prosID 
				WHERE spt.termID = $prevTermID
			")->result()
		);

		// foreach($this->enrolled_students as $es){
		// 	$is_retain = false;

		// 	foreach($prevStudents as $ps){

		// 		if($ps->studID == $es->studID){
		// 			++$retention;
		// 			$is_retain = true;
		// 			break;
		// 		}
		// 	}

		// 	if(!$is_retain){
		// 		++$attrition;
		// 	}

		// }

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

	private function get_students($termID, &$data){
		$data['students'] = $this->db->query("
			SELECT p.courseID, spt.yearID, spt.status,spt.studID
			FROM studrec_per_term spt 
			INNER JOIN prospectus p ON spt.prosID = p.prosID 
			WHERE spt.termID = $termID
		")->result();
		$this->enrolled_students = $data['students'];
	}

	private function get_courses(&$data){
		$data['courses'] = $this->db->query("SELECT courseID, courseCode FROM course ORDER BY courseCode ASC")->result();
	}

	private function get_years(&$data){
		$data['years'] = $this->db->order_by('duration')->get('year')->result();
	}

	private function get_terms($termID, &$data){
		$sql = $this->db->query("SELECT t.schoolYear, s.semOrder FROM term t INNER JOIN semester s ON t.semID = s.semID WHERE termID = $termID LIMIT 1")->row();
		$data['current_term'] = ['schoolYear' => $sql->schoolYear, 'semOrder' => $sql->semOrder];
		$data['terms'] = $this->db->query("
			SELECT t.termID,t.schoolYear,s.semOrder, CONCAT(t.schoolYear,' ',s.semDesc) term 
			FROM term t 
			INNER JOIN semester s ON t.semID = s.semID 
			WHERE t.schoolYear <= '".$sql->schoolYear."' AND t.termID <> $termID
			ORDER BY t.schoolYear DESC, s.semOrder DESC
		")->result();
	}

}

?>