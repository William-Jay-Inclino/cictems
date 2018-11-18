<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Class_List extends CI_Model{

	function checkConflict(){
		$termID = $this->input->post('termID');
		$timeIn = $this->input->post('timeIn');
		$timeOut = $this->input->post('timeOut');
		$dayID = $this->input->post('dayID');
		$roomID = $this->input->post('roomID');
		$facID = $this->input->post('facID');

		$sql2 = $this->db->query("
			SELECT classCode,secID FROM class WHERE termID = $termID AND dayID = $dayID AND roomID = $roomID AND 
			'$timeOut' > timeIn AND timeOut > '$timeIn'
		")->row();

		if($sql2){
			$secName = $this->db->select('secName')->get_where('section',"secID = ".$sql2->secID, 1)->row()->secName;
			die("Room is unavailable. (Section: $secName, Class: ".$sql2->classCode.")");
		}

		$sql3 = $this->db->query("
			SELECT classCode,secID FROM class WHERE termID = $termID AND dayID = $dayID AND facID = $facID AND 
			'$timeOut' > timeIn AND timeOut > '$timeIn'
		")->row();

		if($sql3){
			$secName = $this->db->select('secName')->get_where('section',"secID = ".$sql3->secID, 1)->row()->secName;
			die("Instructor is unavailable. (Section: $secName, Class: ".$sql3->classCode.")");
		}

		echo 'ok';

	}

	function get_terms(&$term){
		$term = $this->db->query('SELECT t.termID, CONCAT(t.schoolYear," ",s.semDesc) AS term FROM term t INNER JOIN semester s ON t.semID=s.semID ORDER BY t.schoolYear DESC,s.semOrder DESC')->result();
	}

	function populate(){
		$this->get_terms($term);
		$data['term'] = $term;
		$data['prospectus'] = $this->db->query('SELECT prosID,prosCode FROM prospectus ORDER BY prosCode ASC')->result();
		$data['rooms'] = $this->db->query("SELECT roomID,roomName FROM room")->result();
		$data['days'] = $this->db->get('day')->result();
		$data['faculties'] = $this->db->query("SELECT f.facID,CONCAT(u.ln,', ',u.fn,' ',u.mn) as faculty FROM faculty f INNER JOIN users u ON f.uID=u.uID WHERE u.status = 'active'")->result();
		$data['sections'] = $this->db->query("SELECT secID,secName FROM section ORDER BY secName ASC")->result();
		echo json_encode($data);
	}

	function populate2(){
		$this->get_terms($term);
		$data['term'] = $term;
		$data['sections'] = $this->db->query('SELECT * FROM section ORDER BY secName ASC')->result();
		echo json_encode($data);
	}

	function populate_update_batch($secID, $termID, $val = NULL){
		$query = $this->db->query("
				SELECT c.classID,t.termID,CONCAT(t.schoolYear,' ',s.semDesc) term,p.prosID,p.prosCode, y.yearDesc,sec.secID,sec.secName,sub.subCode,sub.subDesc,d.dayID,d.dayDesc,c.timeIn,c.timeOut,r.roomID,r.roomName,f.facID,CONCAT(u.ln,', ',u.fn,' ',u.mn) faculty,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),' - ',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time FROM class c 
				INNER JOIN term t ON c.termID = t.termID 
				INNER JOIN section sec ON c.secID = sec.secID
				INNER JOIN room r ON c.roomID = r.roomID 
				INNER JOIN day d ON c.dayID = d.dayID 
				INNER JOIN faculty f ON c.facID = f.facID 
				INNER JOIN users u ON f.uID = u.uID 
				INNER JOIN semester s ON t.semID = s.semID 
				INNER JOIN subject sub ON c.subID = sub.subID 
				INNER JOIN prospectus p ON sub.prosID = p.prosID 
				INNER JOIN year y ON sub.yearID = y.yearID 
				WHERE c.termID = $termID AND c.secID = $secID 
			")->result();

		if($val == NULL){
			echo json_encode($query);
		}else{
			return $query;
		}
		
	}

	function fetchClasses($yearID, $prosID, $termID){
		echo json_encode(
			$this->db->query("
				SELECT subID,subCode,subDesc,(lec + lab) units FROM subject WHERE prosID = $prosID AND yearID = $yearID AND
				semID = (SELECT semID FROM term WHERE termID = $termID LIMIT 1)
			")->result()
		);
	}

	function create(){
		$data['subID'] = $this->input->post('code')['subID'];
		$data['classCode'] = $this->input->post('code')['subCode'];
		$data['termID'] =$this->input->post('term')['termID'];
		$this->db->trans_start();
		$this->get_form_data($data);
		$this->db->insert('class', $data);
		$id = $this->db->insert_id();

		echo $id;

		$this->db->trans_complete();

	}

	function create_batch(){
		$termID = $this->input->post('termID');
		$secID = $this->input->post('secID');
		$classes = $this->input->post('classes');

		$this->check_exist($termID, $secID);
		
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
				$this->db->insert('class', $data);
			}
		}
		$this->db->trans_complete();
	}

	function read($secID,$termID){
		echo json_encode(
			$this->db->query("
				SELECT c.classID,c.classCode,s.subDesc,d.dayDesc,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),' - ',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time,r.roomName,CONCAT(u.ln,', ',u.fn,' ',u.mn) faculty FROM class c
				INNER JOIN subject s ON c.subID = s.subID
				INNER JOIN room r ON c.roomID=r.roomID
				INNER JOIN day d ON c.dayID = d.dayID
				INNER JOIN faculty f ON c.facID=f.facID
				INNER JOIN users u ON f.uID=u.uID WHERE c.secID = $secID AND c.termID = $termID
			")->result()
		);
	}

	function read_one($id){
		$this->check_form_id($id);

		$query = $this->db->query("
			SELECT c.classID,c.classCode,t.termID,CONCAT(t.schoolYear,' ',sem.semDesc) term,s.subDesc,p.prosCode,d.dayID,d.dayDesc,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time,c.timeIn,c.timeOut,r.roomID,r.roomName,f.facID,CONCAT(u.ln,', ',u.fn,' ',u.mn) faculty,sec.secID,sec.secName FROM class c
				INNER JOIN term t ON c.termID=t.termID
				INNER JOIN subject s ON c.subID = s.subID
				INNER JOIN prospectus p ON s.prosID = p.prosID
				INNER JOIN room r ON c.roomID=r.roomID
				INNER JOIN day d ON c.dayID=d.dayID
				INNER JOIN faculty f ON c.facID=f.facID
				INNER JOIN users u ON f.uID=u.uID
				INNER JOIN section sec on c.secID=sec.secID 
				INNER JOIN semester sem on t.semID=sem.semID 
				WHERE c.classID = $id LIMIT 1
		");
		return $query->row();
	}

	function update(){
		//die(print_r($_POST));
		$classID = $this->input->post('id');
		$termID = $this->input->post('term')['termID'];
		$this->db->trans_start();
		$this->get_form_data($data);
		$this->db->update('class', $data, "classID = $classID");
		$this->db->trans_complete();
	}

	function update_batch(){
		$termID = $this->input->post('termID');
		$oldSecID = $this->input->post('oldSecID');
		$newSecID = $this->input->post('newSecID');
		$classes = $this->input->post('classes');

		$this->check_exist($termID, $oldSecID, $newSecID);
		
		$this->db->trans_start();
		foreach ($classes as $class) {
			$data['roomID'] = $class['room']['roomID'];
			$data['facID'] = $class['faculty']['facID'];
			$data['secID'] = $newSecID;
			$data['dayID'] = $class['day']['dayID'];
			$data['timeIn'] = $class['timeIn'];
			$data['timeOut'] = $class['timeOut'];
			$this->db->update('class', $data ,"classID = ".$class['classID']);
			
		}
		$this->db->trans_complete();
		echo "success";
	}

	function delete($id){
		$this->db->trans_start();
		$this->db->delete('class', 'classID = '.$id);
		$this->db->trans_complete();
	}

	function get_form_data(&$data){
		$data['dayID'] = $this->input->post('day')['dayID'];
		$data['timeIn'] = $this->input->post('time_in');
		$data['timeOut'] = $this->input->post('time_out');
		$data['roomID'] = $this->input->post('room')['roomID'];
		$data['facID'] = $this->input->post('faculty')['facID'];
		$data['secID'] = $this->input->post('section')['secID'];
	}

	function is_safe_delete($id){
		$output = 0;
		$query = $this->db->select('1')->get_where('studclass', "classID = $id", 1)->row();

		if(!$query){
			$output = 1;
		}

		echo $output;
	}

	function get_secName($secID){
		echo $this->db->select('secName')->get_where('section', "secID = $secID", 1)->row()->secName;
	}

	function check_form_id($id, $id2 = NULL){
		if($id2 === NULL){
			$query = $this->db->select('1')->get_where('class', 'classID='.$id,1);	
		}else{
			$query = $this->db->select('1')->get_where('class', "termID = $id2 AND secID = $id",1);
		}
		if(!$query->row()){
			show_404();
		}
	}

	private function check_exist($termID, $secID, $secID2 = NULL){
		if($secID2 == NULL){
			$sql = $this->db->select('1')->get_where('class',"secID = $secID AND termID = $termID", 1)->row();
		}else{
			$sql = $this->db->select('secID')->get_where('class',"secID = $secID2 AND termID = $termID AND secID <> $secID", 1)->row();
		}
		if($sql){
			die("Section already exist in the selected term!");
		}
		
	}

	function getSections($prosID){
		$data['sections'] = $this->db->query("SELECT secID,secName FROM section WHERE courseID = (SELECT courseID FROM prospectus WHERE prosID = $prosID LIMIT 1)")->result();
		echo json_encode($data);
	}

	function fetch_YS($prosID){
		$data['years'] = $this->db->query("
							SELECT yearID, yearDesc FROM year WHERE duration <= (SELECT duration FROM prospectus WHERE prosID = $prosID)
						")->result();
		$data['sections'] = $this->db->query("SELECT secID,secName FROM section WHERE courseID = (SELECT courseID FROM prospectus WHERE prosID = $prosID LIMIT 1)")->result();
		echo json_encode($data);
	}

	function get_subjects($search_value, $prosID){
		$search_value = strtr($search_value, '_', ' ');
		echo json_encode(
			$this->db->select('subID, subCode')->like('subCode', "$search_value")->get_where('subject',"prosID = $prosID",10)->result()
		);
	}


}

?>