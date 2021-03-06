<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_auto_sched extends CI_Model{

	function populate($termID){
		$data['terms'] = $this->db->query("SELECT t.termID,s.semID, CONCAT(t.schoolYear,' ',s.semDesc) term FROM term t INNER JOIN semester s ON t.semID=s.semID ORDER BY t.schoolYear DESC, s.semOrder DESC")->result();
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
				SELECT s.subID,s.specID,s.subCode,s.units,s.id,s.prosID,s.hrs_per_week,(SELECT subID FROM subject WHERE id = s.id AND prosID = s.prosID AND subID <> s.subID LIMIT 1) subID2
				FROM subject s
				WHERE s.prosID = ".$section['prosID']." AND s.yearID = ".$section['yearID']." AND s.semID = ".$term['semID']."
			")->result();

			if($is_dt_auto == 'yes'){
				$noon_class = false;
				$last_added = null;

				foreach($subjects as $s){

					if($secDT_holder){
						$last_added = end($secDT_holder);
						if($last_added['id'] != $s->id){
							$rand_day = $this->random_day($days, $s, $last_added);
						}
					}else{
						$rand_day = $this->random_day($days, $s);
					}

					if($secDT_holder){
						//get day and time with no conflict in this section
						$ctr = 0;
						while(true){ 

							if($ctr == 48){ //there are 48 30 minutes in 1 day
								// break;
								while(true){
									$day = $days[array_rand($days, 1)];
									if($day['dayID'] != $rand_day['dayID']){
										$rand_day = $day;
										if($last_added['id'] == $s->id && $last_added['prosID'] == $s->prosID){
											$last_added['dayID'] = $rand_day['dayID'];
											$last_added['timeIn'] = $min_time2;
											$last_added['timeOut'] = $this->get_timeOut($min_time2, $s->units, $rand_day['dayCount'], $s->subID2, $s->hrs_per_week);
											$min_time = $last_added['timeOut'];
										}
										break;
									}
								}
								$ctr = 0;
							}

							$timeOut = $this->get_timeOut($min_time, $s->units, $rand_day['dayCount'], $s->subID2, $s->hrs_per_week);

							if(($this->convert_to_mins($timeOut) > $this->convert_to_mins($break_min_time)) && !$noon_class){ //lunch break
								if($last_added['id'] == $s->id && $last_added['prosID'] == $s->prosID){
									$this->move_last_added($last_added, $break_max_time, $secDT_holder, $rand_day);
									$min_time = $last_added['timeOut'];
								}else{
									$min_time = $break_max_time;
								}
								$timeOut = $this->get_timeOut($min_time, $s->units, $rand_day['dayCount'], $s->subID2, $s->hrs_per_week);
								$noon_class = true;
							}else if(($this->convert_to_mins($timeOut) > $this->convert_to_mins($max_time)) && $noon_class){ //time out should not exceed max time
								if($last_added['id'] == $s->id && $last_added['prosID'] == $s->prosID){
									$this->move_last_added($last_added,$min_time2, $secDT_holder, $rand_day);
									$min_time = $last_added['timeOut'];
								}else{
									$min_time = $min_time2;
								}
								$timeOut = $this->get_timeOut($min_time, $s->units, $rand_day['dayCount'], $s->subID2, $s->hrs_per_week);
								$noon_class = false;
							}

							if(!$this->section_conflict($secDT_holder, $rand_day, $min_time, $timeOut)){
								break;
							}else{
								if($last_added['id'] == $s->id && $last_added['prosID'] == $s->prosID){
									$this->move_last_added($last_added, $min_time, $secDT_holder, $rand_day);
									$min_time = $last_added['timeOut'];
								}
							}
							++$ctr;
						}
					}else{
						$timeOut = $this->get_timeOut($min_time, $s->units, $rand_day['dayCount'], $s->subID2, $s->hrs_per_week);
					}
					

					$data['timeIn'] = $min_time;
					$data['timeOut'] = $timeOut;
					$data['dayID'] = $rand_day['dayID'];
					$data['termID'] = $term['termID'];
					$data['subID'] = $s->subID;
					$data['secID'] = $section['secID'];
					$data['classCode'] = $s->subCode;
					$data['merge_with'] = 0;

					if($last_added['id'] == $s->id && $last_added['prosID'] == $s->prosID){ //same subj w/ diff unit type
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
						$update['dayID'] = $last_added['dayID'];
						$this->db->update('class', $update, "classID = ".$last_added['classID']);
						$this->update_section_holder($secDT_holder, $last_added);

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
					$secDT_holder[] = [
						'classID' => $this->db->insert_id(), 
						'timeIn' => $data['timeIn'], 
						'timeOut' => $data['timeOut'], 
						'dayID' => $data['dayID'], 
						'id' => $s->id, 
						'prosID' => $s->prosID,
						'termID' => $data['termID'],
						'roomID' => $data['roomID'],
						'facID' => $data['facID'],
						'subID' => $s->subID
					];

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

	function update_section_holder(&$secDT_holder, $last_added){
		$z = 0;
		foreach($secDT_holder as $s){
			if($s['classID'] == $last_added['classID']){
				$secDT_holder[$z]['timeIn'] = $last_added['timeIn'];
				$secDT_holder[$z]['timeOut'] = $last_added['timeOut'];
				$secDT_holder[$z]['roomID'] = $last_added['roomID'];
				$secDT_holder[$z]['facID'] = $last_added['facID'];
			}
			++$z;
		}
	}

	function section_conflict($secDT_holder, $rand_day, &$min_time, &$timeOut, $classID = 0){
		$is_conflict = false;

		foreach($secDT_holder as $sec){
			if($sec['dayID'] == $rand_day['dayID'] && $timeOut > $sec['timeIn'] && $sec['timeOut'] > $min_time && $sec['classID'] != $classID){
				$is_conflict = true;
				break;
			}
		}

		if($is_conflict){
			$timeIn_mins = $this->convert_to_mins($min_time);
			$timeOut_mins = $this->convert_to_mins($timeOut);
			$min_time = $this->convert_to_hr($timeIn_mins + 30);
			$timeOut = $this->convert_to_hr($timeOut_mins + 30); 
		}

		return $is_conflict;

	}

	function move_last_added(&$last_added, $new_timeIn, $secDT_holder, $rand_day){
		$timeIn = $this->convert_to_mins($last_added['timeIn']);
		$timeOut = $this->convert_to_mins($last_added['timeOut']);
		$timeRange = $timeOut - $timeIn;

		$new_timeIn_mins = $this->convert_to_mins($new_timeIn);
		$new_timeOut = $this->convert_to_hr($new_timeIn_mins + $timeRange);

		while(true){

			if(!$this->section_conflict($secDT_holder, $rand_day, $new_timeIn, $new_timeOut, $last_added['classID'])){
				break;
			}

		}

		$last_added['timeIn'] = $new_timeIn;
		$last_added['timeOut'] = $new_timeOut;
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

	function get_timeOut($timeIn, $units, $dayCount, $subID2, $hrs_per_week){
		$range = $this->convert_to_mins($hrs_per_week);
		// if($subID2){
		// 	// $range = 60;
		// 	if($dayCount % 2 == 0){
		// 		$range = 90;
		// 	}else if($dayCount % 3 == 0){
		// 		$range = 60;
		// 	}else{
		// 		$range = 360;
		// 	}
		// }else{
		// 	$range = ((60 * $units) / $dayCount); //minutes	
		// }
		
		$timeIn = $this->convert_to_mins($timeIn);
		return $this->convert_to_hr($range + $timeIn);

	}

	function random_day($days, $subject, $last_added = NULL){
		$arr = null;
		$sql = $this->db->query("SELECT units FROM subject WHERE prosID = ".$subject->prosID." AND id = ".$subject->id." AND subID <> ".$subject->subID." LIMIT 1")->row();

		shuffle($days);

		if($sql){
			$total_units = $subject->units + $sql->units;
		}else{
			$total_units = $subject->units;
		}

		foreach($days as $day){
			//only total units with equal daycount and not divisible by 6 or 3
			if(($total_units % $day['dayCount'] == 0) && ($total_units % 6 != 0) && ($total_units % 3 != 0)){
				$arr = $day;
				break;
			}
		}
		
		if(!$arr){ // balanced day
			while(true){
				$arr = $days[array_rand($days, 1)];
				if(!$last_added){
					break;
				}
				if($arr['dayID'] != $last_added['dayID']){
					break;
				}
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