<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_auto_sched extends CI_Model{

	function populate($termID){
		$data['terms'] = $this->db->query("SELECT t.termID,s.semID, CONCAT(t.schoolYear,' ',s.semDesc) term FROM term t INNER JOIN semester s ON t.semID=s.semID ORDER BY t.schoolYear DESC, s.semOrder ASC")->result();
		$data['prospectuses'] = $this->db->query("SELECT prosID, prosCode, courseID FROM prospectus ORDER BY prosType, prosCode ASC")->result();
		$data['days'] = $this->db->get_where('day', "dayID <> 0")->result();
		$data['sections'] = $this->db->query("SELECT secID,yearID, secName, courseID FROM section WHERE semID = (SELECT semID FROM term WHERE termID = $termID LIMIT 1)")->result();

		echo json_encode($data);
	}

	function get_sections($termID, $prosID){
		echo $termID.' '.$prosID;
	}

	function createSchedule(){
		$faculties = $facSpecs = [];
		$term = $this->input->post('term');
		$is_dt_auto = $this->input->post('is_dt_auto');
		$is_room_auto = $this->input->post('is_room_auto');
		$is_faculty_auto = $this->input->post('is_faculty_auto');
		$min_time = $this->input->post('min_time');
		$min_time2 = $min_time;
		$max_time = $this->input->post('max_time');
		$break_min_time = $this->input->post('break_min_time');
		$break_max_time = $this->input->post('break_max_time');
		$sections = $this->input->post('section');
		$days = $this->input->post('day');

		$this->db->trans_start();

		$rooms = $this->db->query("SELECT roomID, specID FROM room WHERE status = 'active' AND roomID <> 0")->result();
		if(!$rooms && $is_room_auto){
			die('No room');
		}
		$facIDs = $this->db->query("SELECT facID FROM faculty f INNER JOIN users u ON f.uID=u.uID WHERE u.status = 'active' AND facID <> 0")->result();

		if(!$facIDs && $is_faculty_auto){
			die('No Faculty');
		}

		foreach($facIDs as $f){
			$facSpecs = $this->db->select('specID')->get_where('fac_spec', "facID = ".$f->facID)->result();
			$faculties[] = ['facID'=>$f->facID, 'specIDs'=>$facSpecs];
		}

		foreach($sections as $section){
			$is_sec_exist = $this->db->select('1')->get_where('class', "secID = ".$section['secID']." AND termID = ".$term['termID'], 1)->row();
			if($is_sec_exist){
				continue;
			}

			$class = [];

			$subjects = $this->db->query("
				SELECT subID,specID,subCode,units FROM subject WHERE prosID = ".$section['prosID']." AND yearID = ".$section['yearID']." AND semID = ".$term['semID']."
			")->result();

			if($is_dt_auto == 'yes'){
				$noon_class = false;
				foreach($subjects as $s){
					$rand_day = $days[array_rand($days, 1)];
					$dayID = $rand_day['dayID'];
					$dayCount = $rand_day['dayCount'];
					
					$timeOut = $this->get_timeOut($min_time, $s->units, $dayCount);

					//lunch break
					if(strtotime($timeOut) > strtotime($break_min_time) && !$noon_class){
						$min_time = $break_max_time;
						$timeOut = $this->get_timeOut($min_time, $s->units, $dayCount);
						$noon_class = true;
					}

					//time out should not exceed max time
					if(strtotime($timeOut) > strtotime($max_time)){
						$min_time = $min_time2;
						$noon_class = false;
						continue;
					}
					
					$data['timeIn'] = $min_time;
					$data['timeOut'] = $timeOut;
					$data['dayID'] = $dayID;
					$data['termID'] = $term['termID'];
					$data['subID'] = $s->subID;
					$data['secID'] = $section['secID'];
					$data['classCode'] = $s->subCode;
					$data['merge_with'] = 0;
					$roomID = $facID = 0;

					if($is_room_auto == 'yes'){
						$roomID = $this->random_room($rooms, $s->specID, $term['termID'], $dayID, $min_time, $timeOut);
					}
					if($is_faculty_auto == 'yes'){
						$facID = $this->random_faculty($faculties, $s->specID, $term['termID'], $dayID, $min_time, $timeOut);
					}
					$data['roomID'] = $roomID;
					$data['facID'] = $facID;
					$min_time = $timeOut;
					print_r($data);

					//die(print_r($data));
					//$this->db->insert('class', $data);
				}

			}else{
				foreach($subjects as $s){
					$data['termID'] = $term['termID'];
					$data['subID'] = $s->subID;
					$data['secID'] = $section['secID'];
					$data['dayID'] = 0;
					$data['classCode'] = $s->subCode;
					$data['merge_with'] = 0;
					$roomID = $facID = 0;

					if($is_room_auto == 'yes'){
						$roomID = $this->random_room($rooms, $s->specID);
					}

					if($is_faculty_auto == 'yes'){
						$facID = $this->random_faculty($faculties, $s->specID);
					}

					$data['roomID'] = $roomID;
					$data['facID'] = $facID;
					$this->db->insert('class', $data);
				}
			}
		}

		$this->db->trans_complete();

	}

	function get_timeOut($timeIn, $units, $dayCount){

		$range = ((60 * $units) / $dayCount); //minutes
		// $hours = floor($range / 60);
		// $minutes = $range % 60;

		// $timeRange = '0'.$hours.':'.$minutes.':00';

		$parts = explode(':', $timeIn);
		$timeIn_mins = ($parts[0] * 60) + $parts[1];

		$timeOut_mins = $range + $timeIn_mins;
		$hours = floor($timeOut_mins / 60);
		$minutes = $timeOut_mins % 60;

		if(strlen($hours) == 1){$hours = '0'.$hours;}
		if(strlen($minutes) == 1){$minutes = '0'.$minutes;}

		return $hours.':'.$minutes.':00';

		//return date("h:i", strtotime($timeOut_mins));
	}

	function random_room($rooms, $sub_specID, $termID = NULL, $dayID = NULL, $timeIn = NULL, $timeOut = NULL){
		$rand_history = [];
		$roomID = 0;
		$total_rooms = count($rooms);
		$ctr = 0;
		while(true){
			if($ctr == $total_rooms){
				break; //no room has specialization in the specified subject
			}
			$rand_index = array_rand($rooms, 1);
			if(in_array($rand_index, $rand_history)){
				continue;
			}
			if($rooms[$rand_index]->specID == $sub_specID){
				$roomID = $rooms[$rand_index]->roomID;
				if(!$termID){
					break;
				}else{
					$is_conflict = $this->db->query("
						SELECT 1 FROM class WHERE termID = $termID AND dayID = $dayID AND roomID = $roomID AND 
						'$timeOut' > timeIn AND timeOut > '$timeIn'
					")->row();
					if(!$is_conflict){
						break;
					}
				}
			}

			$rand_history[] = $rand_index;
			++$ctr;
		}

		return $roomID;
	}

	function random_faculty($faculties, $sub_specID, $termID = NULL, $dayID = NULL, $timeIn = NULL, $timeOut = NULL){
		$rand_history = [];
		$facID = 0;
		$total_faculties = count($faculties);
		$ctr = 0;
		while(true){
			if($ctr == $total_faculties){
				break; //no faculty has specialization in the specified subject
			}
			$rand_index = array_rand($faculties, 1);

			if(in_array($rand_index, $rand_history)){
				continue;
			}

			foreach($faculties[$rand_index]['specIDs'] as $fspIDs){
				if($fspIDs->specID == $sub_specID){
					$facID = $faculties[$rand_index]['facID'];
					if(!$termID){
						break;
					}else{
						$is_conflict = $this->db->query("
							SELECT classCode,secID FROM class WHERE termID = $termID AND dayID = $dayID AND facID = $facID AND 
							'$timeOut' > timeIn AND timeOut > '$timeIn'
						")->row();
						if(!$is_conflict){
							break;
						}
					}
					
				}
			}
			$rand_history[] = $rand_index;
			++$ctr;
		}
		return $facID;
	}

}

?>