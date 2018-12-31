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
				SELECT subID,specID,subCode FROM subject WHERE prosID = ".$section['prosID']." AND yearID = ".$section['yearID']." AND semID = ".$term['semID']."
			")->result();

			if($is_dt_auto == 'yes'){

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

	function random_room($rooms, $sub_specID){
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
				break;
			}
			$rand_history[] = $rand_index;
			++$ctr;
		}

		return $roomID;
	}

	function random_faculty($faculties, $sub_specID){
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
					break;
				}
			}
			$rand_history[] = $rand_index;
			++$ctr;
		}
		return $facID;
	}

}

?>