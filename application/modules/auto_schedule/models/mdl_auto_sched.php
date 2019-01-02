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

			$subjects = $this->db->query("
				SELECT subID,specID,subCode,units,id FROM subject WHERE prosID = ".$section['prosID']." AND yearID = ".$section['yearID']." AND semID = ".$term['semID']."
			")->result();

			if($is_dt_auto == 'yes'){
				$noon_class = false;
				$last_added = null;
				foreach($subjects as $s){
					
					if($last_added){
						if($last_added['id'] != $s->id){
							$rand_day = $this->random_day($days, $s->units);
						}else{
							//same subject but diff. unit and separated by lunch break
							//move last_added after lunch break
							if($this->is_break_separated($min_time, $last_added['timeOut'], $break_min_time, $break_max_time)){
								echo "aaa";
								$min_time = $this->move_last_added($min_time, $last_added); //mintime is time out of last added
							}
						}
					}else{
						$rand_day = $this->random_day($days, $s->units);
					}

					$timeOut = $this->get_timeOut($min_time, $s->units, $rand_day['dayCount']);
					
					//lunch break
					if($this->is_time_out_greater($timeOut,$break_min_time) && !$noon_class){
						$min_time = $break_max_time;
						$timeOut = $this->get_timeOut($min_time, $s->units, $rand_day['dayCount']);
						$noon_class = true;
					}

					//time out should not exceed max time
					if($this->is_time_out_greater($timeOut, $max_time)){
						$min_time = $min_time2;
						$noon_class = false;
						continue;
					}
					
					$data['timeIn'] = $min_time;
					$data['timeOut'] = $timeOut;
					$data['dayID'] = $rand_day['dayID'];
					$data['termID'] = $term['termID'];
					$data['subID'] = $s->subID;
					$data['secID'] = $section['secID'];
					$data['classCode'] = $s->subCode;
					$data['merge_with'] = 0;
					$data['roomID'] = $data['facID'] = 0;

					if($is_room_auto == 'yes'){
						$data['roomID'] = $this->random_room($rooms, $s->specID, $term['termID'], $rand_day['dayID'], $min_time, $timeOut);
					}
					if($is_faculty_auto == 'yes'){
						$data['facID'] = $this->random_faculty($faculties, $s->specID, $term['termID'], $rand_day['dayID'], $min_time, $timeOut);
					}
					$min_time = $timeOut;
					print_r($data);
					$this->db->insert('class', $data);
					$data['classID'] = $this->db->insert_id();
					$data['id'] = $s->id;
					$last_added = $data;
					array_splice($data, 10, 2);
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

	function is_break_separated($min_time, $last_timeOut, $break_min_time, $break_max_time){
		$x = explode(':', $min_time);
		$min_time = ($x[0] * 60) + $x[1];

		$y = explode(':', $last_timeOut);
		$last_timeOut = ($y[0] * 60) + $y[1];

		$z = explode(':', $break_min_time);
		$break_min_time = ($z[0] * 60) + $z[1];

		$a = explode(':', $break_max_time);
		$break_max_time = ($a[0] * 60) + $a[1];

		if($last_timeOut <= $break_min_time && $min_time >= $break_max_time){
			return true;
		}else{
			return false;
		}

	}

	function is_time_out_greater($timeOut,$break_min_time){
		$x = explode(':', $timeOut);
		$x2 = ($x[0] * 60) + $x[1];

		$y = explode(':', $break_min_time);
		$y2 = ($y[0] * 60) + $y[1];
		
		return ($x2 > $y2) ? true : false;

	}

	function move_last_added($min_time,$last_added){
		$x = explode(':', $last_added['timeOut']);
		$x2 = ($x[0] * 60) + $x[1];
		$y = explode(':', $last_added['timeIn']);
		$y2 = ($y[0] * 60) + $y[1];
		$timeRange = $x2 - $y2; //minutes

		$parts = explode(':', $min_time);
		$timeIn_mins = ($parts[0] * 60) + $parts[1];
		$timeOut_mins = $timeIn_mins + $timeRange; //in minutes
		$hours = floor($timeOut_mins / 60);
		$minutes = $timeOut_mins % 60;
		if(strlen($hours) == 1){$hours = '0'.$hours;}
		if(strlen($minutes) == 1){$minutes = '0'.$minutes;}

		$data['timeIn'] = $min_time;
		$data['timeOut'] = $hours.':'.$minutes.':00';
		
		$this->db->update('class', $data, "classID = ".$last_added['classID']);

		return $data['timeOut'];
	}

	function get_timeOut($timeIn, $units, $dayCount){

		$range = ((60 * $units) / $dayCount); //minutes

		$parts = explode(':', $timeIn);
		$timeIn_mins = ($parts[0] * 60) + $parts[1];

		$timeOut_mins = $range + $timeIn_mins;
		$hours = floor($timeOut_mins / 60);
		$minutes = $timeOut_mins % 60;

		if(strlen($hours) == 1){$hours = '0'.$hours;}
		if(strlen($minutes) == 1){$minutes = '0'.$minutes;}

		return $hours.':'.$minutes.':00';
	}

	function random_day($days, $units){
		$selected_day = null;
		foreach($days as $day){

			if($day['dayCount'] % $units == 0){
				$selected_day = $day;
				break;
			}	
		}
		
		if(!$selected_day){
			$selected_day = $days[array_rand($days, 1)];
		}

		return $selected_day;

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