<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Schedule extends CI_Model{

	private function get_terms(&$term){
		$term = $this->db->query('SELECT t.termID,s.semID, CONCAT(t.schoolYear," ",s.semDesc) AS term FROM term t INNER JOIN semester s ON t.semID=s.semID ORDER BY t.schoolYear DESC,s.semOrder DESC')->result();
	}

	function checkConflict(){
		$classID = $this->input->post('classID');
		$termID = $this->input->post('termID');
		$timeIn = $this->input->post('timeIn');
		$timeOut = $this->input->post('timeOut');
		$dayID = $this->input->post('dayID');
		$roomID = $this->input->post('roomID');
		$facID = $this->input->post('facID');

		if($classID == 0){
			$sql2 = $this->db->query("
				SELECT classCode,secID FROM class WHERE termID = $termID AND dayID = $dayID AND roomID = $roomID AND 
				'$timeOut' > timeIn AND timeOut > '$timeIn' AND roomID <> 0 LIMIT 1
			")->row();

			if($sql2){
				$secName = $this->db->select('secName')->get_where('section',"secID = ".$sql2->secID, 1)->row()->secName;
				die("Room is unavailable. (Section: $secName, Class: ".$sql2->classCode.")");
			}

			$sql3 = $this->db->query("
				SELECT classCode,secID FROM class WHERE termID = $termID AND dayID = $dayID AND facID = $facID AND 
				'$timeOut' > timeIn AND timeOut > '$timeIn' AND facID <> 0 LIMIT 1
			")->row();

			if($sql3){
				$secName = $this->db->select('secName')->get_where('section',"secID = ".$sql3->secID, 1)->row()->secName;
				die("Instructor is unavailable. (Section: $secName, Class: ".$sql3->classCode.")");
			}
			die('ok');
		}else{
			$sql2 = $this->db->query("
				SELECT classCode,secID FROM class WHERE termID = $termID AND dayID = $dayID AND roomID = $roomID AND 
				'$timeOut' > timeIn AND timeOut > '$timeIn' AND classID <> $classID AND roomID <> 0 AND merge_with <> $classID LIMIT 1
			")->row();

			if($sql2){
				$secName = $this->db->select('secName')->get_where('section',"secID = ".$sql2->secID, 1)->row()->secName;
				die("Room is unavailable. (Section: $secName, Class: ".$sql2->classCode.")");
			}

			$sql3 = $this->db->query("
				SELECT classCode,secID FROM class WHERE termID = $termID AND dayID = $dayID AND facID = $facID AND 
				'$timeOut' > timeIn AND timeOut > '$timeIn' AND classID <> $classID AND facID <> 0 AND merge_with <> $classID LIMIT 1
			")->row();

			if($sql3){
				$secName = $this->db->select('secName')->get_where('section',"secID = ".$sql3->secID, 1)->row()->secName;
				die("Instructor is unavailable. (Section: $secName, Class: ".$sql3->classCode.")");
			}

			$data['timeIn'] = $timeIn;
			$data['timeOut'] = $timeOut;
			$data['dayID'] = $dayID;
			$data['roomID'] = $roomID;
			$data['facID'] = $facID;
			$this->db->update('class', $data, "classID = $classID");
			$dependent_classes = $this->db->select('classID')->get_where('class',"merge_with = $classID")->result();
			if($dependent_classes){
				foreach($dependent_classes as $c){
					$this->db->update('class', $data, "classID = ".$c->classID);
				}
			}
			die('updated');
		}
		

	}

	function populate($termID){
		$this->get_terms($term);
		$data['term'] = $term;
		$data['prospectus'] = $this->db->query('SELECT prosID,prosCode FROM prospectus ORDER BY prosID DESC, prosCode ASC')->result();
		$data['rooms'] = $this->db->query("SELECT roomID,roomName FROM room")->result();
		$data['days'] = $this->db->get_where('day', "dayID <> 0")->result();
		$data['faculties'] = $this->db->query("SELECT f.facID,u.ln, u.fn FROM faculty f INNER JOIN users u ON f.uID=u.uID WHERE u.status = 'active'")->result();
		$data['added_sections'] = $this->db->query("SELECT DISTINCT s.secID,s.secName FROM class c INNER JOIN section s ON c.secID = s.secID AND c.termID = $termID ORDER BY s.secName ASC")->result();

		echo json_encode($data);
	}

	function fetchYear($prosID){
		echo json_encode(
			$this->db->query("
				SELECT yearID, yearDesc FROM year WHERE duration <= (SELECT duration FROM prospectus WHERE prosID = $prosID)
			")->result()
		);
	}

	function fetchSections($prosID, $yearID, $termID){
		echo json_encode(
			$this->db->query("
				SELECT s.secID,s.secName 
				FROM section s 
				WHERE yearID = $yearID AND 
				semID = (SELECT semID FROM term WHERE termID = $termID LIMIT 1) AND
				courseID = (SELECT courseID FROM prospectus WHERE prosID = $prosID LIMIT 1)")->result()
		);
	}

	function fetchClasses($yearID, $prosID, $termID){
		$data['classes'] = $this->db->query("
			SELECT s.subID,s.id,s.prosID,s.subCode,s.hrs_per_wk,s.subDesc,s.units,s.type,(SELECT subID FROM subject WHERE id = s.id AND prosID = s.prosID AND subID <> s.subID LIMIT 1) subID2
			FROM subject s WHERE s.prosID = $prosID AND s.yearID = $yearID AND
			s.semID = (SELECT semID FROM term WHERE termID = $termID LIMIT 1)
		")->result();
		//die($this->db->last_query());
		$data['sections'] = $this->get_sections($yearID, $prosID, $termID);
		echo json_encode($data);
	}

	function get_sections($yearID, $prosID, $termID){
		return $this->db->query("
				SELECT s.secID,s.secName 
				FROM section s 
				WHERE yearID = $yearID AND 
				semID = (SELECT semID FROM term WHERE termID = $termID LIMIT 1) AND
				courseID = (SELECT courseID FROM prospectus WHERE prosID = $prosID LIMIT 1)")->result();
	}

	function get_sec_info($secID, $termID){
		$data['classes'] = $this->db->query("
				SELECT c.classID,c.merge_with,sub.subID,sub.id,sub.prosID,sub.subCode,sub.hrs_per_wk,sub.subDesc,sub.units,sub.type,d.dayID,d.dayDesc,d.dayCount,c.timeIn,c.timeOut,r.roomID,r.roomName,f.facID,u.ln, u.fn,
				CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),' - ',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time, (SELECT CONCAT(ss.subCode,'|',ss.type,'|',sec.secName) FROM class cc INNER JOIN section sec ON cc.secID = sec.secID INNER JOIN subject ss ON cc.subID = ss.subID WHERE classID = c.merge_with LIMIT 1) class_merge,(SELECT subID FROM subject WHERE id = sub.id AND prosID = sub.prosID AND subID <> sub.subID LIMIT 1) subID2
				FROM class c 
				INNER JOIN room r ON c.roomID = r.roomID 
				INNER JOIN day d ON c.dayID = d.dayID 
				INNER JOIN faculty f ON c.facID = f.facID 
				INNER JOIN users u ON f.uID = u.uID 
				INNER JOIN subject sub ON c.subID = sub.subID 
				WHERE c.termID = $termID AND c.secID = $secID
				ORDER BY c.classID ASC 
			")->result();
		$sql = $this->db->query("
			SELECT p.prosID,p.prosCode,y.yearID,y.yearDesc,s.secID,s.secName
			FROM class c 
			INNER JOIN section s ON c.secID = s.secID 
			INNER JOIN subject ss ON c.subID = ss.subID 
			INNER JOIN prospectus p ON ss.prosID = p.prosID 
			INNER JOIN year y ON ss.yearID = y.yearID 
			WHERE c.termID = $termID AND s.secID = $secID LIMIT 1 
		")->row();

		$data['prospectus'] = ['prosID' => $sql->prosID, 'prosCode' => $sql->prosCode];
		$data['year'] = ['yearID' => $sql->yearID, 'yearDesc' => $sql->yearDesc];
		$data['section'] = ['secID' => $sql->secID, 'secName' => $sql->secName];
		$data['sections'] = $this->get_sections($sql->yearID,$sql->prosID, $termID);

		echo json_encode($data);
	}

	function get_added_sections($termID){
		echo json_encode(
			$this->db->query("SELECT DISTINCT s.secID,s.secName FROM class c INNER JOIN section s ON c.secID = s.secID AND c.termID = $termID ORDER BY s.secName ASC")->result()
		);
	}

	function create(){
		$termID = $this->input->post('termID');
		$secID = $this->input->post('secID');
		$classes = $this->input->post('classes');

		$sql = $this->db->select('1')->get_where('class', "termID = $termID AND secID = $secID", 1)->row();
		if($sql){
			die('exist');
		}
		
		$this->db->trans_start();
		foreach ($classes as $class) {
			if($class['status2'] == 0){
				$data['termID'] = $termID;
				$data['subID'] = $class['subID'];
				$data['roomID'] = $class['room']['roomID'];
				$data['facID'] = $class['faculty']['facID'];
				$data['secID'] = $secID;
				$data['classCode'] = $class['subCode'];
				$data['dayID'] = $class['day']['dayID'];
				$data['timeIn'] = $class['timeIn'];
				$data['timeOut'] = $class['timeOut'];
				if(isset($class['merge_to'])){
					$data['merge_with'] = $class['merge_to']['classID'];
				}else{
					$data['merge_with'] = 0;
				}

				$this->db->insert('class', $data);
			}
		}
		$this->db->trans_complete();
		$this->get_added_sections($termID);
	}

	function search_subject($search_value, $prosID){
		$search_value = strtr($search_value, '_', ' ');
		$query = $this->db->select("subID,hrs_per_wk,subCode,CONCAT(subCode,' | ',subDesc,' (',type,')') subject,subDesc, units, type")->like("CONCAT(subCode,' | ',subDesc)",$search_value)->get_where('subject', "prosID = $prosID" , 10);
		echo json_encode($query->result());
	}

	function is_safe_delete($classID){
		$output = 0;

		$query = $this->db->select('1')->get_where('class', "merge_with = $classID", 1)->row();
		if($query){
			die('2');
		}

		$query = $this->db->select('1')->get_where('studclass', "classID = $classID", 1)->row();

		if(!$query){
			$output = 1;
		}

		echo $output;
	}

	function delete($id){
		$this->db->trans_start();
		$this->db->delete('class', 'classID = '.$id);
		$this->db->trans_complete();
	}

	function add_class_to_section(){
		$data = $this->input->post('data');
		$this->db->insert('class', $data);
		echo $this->db->insert_id();
	}

	function changeSection(){
		$yearID = $this->input->post('yearID');
		$prosID = $this->input->post('prosID');
		$termID = $this->input->post('termID');
		$secID = $this->input->post('secID');

		$data['secID'] = $this->input->post('newSecID');
		$this->db->update('class', $data, "termID = $termID AND secID = $secID");
		$data['added_sections'] = $this->db->query("SELECT DISTINCT s.secID,s.secName FROM class c INNER JOIN section s ON c.secID = s.secID AND c.termID = $termID ORDER BY s.secName ASC")->result();
		$data['sections'] = $this->get_sections($yearID, $prosID, $termID);

		$sql = $this->db->query("
			SELECT s.secID,s.secName
			FROM class c 
			INNER JOIN section s ON c.secID = s.secID 
			WHERE c.termID = $termID AND s.secID = ".$data['secID']." LIMIT 1 
		")->row();
		$data['section'] = ['secID' => $sql->secID, 'secName' => $sql->secName];

		echo json_encode($data);
	}

	function get_classes($termID, $secID){
		$sql = $this->db->query("
			SELECT c.classID,c.merge_with,s.subCode,s.subDesc,s.units,s.type,d.dayID,d.dayDesc,d.dayCount,c.timeIn,c.timeOut,r.roomID,r.roomName,f.facID,u.ln, u.fn
			FROM class c 
			INNER JOIN subject s ON c.subID = s.subID
			INNER JOIN room r ON c.roomID = r.roomID
			INNER JOIN day d ON c.dayID = d.dayID
			INNER JOIN faculty f ON c.facID = f.facID
			INNER JOIN users u ON f.uID = u.uID 
			WHERE c.termID = $termID AND c.secID = $secID
		")->result();
		echo json_encode($sql);
	}

	function mergeClass(){
		$data = $this->input->post("data");
		$classID = $this->input->post("classID");

		$c = $this->db->query("SELECT termID, secID FROM class WHERE classID = $classID LIMIT 1")->row();

		$is_conflict = $this->db->query("
			SELECT 1 FROM class WHERE termID = ".$c->termID." AND secID = ".$c->secID." AND dayID = ".$data['dayID']." AND 
			'".$data['timeOut']."' > timeIn AND timeOut > '".$data['timeIn']."' AND classID <> $classID LIMIT 1
		")->row();

		if($is_conflict){
			die("Unable to merge. Schedule has conflict in this section!");
		}

		$this->db->update('class', $data, "classID = $classID");
		echo "success";
	}

	function splitClass($classID){
		$data['roomID'] = 0;
		$data['dayID'] = 0;
		$data['facID'] = 0;
		$data['timeIn'] = '00:00:00';
		$data['timeOut'] = '00:00:00';
		$data['merge_with'] = 0;

		$this->db->update('class', $data, "classID = $classID");
	}

	function copySchedule(){
		//die(print_r($_POST));
		$current_termID = $this->input->post('current_term');
		$termID_to_copy = $this->input->post('term_to_copy');

		$this->db->trans_start();

		$previous_scheds = $this->db->get_where('class', "termID = $termID_to_copy")->result();

		if(!$previous_scheds){
			die("empty");
		}

		foreach($previous_scheds as $prev){
			$data['termID'] = $current_termID;
			$data['subID'] = $prev->subID;
			$data['roomID'] = $prev->roomID;
			$data['facID'] = $prev->facID;
			$data['secID'] = $prev->secID;
			$data['dayID'] = $prev->dayID;
			$data['classCode'] = $prev->classCode;
			$data['timeIn'] = $prev->timeIn;
			$data['timeOut'] = $prev->timeOut;
			$data['merge_with'] = $prev->merge_with;
			$this->db->insert('class', $data);
		}

		$this->db->trans_complete();

		$this->get_added_sections($current_termID);
	}


}

?>