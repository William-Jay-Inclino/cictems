<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_auto_sched extends CI_Model{

	function populate($termID){
		$data['terms'] = $this->db->query("SELECT t.termID,s.semID, CONCAT(t.schoolYear,' ',s.semDesc) term FROM term t INNER JOIN semester s ON t.semID=s.semID ORDER BY t.schoolYear DESC, s.semOrder ASC")->result();
		$data['prospectuses'] = $this->db->query("SELECT prosID, prosCode, courseID FROM prospectus ORDER BY prosType, prosCode ASC")->result();
		$data['days'] = $this->db->get_where('day', "dayID <> 0")->result();
		$data['sections'] = $this->db->query("SELECT secID,yearID, secName, courseID FROM section WHERE semID = (SELECT semID FROM term WHERE termID = $termID LIMIT 1) ORDER BY secName ASC")->result();

		echo json_encode($data);
	}

	function createSchedule(){
		$is_conflict = ['room'=> false, 'faculty'=> false];
		$faculties = $facSpecs = $rooms = $roomSpecs = [];
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

		$roomIDs = $this->db->query("SELECT roomID FROM room WHERE status = 'active' AND roomID <> 0")->result();

		foreach($roomIDs as $r){
			$roomSpecs = $this->db->select('specID')->get_where('room_spec', "roomID = ".$r->roomID)->result();
			$rooms[] = ['roomID'=>$r->roomID, 'specIDs'=>$roomSpecs];
		}

		$facIDs = $this->db->query("SELECT facID FROM faculty f INNER JOIN users u ON f.uID=u.uID WHERE u.status = 'active' AND facID <> 0")->result();

		foreach($facIDs as $f){
			$facSpecs = $this->db->select('specID')->get_where('fac_spec', "facID = ".$f->facID)->result();
			$faculties[] = ['facID'=>$f->facID, 'specIDs'=>$facSpecs];
		}

		foreach($sections as $section){
			$is_sec_exist = $this->db->select('1')->get_where('class', "secID = ".$section['secID']." AND termID = ".$term['termID'], 1)->row();
			if($is_sec_exist){
				continue;
			}
			$secDT_holder = [];
			$subjects = $this->db->query("
				SELECT subID,specID,subCode,units,id,prosID FROM subject WHERE prosID = ".$section['prosID']." AND yearID = ".$section['yearID']." AND semID = ".$term['semID']."
			")->result();

			if($is_dt_auto == 'yes'){
				$noon_class = false;
				$last_added = null;
				foreach($subjects as $s){
					$is_moved_time = false;

					if($last_added){
						if($last_added['id'] == $s->id && $last_added['prosID'] == $s->prosID){
							//same subject but diff. unit and separated by lunch break
							//move last_added after lunch break
							if($this->is_break_separated($min_time, $last_added['timeOut'], $break_min_time, $break_max_time)){
								$this->move_last_added($min_time, $last_added);
								$min_time = $last_added['timeOut'];
							}
							
						}else{
							$rand_day = $this->random_day($days, $s);
						}
					}else{
						$rand_day = $this->random_day($days, $s);
					}

					$timeOut = $this->get_timeOut($min_time, $s->units, $rand_day['dayCount']);
					
					
					if($this->is_time_out_greater($timeOut,$break_min_time) && !$noon_class){ //lunch break
						$min_time = $break_max_time;
						$noon_class = true;
						$is_moved_time = true;
					}else if($this->is_time_out_greater($timeOut, $max_time)){ //time out should not exceed max time
						$min_time = $min_time2;
						if($last_added['id'] == $s->id && $last_added['prosID'] == $s->prosID){
							$this->move_last_added($min_time, $last_added);
							$min_time = $last_added['timeOut'];
						}
						$noon_class = false;
						$is_moved_time = true;
					}

					if($is_moved_time){
						$timeOut = $this->get_timeOut($min_time, $s->units, $rand_day['dayCount']);
					}
					
					if($secDT_holder){
						$this->check_section_conflict($secDT_holder, $min_time, $timeOut, $rand_day, $max_time, $min_time2, $break_min_time, $break_max_time, $last_added, $noon_class, $s);	
					}

					$data['timeIn'] = $min_time;
					$data['timeOut'] = $timeOut;
					$data['dayID'] = $rand_day['dayID'];
					$data['termID'] = $term['termID'];
					$data['subID'] = $s->subID;
					$data['secID'] = $section['secID'];
					$data['classCode'] = $s->subCode;
					$data['merge_with'] = 0;

					if($last_added['id'] == $s->id && $last_added['prosID'] == $s->prosID){
						$is_conflict = $this->checkConflicts($last_added, $data['timeOut'], $is_room_auto, $is_faculty_auto);
						if($is_conflict['room']){
							$last_added['roomID'] = $this->random_room($rooms, $s->specID, $term['termID'], $rand_day['dayID'], $last_added['timeIn'], $data['timeOut']);
						}
						if($is_conflict['faculty']){
							$last_added['facID'] = $this->random_faculty($faculties, $s->specID, $term['termID'], $rand_day['dayID'], $last_added['timeIn'], $data['timeOut']);
						}
						$data['roomID'] = $last_added['roomID'];
						$data['facID'] = $last_added['facID'];

						$update['timeIn'] = $last_added['timeIn'];
						$update['timeOut'] = $last_added['timeOut'];
						$update['roomID'] = $last_added['roomID'];
						$update['facID'] = $last_added['facID'];
						$this->db->update('class', $update, "classID = ".$last_added['classID']);
					}else{
						if($is_room_auto == 'yes'){
							$data['roomID'] = $this->random_room($rooms, $s->specID, $term['termID'], $rand_day['dayID'], $data['timeIn'], $data['timeOut']);
						}else{
							$data['roomID'] = 0;
						}
						if($is_faculty_auto == 'yes'){
							$data['facID'] = $this->random_faculty($faculties, $s->specID, $term['termID'], $rand_day['dayID'], $data['timeIn'], $data['timeOut']);
						}else{
							$data['facID'] = 0;
						}
					}

					$min_time = $timeOut;
					print_r($data);
					$this->db->insert('class', $data);
					$data['classID'] = $this->db->insert_id();
					$data['id'] = $s->id;
					$data['prosID'] = $s->prosID;
					$last_added = $data;
					$secDT_holder[] = [
						'classID'=>$data['classID'], 'timeIn'=>$data['timeIn'], 'timeOut'=> $data['timeOut'], 'dayID'=> $data['dayID']
					];

					array_splice($data, 10, 3);
				}

			}else{
				foreach($subjects as $s){
					$data['termID'] = $term['termID'];
					$data['subID'] = $s->subID;
					$data['secID'] = $section['secID'];
					$data['dayID'] = 0;
					$data['classCode'] = $s->subCode;
					$data['merge_with'] = 0;
					$data['roomID'] = $data['facID'] = 0;

					if($is_room_auto == 'yes'){
						$data['roomID'] = $this->random_room($rooms, $s->specID);
					}

					if($is_faculty_auto == 'yes'){
						$data['facID'] = $this->random_faculty($faculties, $s->specID);
					}
					$this->db->insert('class', $data);
				}
			}
		}

		$this->db->trans_complete();

	}

	function check_section_conflict($secDT_holder, &$timeIn, &$timeOut, $rand_day, $max_time, $min_time2, $break_min_time, $break_max_time, &$last_added, $noon_class, $s){
		$ctr = 0;
		while(true){
			$is_conflict = false;
			if($ctr == 48){
				break;
			}
			$is_moved_time = false;

			foreach($secDT_holder as $sec){

				if($sec['dayID'] == $rand_day['dayID'] && $timeOut > $sec['timeIn'] && $sec['timeOut'] > $timeIn){
					$is_conflict = true;
					break;
				}
			}
			if(!$is_conflict){
				break;
			}

			//add 30 mins. for every conflict
			$timeIn_mins = $this->convert_to_mins($timeIn);
			$timeOut_mins = $this->convert_to_mins($timeOut);
			$timeIn = $this->convert_to_hr($timeIn_mins + 30);
			$timeOut = $this->convert_to_hr($timeOut_mins + 30);

			//check again
			if($this->is_time_out_greater($timeOut,$break_min_time) && !$noon_class){ //lunch break
				$timeIn = $break_max_time;
				$noon_class = true;
				$is_moved_time = true;
			}else if($this->is_time_out_greater($timeOut, $max_time)){ //time out should not exceed max time
				$timeIn = $min_time2;
				if($last_added['id'] == $s->id && $last_added['prosID'] == $s->prosID){
					$this->move_last_added($timeIn, $last_added);
					$timeIn = $last_added['timeOut'];
				}
				$noon_class = false;
				$is_moved_time = true;
			}
			if($is_moved_time){
				$timeOut = $this->get_timeOut($timeIn, $s->units, $rand_day['dayCount']);
			}
			++$ctr;
		}

	}

	function convert_to_mins($time){
		$x = explode(':', $time);
		return ($x[0] * 60) + $x[1]; 
	}

	function convert_to_hr($time_in_mins){
		$hours = floor($time_in_mins / 60);
		$minutes = $time_in_mins % 60;
		if(strlen($hours) == 1){$hours = '0'.$hours;}
		if(strlen($minutes) == 1){$minutes = '0'.$minutes;}
		return $hours.':'.$minutes.':00';
	}

	function is_break_separated($min_time, $last_timeOut, $break_min_time, $break_max_time){
		$min_time = $this->convert_to_mins($min_time);
		$last_timeOut = $this->convert_to_mins($last_timeOut);
		$break_min_time = $this->convert_to_mins($break_min_time);
		$break_max_time = $this->convert_to_mins($break_max_time);

		return ($last_timeOut <= $break_min_time && $min_time >= $break_max_time) ? true : false;

	}

	function is_time_out_greater($timeOut,$break_min_time){
		$timeOut = $this->convert_to_mins($timeOut);
		$break_min_time = $this->convert_to_mins($break_min_time);
		
		return ($timeOut > $break_min_time) ? true : false;

	}

	function move_last_added($min_time,&$last_added){
		$timeIn = $this->convert_to_mins($last_added['timeIn']);
		$timeOut = $this->convert_to_mins($last_added['timeOut']);
		
		$timeRange = $timeOut - $timeIn;
		$min_time_mins = $this->convert_to_mins($min_time);
		$new_timeOut = $this->convert_to_hr($min_time_mins + $timeRange);

		$last_added['timeIn'] = $min_time;
		$last_added['timeOut'] = $new_timeOut;
	}

	function checkConflicts($last_added, $timeOut, $is_room_auto, $is_faculty_auto){
		$output['room'] = false;
		$output['faculty'] = false;

		if($is_room_auto){
			$is_conflict_room = $this->db->query("
				SELECT 1 FROM class WHERE termID = ".$last_added['termID']." AND dayID = ".$last_added['dayID']." AND roomID = ".$last_added['roomID']." AND '".$timeOut."' > timeIn AND timeOut > '".$last_added['timeIn']."' LIMIT 1
			")->row();
			if($is_conflict_room){
				$output['room'] = true;
			}
		}

		if($is_faculty_auto){
			$is_conflict_faculty = $this->db->query("
				SELECT 1 FROM class WHERE termID = ".$last_added['termID']." AND dayID = ".$last_added['dayID']." AND facID = ".$last_added['facID']." AND '".$timeOut."' > timeIn AND timeOut > '".$last_added['timeIn']."' LIMIT 1
			")->row();

			if($is_conflict_faculty){
				$output['faculty'] = true;
			}
		}
		
		return $output;
	}

	function get_timeOut($timeIn, $units, $dayCount){

		$range = ((60 * $units) / $dayCount); //minutes
		$timeIn = $this->convert_to_mins($timeIn);
		return $this->convert_to_hr($range + $timeIn);

	}

	function random_day($days, $subject){
		//subjects with lab should be TTH or the least day count
		$arr = null;
		//$selected_day = null;
		$sql = $this->db->query("SELECT 1 FROM subject WHERE prosID = ".$subject->prosID." AND id = ".$subject->id." AND subID <> ".$subject->subID." LIMIT 1")->row();

		foreach($days as $day){
			if(($subject->units % $day['dayCount'] == 0) && !$sql){
				$arr = $day;
				break;
			}
			if($arr){
				if($sql){ //is subject has lab, assign to the least day count
					if($day['dayCount'] < $arr['dayCount']){
						$arr = $day;
					}	
				}else{ //assign to the most day count
					if($day['dayCount'] > $arr['dayCount']){
						$arr = $day;
					}
				}
			}else{
				$arr = $day;
			}
		}
		
		return $arr;

	}

	function random_room($rooms, $sub_specID, $termID = NULL, $dayID = NULL, $timeIn = NULL, $timeOut = NULL){
		$rand_history = [];
		$roomID = $ctr = 0;
		$total_rooms = count($rooms);
		$ok = false;

		while(true){
			if($ctr == $total_rooms){
				break; //no faculty has specialization in the specified subject
			}
			$rand_index = array_rand($rooms, 1);

			if(in_array($rand_index, $rand_history)){
				continue;
			}

			foreach($rooms[$rand_index]['specIDs'] as $fspIDs){
				if($fspIDs->specID == $sub_specID){
					
					if(!$termID){
						$ok = true;
					}else{
						$is_conflict = $this->db->query("
							SELECT 1 FROM class WHERE termID = $termID AND dayID = $dayID AND roomID = ".$rooms[$rand_index]['roomID']." AND 
							'$timeOut' > timeIn AND timeOut > '$timeIn' LIMIT 1
						")->row();
						if(!$is_conflict){
							$ok = true;
						}
					}
					if($ok){
						$roomID = $rooms[$rand_index]['roomID'];
						break;
					}
					
				}
			}
			if($ok){
				break;
			}
			$rand_history[] = $rand_index;
			++$ctr;
		}
		return $roomID;
	}

	function random_faculty($faculties, $sub_specID, $termID = NULL, $dayID = NULL, $timeIn = NULL, $timeOut = NULL){
		$rand_history = [];
		$facID = $ctr = 0;
		$total_faculties = count($faculties);
		$ok = false;

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
					
					if(!$termID){
						$ok = true;
					}else{
						$is_conflict = $this->db->query("
							SELECT 1 FROM class WHERE termID = $termID AND dayID = $dayID AND facID = ".$faculties[$rand_index]['facID']." AND 
							'$timeOut' > timeIn AND timeOut > '$timeIn' LIMIT 1
						")->row();
						if(!$is_conflict){
							$ok = true;
						}
					}
					if($ok){
						$facID = $faculties[$rand_index]['facID'];
						break;
					}
					
				}
			}
			if($ok){
				break;
			}
			$rand_history[] = $rand_index;
			++$ctr;
		}
		return $facID;
	}

}

?>