<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Inc extends CI_Model{

	function read($option = 's.controlNo',$search_val = NULL, $page = '1', $per_page = '10', $termID){
		$start = ($page - 1) * $per_page;
		$search_val = strtr($search_val, '_', ' ');
		if(trim($search_val) == ''){
			if($termID == 'all'){
				$query = $this->db->query("
					SELECT DISTINCT s.studID,CONCAT(t.schoolYear,' ',sem.semDesc) AS term,t.termID,s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name, c.courseCode, y.yearDesc FROM studclass sc
					INNER JOIN class ON sc.classID = class.classID 
					INNER JOIN term t ON class.termID = t.termID
					INNER JOIN semester sem ON t.semID = sem.semID
					INNER JOIN student s ON sc.studID = s.studID
					INNER JOIN users u ON s.uID = u.uID 
					INNER JOIN studprospectus sp ON s.studID = sp.studID
					INNER JOIN prospectus p ON sp.prosID = p.prosID 
					INNER JOIN course c ON p.courseID = c.courseID 
					INNER JOIN year y ON s.yearID = y.yearID 
					WHERE class.status = 'locked' AND sc.remarks = 'Incomplete' AND class.facID = (SELECT facID FROM faculty WHERE uID = ".$this->session->userdata('uID')." LIMIT 1)
					ORDER BY name ASC 
					LIMIT $start, $per_page
				");
			}else{
				$query = $this->db->query("
					SELECT DISTINCT s.studID,CONCAT(t.schoolYear,' ',sem.semDesc) AS term,t.termID,s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name, c.courseCode, y.yearDesc FROM studclass sc
					INNER JOIN class ON sc.classID = class.classID 
					INNER JOIN term t ON class.termID = t.termID
					INNER JOIN semester sem ON t.semID = sem.semID
					INNER JOIN student s ON sc.studID = s.studID
					INNER JOIN users u ON s.uID = u.uID 
					INNER JOIN studprospectus sp ON s.studID = sp.studID
					INNER JOIN prospectus p ON sp.prosID = p.prosID 
					INNER JOIN course c ON p.courseID = c.courseID 
					INNER JOIN year y ON s.yearID = y.yearID 
					WHERE class.status = 'locked' AND sc.remarks = 'Incomplete' AND c.termID = $termID AND class.facID = (SELECT facID FROM faculty WHERE uID = ".$this->session->userdata('uID')." LIMIT 1)
					ORDER BY name ASC 
					LIMIT $start, $per_page
				");
			}
			
		}else{
			if($option == 'name'){
				$option = "CONCAT(u.ln,', ',u.fn,' ',u.mn)";
			}
			if($termID == 'all'){
				$query = $this->db->query("
					SELECT DISTINCT s.studID,CONCAT(t.schoolYear,' ',sem.semDesc) AS term,t.termID,s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name, c.courseCode, y.yearDesc FROM studclass sc
					INNER JOIN class ON sc.classID = class.classID 
					INNER JOIN term t ON class.termID = t.termID
					INNER JOIN semester sem ON t.semID = sem.semID
					INNER JOIN student s ON sc.studID = s.studID
					INNER JOIN users u ON s.uID = u.uID 
					INNER JOIN studprospectus sp ON s.studID = sp.studID
					INNER JOIN prospectus p ON sp.prosID = p.prosID 
					INNER JOIN course c ON p.courseID = c.courseID 
					INNER JOIN year y ON s.yearID = y.yearID 
					WHERE class.status = 'locked' AND sc.remarks = 'Incomplete' AND class.facID = (SELECT facID FROM faculty WHERE uID = ".$this->session->userdata('uID')." LIMIT 1) AND $option LIKE '%".$search_val."%' 
					ORDER BY name ASC 
					LIMIT $start, $per_page
				");
			}else{
				$query = $this->db->query("
					SELECT DISTINCT s.studID,CONCAT(t.schoolYear,' ',sem.semDesc) AS term,t.termID,s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name, c.courseCode, y.yearDesc FROM studclass sc
					INNER JOIN class ON sc.classID = class.classID 
					INNER JOIN term t ON class.termID = t.termID
					INNER JOIN semester sem ON t.semID = sem.semID
					INNER JOIN student s ON sc.studID = s.studID
					INNER JOIN users u ON s.uID = u.uID 
					INNER JOIN studprospectus sp ON s.studID = sp.studID
					INNER JOIN prospectus p ON sp.prosID = p.prosID 
					INNER JOIN course c ON p.courseID = c.courseID 
					INNER JOIN year y ON s.yearID = y.yearID 
					WHERE class.status = 'locked' AND sc.remarks = 'Incomplete' AND class.facID = (SELECT facID FROM faculty WHERE uID = ".$this->session->userdata('uID')." LIMIT 1) AND c.termID = $termID AND $option LIKE '%".$search_val."%'
					ORDER BY name ASC 
					LIMIT $start, $per_page
				");
			}
			
		}
		$output = [
			'total_rows'=>  $query->num_rows(), 
			'records' => $query->result()
		];
		echo json_encode($output);
	}

	function get_stud_info($studID){
		return $this->db->query("SELECT s.studID,CONCAT(u.fn,' ',u.mn,' ',u.ln) name,s.controlNo FROM student s INNER JOIN users u ON s.uID = u.uID WHERE s.studID = $studID LIMIT 1")->row();
	}

	function get_inc_classes($studID){
		$inc_classes = $this->db->query("
			SELECT c.classID,c.classCode,sub.subDesc,sub.id, t.termID, t.schoolYear, s.semDesc 
			FROM class c 
			INNER JOIN subject sub ON c.subID = sub.subID 
			INNER JOIN term t ON c.termID = t.termID 
			INNER JOIN semester s ON t.semID = s.semID 
			INNER JOIN studclass sc ON c.classID = sc.classID 
			WHERE sc.remarks = 'Incomplete' AND c.status = 'locked' AND sc.studID = $studID AND c.facID = (SELECT facID FROM faculty WHERE uID = ".$this->session->userdata('uID')." LIMIT 1) 
			ORDER BY t.schoolYear,s.semOrder DESC
		")->result();
		if(!$inc_classes){
			show_404();
		}
		$arr = [];
		foreach($inc_classes as $i){
			$exist = false;
			foreach($arr as $r){
				if($r->id == $i->id){
					$exist = true;
					break;
				}
			}

			if(!$exist){
				$arr[] = $i;
			}

		}
		return $arr;
	}

	function fail_students($termID){
		$this->db->trans_start();
		if($termID == 'all'){
			$this->db->update('studgrade',['remarks' => 'Failed', 'sgGrade' => 5.0], "remarks = 'Incomplete' AND uID = ".$this->session->userdata('uID'));

			$sql = $this->db->query("
				SELECT sc.studID,c.classID FROM studclass sc INNER JOIN class c ON sc.classID = c.classID
				WHERE sc.remarks = 'Incomplete' AND c.facID = (SELECT facID FROM faculty WHERE uID = ".$this->session->userdata('uID')." LIMIT 1)
			")->result();

			foreach($sql as $s){
				$this->db->update('studclass',['remarks' => 'Failed', 'finalgrade' => 5.0], "studID = ".$s->studID." AND classID = ".$s->classID);
			}

		}else{
			$this->db->update('studgrade',['remarks' => 'Failed', 'sgGrade' => 5.0], "remarks = 'Incomplete' AND termID = $termID AND uID = ".$this->session->userdata('uID'));
			$sql = $this->db->query("
				SELECT sc.studID,c.classID FROM studclass sc INNER JOIN class c ON sc.classID = c.classID
				WHERE sc.remarks = 'Incomplete' AND c.termID = $termID AND c.facID = (SELECT facID FROM faculty WHERE uID = ".$this->session->userdata('uID')." LIMIT 1)
			")->result();
			foreach($sql as $s){
				$this->db->update('studclass',['remarks' => 'Failed', 'finalgrade' => 5.0], "studID = ".$s->studID." AND classID = ".$s->classID);
			}
		}
		
		$this->db->trans_complete();
	}

	function get_class_info($classID, $studID, $termID){
		$data = [];
		$sql = $this->db->query("
			SELECT s.id, s.prosID FROM subject s INNER JOIN class c ON s.subID = c.subID WHERE c.classID = $classID LIMIT 1
		")->row();

		$subIDs = $this->db->query("SELECT subID FROM subject WHERE id = ".$sql->id." AND prosID = ".$sql->prosID)->result();

		foreach($subIDs as $s){
			$data[] = $this->db->query("
				SELECT c.classID,c.classCode,s.subDesc,d.dayDesc day,CONCAT(TIME_FORMAT(c.timeIn, '%h:%i%p'),'-',TIME_FORMAT(c.timeOut, '%h:%i%p')) class_time,r.roomName,CONCAT(u.ln,', ',u.fn,' ',u.mn) faculty FROM studclass sc
				INNER JOIN class c ON sc.classID = c.classID
				INNER JOIN subject s ON c.subID = s.subID
				INNER JOIN room r ON c.roomID=r.roomID
				INNER JOIN day d ON c.dayID=d.dayID
				INNER JOIN faculty f ON c.facID=f.facID
				INNER JOIN users u ON f.uID=u.uID
				WHERE sc.studID = $studID AND sc.classID = (SELECT classID FROM class WHERE termID = $termID AND subID=".$s->subID." LIMIT 1)
			")->row();

		}
		return $data;
	}

	function get_grades($classID, $studID){
		echo json_encode(
			$this->db->select('prelim,midterm,prefi,final,finalgrade,remarks,(SELECT metric FROM grade_metric WHERE grade = ROUND(finalgrade) LIMIT 1) equiv')->get_where('studclass', "classID = $classID AND studID = $studID", 1)->row()
		);
	}

	function comply(){
		//print_r($_POST); die();
		$classIDs = [];
		$studID = $this->input->post('studID');
		$classID = $this->input->post('classID');
		$termID = $this->input->post('termID');
		$prelim = $this->input->post('prelim')['grade'];
		$midterm = $this->input->post('midterm')['grade'];
		$prefi = $this->input->post('prefi')['grade'];
		$final = $this->input->post('final')['grade'];
		
		$this->db->trans_start();

		$sql = $this->db->query("
			SELECT s.id, s.prosID FROM subject s INNER JOIN class c ON s.subID = c.subID WHERE c.classID = $classID LIMIT 1
		")->row();

		$subIDs = $this->db->query("SELECT subID FROM subject WHERE id = ".$sql->id." AND prosID = ".$sql->prosID)->result();

		foreach($subIDs as $s){
			$classIDs[] = $this->db->query("SELECT classID FROM class WHERE termID = $termID AND subID=".$s->subID." LIMIT 1")->row()->classID;
		}

		$gf = $this->db->get('grade_formula')->row();
		$fg = round(($prelim * $gf->prelim) + ($midterm * $gf->midterm) + ($prefi * $gf->prefi) + ($final * $gf->final), 2);
		$fg2 = round($fg);

		if($fg2 < 75){
			$remarks = 'Failed';
			$equiv = '5.0';
		}else{
			$remarks = 'Passed';
			$equiv = $this->db->select('metric')->get_where('grade_metric', "grade = $fg2", 1)->row()->metric;
		}
		$data['prelim'] = $prelim;
		$data['midterm'] = $midterm;
		$data['prefi'] = $prefi;
		$data['final'] = $final;
		$data['finalgrade'] = $fg;
		$data['remarks'] = $remarks;

		foreach($classIDs as $classID){
			$this->db->update('studclass', $data, "studID = $studID AND classID = ".$classID);
		}

		foreach($subIDs as $s){
			$this->db->update('studgrade',['sgGrade' => $equiv, 'remarks' => $remarks], "subID = ".$s->subID." AND studID = $studID");
		}


		$this->db->trans_complete();

		echo json_encode(['fg'=>$fg,'equiv'=>$equiv,'remarks'=>$remarks]);

	}

}

?>