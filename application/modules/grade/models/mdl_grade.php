<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Grade extends CI_Model{

	function search_subject($value, $studID){
		$search_value = strtr($value, '_', ' ');
		$query = $this->db->select('subID,subCode')->like('subCode', "$search_value")->get_where('subject', "prosID = (SELECT prosID FROM studprospectus WHERE studID = $studID)" ,10);
		echo json_encode($query->result());
	}

	function set_form($studID, $subID){
		$co = [];
		$pre = [];

		$query = $this->db->select('subDesc,lec,lab')->get_where('subject','subID = '.$subID,1);
		$row = $query->row();

		$query4 = $this->db->query("SELECT req_subID FROM subject_req WHERE subID = $subID");
		$row4 = $query4->result();
		if($row4){
			foreach($row4 as $t){
				$query3 = $this->db->query("SELECT s.subCode,sr.req_type FROM subject s INNER JOIN subject_req sr ON sr.req_subID = s.subID WHERE sr.req_subID = $t->req_subID AND sr.subID = $subID");
				$rs = $query3->row();

				if($rs->req_type == '1'){
					//prerequisite
					$pre[] = $rs->subCode;
				}else{
					//corequisite
					$co[] = $rs->subCode;
				}
			}
		}

		$query5 = $this->db->query("SELECT yearID FROM year_req WHERE subID = $subID LIMIT 1");
		$row5 = $query5->row();
		if($row5){
			$query6 = $this->db->query("SELECT yearDesc FROM year WHERE yearID = $row5->yearID LIMIT 1");
			$pre[] = $query6->row()->yearDesc; 
		}

		$query2 = $this->db->select("(SELECT CONCAT(grade_type,'|',sgGrade) FROM studgrade WHERE studID = $studID AND subID = $subID LIMIT 1) AS sgCheck, (SELECT CONCAT(t.schoolYear,' ',s.semDesc) FROM studclass sc INNER JOIN class c ON sc.classID = c.classID INNER JOIN term t ON c.termID = t.termID INNER JOIN semester s ON t.semID = s.semID AND c.subID = $subID AND sc.studID = $studID LIMIT 1) AS scCheck")->get();
		$row2 = $query2->row();
		$grade = '';

		if(!$row2->sgCheck && !$row2->scCheck){
			$output = 'Insert';
		}else if($row2->sgCheck){
			$x = explode('|',$row2->sgCheck);
			if($x[0] == 'Credit'){
				$output = 'Update';
				$grade = $x[1];
			}else{
				$output = 'Student has already a grade in this subject in a class';
			}
		}else if($row2->scCheck){
			$output = 'Student is enrolled in this subject in '.$row2->scCheck;
		}
		if(!$pre){
			$pre[] = 'None';
		}
		if(!$co){
			$co[] = 'None';
		}
		$data = ['subject'=>$row, 'pre'=>$pre, 'co'=>$co, 'data'=>$output, 'grade'=>$grade];

		echo json_encode($data);
	}

	function submit_grade($termID){
		$studID = $this->input->post('studID');
		$subID = $this->input->post('subID');

		$data['sgGrade'] = $this->input->post('grade');
		$data['termID'] = $termID;
		$data['uID'] = $this->session->userdata('uID');

		if($this->input->post('action') == 'Insert'){
			$data['grade_type'] = 'Credit';
			$data['studID'] = $studID;
			$data['subID'] = $subID;
			$this->db->insert('studgrade', $data);
		}else{
			$this->db->update('studgrade', $data, ['studID'=>$studID,'subID'=>$subID]);
		}
	}

	function delete_grade(){
		$data['studID'] = $this->input->post('studID');
		$data['subID'] = $this->input->post('subID');
		$this->db->delete('studgrade', $data);
	}

}

?>