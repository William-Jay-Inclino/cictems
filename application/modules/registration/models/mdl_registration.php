<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Registration extends CI_Model{

	private function count_all(){
		$query = $this->db->query("SELECT total FROM counter2 WHERE module = 'reg_requests' LIMIT 1");
		$rs = $query->row();
		if($rs){
			return $rs->total;
		}else{
			return 0;
		}
	}

	function read($option = 'userName',$search_val = NULL, $page = '1', $per_page = '10'){
		$start = ($page - 1) * $per_page;
		$search_val = strtr($search_val, '_', ' ');
		if(trim($search_val) == ''){
			$query = $this->db->select('regID, roleID, userName, CONCAT(ln,", ",fn," ",mn) name')->get('registration', $per_page, $start);
			$num_records = $this->count_all();
		}else{
			$option = ($option == 'userName') ? 'userName' : 'CONCAT(ln,", ",fn," ",mn)';
			$query = $this->db->select('regID, roleID, userName, CONCAT(ln,", ",fn," ",mn) name')->like($option, $search_val)->get('registration', $per_page, $start);
			$num_records = $query->num_rows();
		}
		$output = [
			'total_rows'=> $num_records, 
			'records' => $query->result()
		];
		echo json_encode($output);
	}

	function read_one($id){
		$this->check_form_id($id);

		$query = $this->db->query("
			SELECT * FROM registration 
			WHERE regID = $id LIMIT 1
		");
		return $query->row();
	}

	function delete($id){
		$this->db->trans_start();
		$this->db->delete('registration', "regID = $id");
		$this->db->query("UPDATE counter2 SET total = total - 1 WHERE module = 'reg_requests'");
		$this->db->trans_complete();
	}

	function is_ok_confirm($uID){
		$output = 0;
		$is_exist = $this->db->select('1')->get_where('student', "uID = $uID AND has_user = 'yes'", 1)->row();
		if($is_exist){
			$output = 1;
		}
		echo $output;
	}

	function confirmRequest($regID){
		$this->db->trans_start();
		$sql = $this->db->get_where('registration', "regID = $regID", 1)->row();
		$data['userName'] = $sql->userName;
		$data['userPass'] = $sql->userPass;
		$data['dob'] = $sql->dob;
		$data['address'] = $sql->address;
		$data['cn'] = $sql->cn;
		$data['email'] = $sql->email;
		$data['status'] = 'active';
		if($sql->roleID == '4'){
			$this->db->update('student', ['has_user'=>'yes'], 'uID = '.$sql->uID);
			$this->db->update('users', $data, 'uID = '.$sql->uID);
			$this->db->query("UPDATE counter2 SET total = total + 1 WHERE module = 'active_students'");
		}else{
			$data['roleID'] = $sql->roleID;
			$data['fn'] = $sql->fn;
			$data['mn'] = $sql->mn;
			$data['ln'] = $sql->ln;
			$data['sex'] = $sql->sex;
			$this->db->insert('users', $data);
			$uID = $this->db->insert_id();
		}
		
		if($sql->roleID == '2'){
			$this->db->insert('faculty', ['uID' => $uID]);
			$this->db->query("UPDATE counter2 SET total = total + 1 WHERE module = 'faculty'");
		}else if($sql->roleID == '3'){
			$this->db->insert('staff', ['uID' => $uID]);
			$this->db->query("UPDATE counter2 SET total = total + 1 WHERE module = 'staff'");
		}else if($sql->roleID == '5'){
			$students = $this->db->select('studID')->get_where('reg_guardian', "regID = $regID")->result();
			foreach($students as $student){
				$this->db->insert('guardian', ['uID' => $uID, 'studID' => $student->studID]);
			}
			$this->db->delete('reg_guardian', "regID = $regID");
			$this->db->query("UPDATE counter2 SET total = total + 1 WHERE module = 'guardian'");
		}
		$this->db->delete('registration', "regID = $regID");
		$this->db->query("UPDATE counter2 SET total = total - 1 WHERE module = 'reg_requests'");
		$query = $this->db->query("SELECT 1 FROM counter2 WHERE module = 'reg_users' LIMIT 1");
		$row =  $query->row();
		if($row){
			$this->db->query("UPDATE counter2 SET total = total + 1 WHERE module = 'reg_users'");
		}else{
			$this->db->query("INSERT INTO counter2(module,total) VALUES('reg_users','1')");
		}
		$this->db->trans_complete();
	}

	function fetchStudents($regID){
		$studIDs = $this->db->select('studID')->get_where('reg_guardian', "regID = $regID")->result();
		foreach($studIDs as $studID){
			$students[] = $this->db->query("
				SELECT CONCAT(u.ln,', ',u.fn,' ',u.mn) name FROM student s
				INNER JOIN users u ON s.uID = u.uID 
				WHERE s.studID = ".$studID->studID." LIMIT 1
			")->row();
		}
		echo json_encode($students);
	}

	function check_form_id($id){
		$query = $this->db->select('1')->get_where('registration', 'regID='.$id,1);
		if(!$query->row()){
			show_404();
		}
	}

}

?>