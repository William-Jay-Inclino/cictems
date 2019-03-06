<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Deans_List extends CI_Model{
	private $termID;
	/*
		qualifications for deans list:
		1. Min units of 12 & max of 29
		2. No grade of 5.0 & INC in the current and past semesters
		3a. A GWA of 1.0 - 1.29 = 100% tuition fee
		3b. A GWA of 1.30 - 1.50 = 50% tuition fee
	*/

	function populate($termID){
		$data = [];
		$this->termID = $termID;
		$reqs = $this->db->query("SELECT * FROM deanslist_reqs WHERE termID = $termID AND NOT(discount = '' AND min_units = 0 AND max_units = 0 AND min_gwa = 0.00 AND max_gwa = 0.00) ORDER BY discount DESC")->result();

		$students =$this->db->query("
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
			ORDER BY c.courseCode,y.yearDesc,name ASC
		")->result();

		//check qualifications for deans list

		foreach($students as $student){
			$classes = $this->db->query("
				SELECT c.classID,s.subID,s.id,s.total_units,s.prosID,sc.prelim,sc.midterm,sc.prefi,sc.final,sc.finalgrade,sc.remarks
				FROM studclass sc  
				INNER JOIN class c ON sc.classID = c.classID 
				INNER JOIN subject s ON c.subID = s.subID
				WHERE sc.studID = ".$student->studID."
			")->result();

			$result = $this->is_qualified($classes, $reqs, $student->studID);

			if($result['is_qualified']){
				$data[] = ['student' => $student, 'gwa' => $result['gwa'], 'discount' => $result['discount']];
			}

			
		}
		echo json_encode($data);
	}

	private function is_qualified($classes, $reqs, $studID){
		$gwa = $discount =  '';
		$is_qualified = $unit_qualified = $gwa_qualified = $grade_qualified = false;
		$total_units = 0;
		$container = [];

		//get total units
		foreach($classes as $class){
			$is_exist = false;
			foreach($container as $c){
				if($c['id'] == $class->id && $c['prosID'] == $class->prosID){
					$is_exist = true;
					break;
				}
			}

			if(!$is_exist){
				$total_units += $class->total_units;
				$container[] = ['id' => $class->id, 'prosID' => $class->prosID, 'subID' => $class->subID, 'units' => $class->total_units];
			}
		}

		foreach($reqs as $r){
			if($total_units >= $r->min_units && $total_units <= $r->max_units){
				$unit_qualified = true;
				break;
			}

		}	
		
		if($unit_qualified){
			$is_invalid_grade = $this->db->select('1')->get_where('studgrade', "studID = $studID AND remarks <> 'Passed'", 1)->row();
			if(!$is_invalid_grade){
				$grade_qualified = true;
			}
		}

		if($grade_qualified){
			$result = $this->is_gwa_qualified($studID, $total_units, $container, $reqs);
			$gwa_qualified = $result['is_qualified'];
			$gwa = $result['gwa'];
			$discount = $result['discount'];
		}

		if($gwa_qualified){
			$is_qualified = true;
		}

		return ['is_qualified' => $is_qualified, 'gwa' => $gwa, 'discount' => $discount];
	
	}

	private function is_gwa_qualified($studID, $total_units, $container, $reqs){
		$discount = '';
		$is_qualified = false;
		$arr = [];
		$classes = $this->db->query("
			SELECT sgGrade,subID
			FROM studgrade 
			WHERE studID = $studID AND grade_type = 'Class' AND termID = ".$this->termID."
		")->result();

		foreach($classes as $class){
			foreach($container as $cont){
				if($class->subID == $cont['subID']){
					$arr[] = $class->sgGrade * $cont['units'];
					break;
				}
			}
		}

		$y = array_sum($arr);
		$gwa = round(($y / $total_units), 2);

		foreach($reqs as $r){
			if($gwa >= $r->min_gwa && $gwa <= $r->max_gwa){
				$discount = $r->discount;
				$is_qualified = true;
				break;
			}
		}

		return ['gwa' => $gwa, 'is_qualified' => $is_qualified, 'discount' => $discount];

	}

}

?>