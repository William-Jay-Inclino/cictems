<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Dashboard extends CI_Model{

	function populate($termID){

		$cnt = $this->db->query("SELECT total FROM counter2")->result();

		$data['terms'] = $cnt[0]->total;
		$data['rooms'] = $cnt[1]->total;
		$data['courses'] = $cnt[2]->total;
		$data['prospectus'] = $cnt[3]->total;
		$data['sections'] = $cnt[4]->total;
		$facTotal = $cnt[5]->total;
		$data['subjects'] = $cnt[6]->total;
		$stafTotal = $cnt[7]->total;
		$data['days'] = $cnt[11]->total;

		$data['faculties'] = $this->db->query("SELECT 1 FROM faculty f INNER JOIN users u ON f.uID = u.uID WHERE u.status = 'active' AND f.facID <> 0 LIMIT $facTotal")->num_rows();
		$data['staffs'] = $this->db->query("SELECT 1 FROM staff s INNER JOIN users u ON s.uID = u.uID WHERE u.status = 'active' LIMIT $stafTotal")->num_rows();

		$sql = $this->db->query("SELECT total FROM counter WHERE module = 'enrol_studs' AND termID = $termID LIMIT 1")->row();
		if($sql){
			$data['students'] = $sql->total;
		}else{
			$data['students'] = 0;
		}

		$sql2 = $this->db->query("SELECT total FROM counter WHERE module = 'fees' AND termID = $termID LIMIT 1")->row();
		if($sql2){
			$data['fees'] = $sql2->total;
		}else{
			$data['fees'] = 0;
		}

		$data['subjects'] = $this->get_subjects($termID);
		//die(print_r($data));

		return $data;
	}

	private function get_subjects($termID){
		$data = [];
		// $subjects = $this->db->query("SELECT c.classID,c.subID,s.subCode,s.subDesc,s.total_units FROM class c INNER JOIN subject s ON c.subID = s.subID WHERE c.termID = $termID")->result();
		// foreach($subjects as $subject){
			
			
		// }
	}


}

?>