<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Student extends CI_Model{

	private function count_all(){
		$query = $this->db->query("SELECT total FROM counter2 WHERE module = 'student' LIMIT 1");
		$rs = $query->row();
		if($rs){
			return $rs->total;
		}else{
			return 0;
		}
	}

	private function is_gmail_exist($mail, $uID = NULL){
		if($uID){
			$is_exist = $this->db->select('1')->get_where('users', "email = '$mail' AND uID <> $uID", 1)->row();
		}else{
			$is_exist = $this->db->select('1')->get_where('users', "email = '$mail'", 1)->row();
		}
		
		if($is_exist){
			return true;
		}
		return false;
	}

	function create($termID){
		//print_r($_POST); die();
		$mail_status = 'not-sent';
		$this->db->trans_start();
		$this->get_form_data($data);
		$data['roleID'] = 4;

		if($data['email']){
			if($this->is_gmail_exist($data['email'])){
				die('error');
			}
			$data['status'] = 'active';
			$data['userPass'] = $this->rand_pw();
			$data['userName'] = explode("@", $data['email'])[0];
			$body = '';
			$body .= "Username: ".$data['userName'];
			$body .= "\n";
			$body .= "Password: ".$data['userPass'];
			if($this->send_mail($body, $data['email'])){
				$mail_status = 'sent';
			}
			
		}
		$this->db->insert('users', $data);
		$data2['uID'] = $this->db->insert_id();
		$data2['controlNo'] = $this->input->post('controlNo');
		$data2['yearID'] = $this->input->post('year')['yearID'];
		$data2['status'] = $this->input->post('status')['statDesc'];
		$this->db->insert('student', $data2);
		$data3['studID'] = $this->db->insert_id();
		$data3['prosID'] = $this->input->post('pros')['prosID'];
		$this->db->insert('studprospectus', $data3);

		$query = $this->db->query("SELECT 1 FROM counter2 WHERE module = 'student' LIMIT 1");
		$row =  $query->row();
		if($row){
			$this->db->query("UPDATE counter2 SET total = total + 1 WHERE module = 'student'");
		}else{
			$this->db->query("INSERT INTO counter2(module,total) VALUES('student','1')");
		}
		$this->db->trans_complete();
		echo json_encode(['output'=>'success','studID'=>$data3['studID'], 'mailStat' => $mail_status]);
	}

	function read($option = 's.controlNo',$search_val = NULL, $page = '1', $per_page = '10'){
		$start = ($page - 1) * $per_page;
		$search_val = strtr($search_val, '_', ' ');
		if(trim($search_val) == ''){
			$query = $this->db->query("
				SELECT s.studID,u.uID,u.userName,y.yearDesc,s.controlNo,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name,u.status,c.courseCode
				FROM student s 
				INNER JOIN year y ON s.yearID = y.yearID 
				INNER JOIN studprospectus sp ON s.studID = sp.studID 
				INNER JOIN prospectus p ON sp.prosID = p.prosID 
				INNER JOIN course c ON p.courseID = c.courseID
				INNER JOIN users u ON s.uID = u.uID
				LIMIT $start, $per_page
			");
			$num_records = $this->count_all();
		}else{
			$query = $this->db->query("
				SELECT s.studID,u.uID,u.userName,y.yearDesc,s.controlNo,CONCAT(u.ln,', ',u.fn,' ',LEFT(u.mn,1)) name,u.status,c.courseCode
				FROM student s 
				INNER JOIN year y ON s.yearID = y.yearID 
				INNER JOIN studprospectus sp ON s.studID = sp.studID 
				INNER JOIN prospectus p ON sp.prosID = p.prosID 
				INNER JOIN course c ON p.courseID = c.courseID
				INNER JOIN users u ON s.uID = u.uID
				WHERE $option LIKE '%".$search_val."%' 
				LIMIT $start, $per_page"
			);
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
			SELECT s.studID,s.status,y.yearID,y.yearDesc,c.courseID,c.courseCode,p.prosID,p.prosCode,s.controlNo,u.fn,u.mn,u.ln,u.dob,u.sex,u.address,u.cn,u.email,u.userName
			FROM student s 
			INNER JOIN year y ON s.yearID = y.yearID 
			INNER JOIN studprospectus sp ON s.studID = sp.studID 
			INNER JOIN prospectus p ON sp.prosID = p.prosID 
			INNER JOIN course c ON p.courseID = c.courseID
			INNER JOIN users u ON s.uID = u.uID
			WHERE s.studID = $id
		");
		return $query->row();
	}

	function update($termID){
		$id = $this->input->post('id');
		$prosID = $this->input->post('pros')['prosID'];
		$uID = $this->db->query("SELECT uID FROM student WHERE studID = $id LIMIT 1")->row()->uID;

		$data2['yearID'] = $this->input->post('year')['yearID'];
		$data2['controlNo'] = $this->input->post('controlNo');
		$data2['status'] = $this->input->post('status')['statDesc'];
		$data3['prosID'] = $prosID;
	
		$this->get_form_data($data, 'update');

		$this->db->trans_start();

		if($data['email']){
			if($this->is_gmail_exist($data['email'], $uID)){
				die('error');
			}
		}

		$this->db->update('studprospectus', $data3, "studID = $id");
		$this->db->update('student', $data2, "studID = $id");
		
		$this->db->update('users', $data, "uID = $uID");

		$is_exist_in_studrec_per_term = $this->db->select("id")->get_where('studrec_per_term', "termID = $termID AND studID = $id", 1)->row();
		if($is_exist_in_studrec_per_term){
			$this->db->update('studrec_per_term',['yearID'=>$data2['yearID'], 'prosID'=>$data3['prosID'], 'status'=>$data2['status']],"id = ".$is_exist_in_studrec_per_term->id);
		}

		$this->db->trans_complete();
		echo "success";
	}

	function delete($id){
		$userID = $this->db->query("SELECT uID FROM student WHERE studID = $id LIMIT 1")->row()->uID;
		$this->db->delete('studprospectus', 'studID = '.$id);
		$this->db->delete('student', 'studID = '.$id);
		$this->db->delete('users', 'uID = '.$userID);

		$this->db->query("UPDATE counter2 SET total = total - 1 WHERE module = 'student'");
	}

	function check_exist($un, $id = NULL){
		$exist = false;
		if($id == NULL){
			$query = $this->db->query("
				SELECT 1 FROM users WHERE userName = '$un' LIMIT 1
			");
		}else{
			$query = $this->db->query("
				SELECT 1 FROM users WHERE uID <> $id AND userName = '$un' LIMIT 1
			");
		}
		
		if($query->row()){
			$exist = true;
		}
		return $exist;
	}

	function check_form_id($id){
		$query = $this->db->select('1')->get_where('student', 'studID='.$id,1);
		if(!$query->row()){
			show_404();
		}
	}

	function is_safe_delete($id){
		$output = 0;
		$query = $this->db->select('1')->get_where('studclass', "studID = $id", 1)->row();
		$query2 = $this->db->select('1')->get_where('studgrade', "studID = $id", 1)->row();
		$query3 = $this->db->select('1')->get_where('stud_fee', "studID = $id", 1)->row();

		if(!$query && !$query2 && !$query3){
			$output = 1;
		}

		echo $output;

	}

	function get_form_data(&$data, $action = NULL){
		$data['fn'] = $this->input->post('fn');
		$data['mn'] = $this->input->post('mn');
		$data['ln'] = $this->input->post('ln');
		$data['sex'] = $this->input->post('sex')['sex'];

		$data['dob'] = $this->input->post('dob');
		$data['address'] = $this->input->post('address');
		$data['cn'] = $this->input->post('cn');
		$data['email'] = $this->input->post('email');
		
	}


	function get_courses(){
		echo json_encode(
			$this->db->query("
				SELECT courseID,courseCode FROM course
			")->result()
		);
	}

	function get_prospectuses($courseID){
		echo json_encode(
			$this->db->query("
				SELECT prosID,prosCode FROM prospectus WHERE courseID = $courseID ORDER BY prosCode ASC
			")->result()
		);
	}

	function get_years($prosID){
		echo json_encode(
			$this->db->query("
				SELECT yearID,yearDesc FROM year WHERE duration <= (SELECT duration FROM prospectus WHERE prosID = $prosID LIMIT 1)
			")->result()
		);
	}

	function changeStatus(){
		$uID = $this->input->post('uID');
		$data['status'] = $this->input->post('status');
		$this->db->update('users', $data, "uID = $uID");
	}

	function get_credited_subjects($studID, $value = NULL){
		$data = $arr = [];
		$sql = $this->db->query("SELECT s.prosID,s.id,s.units,s.subCode,s.subDesc FROM studgrade sg INNER JOIN subject s ON sg.subID=s.subID WHERE sg.studID = $studID AND sg.grade_type = 'Credit'")->result();

		//loop that combine subjects with lec and lab and add their units
		foreach($sql as $s){
			$ok = true;

			$i = 0;
			foreach($data as $d){ //check if exist
				if($d->id == $s->id){
					$data[$i]->units += $s->units;
					$ok = false;
					break;
				}
				++$i;
			}

			if($ok){
				$data[] = $s;
			}

		}

		if($value == NULL){
			echo json_encode($data);
		}else{
			return $data;
		}
		
	}

	function searchSubjects(){
		$data = [];
		$studID = $this->input->post("studID");
		$value = $this->input->post("value");

		$credited_subjects = $this->get_credited_subjects($studID, 'search');

		$searched_subjects = $this->db->query("
			SELECT DISTINCT id,prosID,subCode
			FROM subject
			WHERE prosID = (SELECT prosID FROM studprospectus WHERE studID = $studID LIMIT 1) AND
			subCode LIKE '%".$value."%' 
			LIMIT 10
		")->result();

		if($credited_subjects){
			foreach($searched_subjects as $ss){

				$ok = true;

				foreach($credited_subjects as $cs){
					if($cs->id == $ss->id){
						$ok = false;
						break;
					}
				}

				if($ok){
					$data[] = $ss;
				}

			}
		}else{
			$data = $searched_subjects;
		}

		

		echo json_encode($data);

	}

	function add_credit(){
		$studID = $this->input->post("studID");
		$termID = $this->input->post("termID");

		$subjects = $this->input->post("subjects");
		$this->db->trans_start();

		foreach($subjects as $subject){
			$subIDs = $this->db->query("SELECT subID FROM subject WHERE id = ".$subject['id']." AND prosID = ".$subject['prosID'])->result();
			foreach($subIDs as $s){
				$this->db->insert('studgrade', [
					'studID'=>$studID, 
					'subID'=>$s->subID, 
					'uID'=>$this->session->userdata('uID'),
					'termID'=>$termID,
					'grade_type'=>'Credit'
				]);
			}
		}

		$this->db->trans_complete();

		$this->get_credited_subjects($studID);

	}

	function remove_credit(){
		$studID = $this->input->post("studID");
		$subject = $this->input->post("subject");

		$this->db->trans_start();

		$subIDs = $this->db->query("SELECT subID FROM subject WHERE id = ".$subject['id']." AND prosID = ".$subject['prosID'])->result();

		foreach($subIDs as $s){
			$this->db->delete('studgrade', "studID = $studID AND grade_type = 'Credit' AND subID = ".$s->subID);
		}

		$this->db->trans_complete();
		
	}

	function rand_pw(){
		return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"), 0, 8);
	}

	function sendLogin(){
		//turn on less secure apps in https://myaccount.google.com/security
		$id = $this->input->post("id");
		$body = '';
		$studData = $this->db->query("SELECT email, uID FROM users WHERE uID = (SELECT uID FROM student WHERE studID = $id LIMIT 1) LIMIT 1")->row();
		$new_pw = $this->rand_pw();
		$new_un = explode("@", $studData->email)[0];

		$body .= "Username: ".$new_un;
		$body .= "\n";
		$body .= "Password: ".$new_pw;
		

		if($this->send_mail($body, $studData->email)){
			$this->db->update('users', ['userName'=>$new_un, 'userPass'=>$new_pw, 'status'=>'active'], "uID = ".$studData->uID);
			echo "success";
		}else{
			echo "error";
		}
	}

	private function send_mail($body, $mail_to){
		$subj = 'WLC CICTE login details';
		$mail_from = ['gmail'=>'cictewlc@gmail.com', 'name'=>'CICTE WLC'];
		$mail_un = 'nightfury102497@gmail.com';
		$mail_pw = 'Jesusismysavior102497';

		$mail = new PHPMailer\PHPMailer\PHPMailer(TRUE);
		$mail->isSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true;
		$mail->Username = $mail_un;
		$mail->Password = $mail_pw;
		$mail->SMTPSecure = "ssl";
		$mail->Port = 465;
		$mail->Subject = $subj;
		$mail->Body = $body;

	   	$mail->setFrom($mail_from['gmail'], $mail_from['name']);
	   	$mail->addAddress($mail_to);
	   	
	   	try{
	   		$mail->send();
	   		return true;
	   	}catch(Exception $e){
	   		return false;
	   	}
	}

}

?>