<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Faculty extends CI_Model{

	private function count_all(){
		$query = $this->db->query("SELECT total FROM counter2 WHERE module = 'faculty' LIMIT 1");
		$rs = $query->row();
		if($rs){
			return $rs->total;
		}else{
			return 0;
		}
	}

	function un_generator($un){
		$i = 1;
		while(true){
			$query = $this->db->query("
				SELECT 1 FROM users WHERE userName = '$un' LIMIT 1
			")->row();
			if($query){
				$un = $un.$i;
			}else{
				break;
			}
			++$i;
		}
		return $un;
	}

	function create(){
		$this->get_form_data($data);
		
		$this->db->trans_start();

		$data['userPass'] = substr(str_shuffle("0123456789"), 0, 6);
		$data['userName'] = $this->un_generator($data['ln']);
		$data['roleID'] = 2;
		$this->get_form_data($data);
	
		$this->db->insert('users', $data);
		$uID = $this->db->insert_id();
		$special = $this->input->post('special');
		$this->db->insert('faculty', ['uID' => $uID, 'special' => $special]);
		$facID = $this->db->insert_id();

		$specs = $this->input->post('spec');
		foreach($specs as $s){
			$this->db->insert('fac_spec', ['facID' => $facID, 'specID' => $s['specID']]);
		}

		$query = $this->db->query("SELECT 1 FROM counter2 WHERE module = 'faculty' LIMIT 1");
		$row =  $query->row();
		if($row){
			$this->db->query("UPDATE counter2 SET total = total + 1 WHERE module = 'faculty'");
		}else{
			$this->db->query("INSERT INTO counter2(module,total) VALUES('faculty','1')");
		}

		//$this->send_mail($data);

		$this->db->trans_complete();

		echo $facID;
		

	}

	function read($option = 'u.fn',$search_val = NULL, $page = '1', $per_page = '10', $termID){
		$start = ($page - 1) * $per_page;
		$search_val = strtr($search_val, '_', ' ');
		if(trim($search_val) == ''){
			$query = $this->db->query("
				SELECT u.uID,f.facID,f.special,CONCAT(u.ln,', ',u.fn,' ',u.mn) name, u.status,u.is_new,
				(SELECT 1 FROM class WHERE termID = $termID AND facID = f.facID LIMIT 1) has_classes 
				FROM faculty f 
				INNER JOIN users u ON f.uID = u.uID
				WHERE f.facID <> 0
				LIMIT $start, $per_page
			"); 
			$num_records = $this->count_all();
		}else{
			$query = $this->db->query("
				SELECT u.uID,f.facID,f.special,CONCAT(u.ln,', ',u.fn,' ',u.mn) name, u.status,u.is_new,
				(SELECT 1 FROM class WHERE termID = $termID AND facID = f.facID LIMIT 1) has_classes 
				FROM faculty f 
				INNER JOIN users u ON f.uID = u.uID
				WHERE f.facID <> 0 AND $option LIKE '%".$search_val."%' 
				ORDER BY $option ASC
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

	// function read($option = 'u.fn',$search_val = NULL, $page = '1', $per_page = '10', $termID){
	// 	$records = [];
	// 	$start = ($page - 1) * $per_page;
	// 	$search_val = strtr($search_val, '_', ' ');
	// 	if(trim($search_val) == ''){
	// 		$query = $this->db->query("
	// 			SELECT u.uID,f.facID,CONCAT(u.ln,', ',u.fn,' ',u.mn) name, u.status,u.is_new,
	// 			(SELECT 1 FROM class WHERE termID = $termID AND facID = facID LIMIT 1) has_classes 
	// 			FROM faculty f 
	// 			INNER JOIN users u ON f.uID = u.uID
	// 			WHERE f.facID <> 0
	// 			LIMIT $start, $per_page
	// 		"); 
	// 		$num_records = $this->count_all();
	// 	}else{
	// 		if($option != 's.specDesc'){
	// 			$option = "CONCAT(u.ln,', ',u.fn,' ',u.mn)";
	// 			$query = $this->db->query("
	// 			SELECT u.uID,f.facID,CONCAT(u.ln,', ',u.fn,' ',u.mn) name, u.status,u.is_new,
	// 			(SELECT 1 FROM class WHERE termID = $termID AND facID = facID LIMIT 1) has_classes 
	// 			FROM faculty f 
	// 			INNER JOIN users u ON f.uID = u.uID
	// 			WHERE f.facID <> 0 AND $option LIKE '%".$search_val."%' 
	// 			ORDER BY $option ASC
	// 			LIMIT $start, $per_page"
	// 		);
	// 		}else{
	// 			$query = $this->db->query("
	// 				SELECT u.uID,f.facID,CONCAT(u.ln,', ',u.fn,' ',u.mn) name, u.status,s.specDesc,u.is_new,
	// 				(SELECT 1 FROM class WHERE termID = $termID AND facID = facID LIMIT 1) has_classes 
	// 				FROM faculty f 
	// 				INNER JOIN users u ON f.uID = u.uID
	// 				INNER JOIN fac_spec fs ON f.facID = fs.facID 
	// 				INNER JOIN specialization s ON fs.specID = s.specID 
	// 				WHERE f.facID <> 0 AND $option LIKE '%".$search_val."%' 
	// 				ORDER BY $option ASC
	// 				LIMIT $start, $per_page"
	// 			);
	// 		}
			
	// 		$num_records = $query->num_rows();
	// 	}

	// 	$faculties = $query->result();
	// 	foreach($faculties as $f){
	// 		$specs = $this->db->query("SELECT s.specDesc FROM fac_spec fs INNER JOIN specialization s ON fs.specID = s.specID WHERE fs.facID = ".$f->facID)->result();
	// 		$records[] = ['facInfo' => $f, 'specs' => $specs];
	// 	}

	// 	$output = [
	// 		'total_rows'=> $num_records, 
	// 		'records' => $records
	// 	];
	// 	echo json_encode($output);
	// }

	function read_one($id,$termID){
		$this->check_form_id($id);

		$faculty = $this->db->query("
			SELECT f.facID,f.special,u.uID,u.userName,u.userPass,u.is_new,u.fn,u.mn,u.ln,u.dob,u.sex,u.cn,u.email,u.address,u.status,
			(SELECT 1 FROM class WHERE termID = $termID AND facID = f.facID LIMIT 1) has_classes 
			FROM faculty f 
			INNER JOIN users u ON f.uID = u.uID
			WHERE f.facID = $id LIMIT 1
		")->row();
		
		$specs = $this->db->query("
			SELECT s.specID, CONCAT(p.prosCode,' | ',s.specDesc) specDesc 
			FROM fac_spec fs 
			INNER JOIN specialization s ON fs.specID = s.specID 
			INNER JOIN prospectus p ON s.prosID = p.prosID
			WHERE fs.facID = $id
			ORDER BY p.prosType, p.prosCode ASC
			")->result();

		// $data['specs'] = $this->db->query("
		// 		SELECT s.specID, CONCAT(p.prosCode,' | ',s.specDesc) specDesc 
		// 		FROM room_spec rs 
		// 		INNER JOIN specialization s ON rs.specID = s.specID 
		// 		INNER JOIN prospectus p ON s.prosID = p.prosID
		// 		WHERE rs.roomID = ".$data['room']->roomID."
		// 		ORDER BY p.prosType, p.prosCode ASC
		// 		")->result();

		return ['facInfo' => $faculty, 'specs' => $specs];
	}

	function read_user($id){
		$this->check_form_id($id);
		$arr = [];
		$data['facID'] = $id;
		$data['user'] = $this->db->query("
			SELECT uID,userName,CONCAT(fn,' ',mn,' ',ln) name FROM users WHERE uID = (SELECT uID FROM faculty WHERE facID = $id LIMIT 1) LIMIT 1
		")->row(); 
		$modules = $this->db->query("
			SELECT modID FROM access_rights WHERE uID = ". $data['user']->uID
		)->result();
		foreach($modules as $m){
			$arr[] = $m->modID;
		}
		$data['modules'] = $arr;
		return $data;
	}

	function update(){
		$id = $this->input->post('id');

		$this->db->trans_start();
		$uID = $this->db->query("SELECT uID FROM faculty WHERE facID = $id LIMIT 1")->row()->uID;

		$this->get_form_data($data);

		$fac['special'] = $this->input->post('special');
		$this->db->update('faculty', $fac, "facID = $id");
		$this->db->update('users', $data, "uID = $uID");
		$specs = $this->input->post('spec');
		$this->db->delete('fac_spec', "facID = $id");
		if($specs){
			foreach($specs as $s){
				$this->db->insert('fac_spec', ['specID' => $s['specID'], 'facID' => $id]);
			}	
		}
		

		$this->db->trans_complete();

	}

	function updateAccess(){
		$uID = $this->input->post('uID');
		$modID = $this->input->post('modID');
		$sql = $this->db->query("SELECT 1 FROM access_rights WHERE uID = $uID AND modID = $modID LIMIT 1")->row();
		if($sql){
			$this->db->delete('access_rights', "uID = $uID AND modID = $modID");
		}else{
			$this->db->insert('access_rights', ['uID'=>$uID, 'modID'=>$modID]);
		}
	}

	function delete($id){
		$this->db->trans_start();
		$uID = $this->db->select('uID')->get_where('faculty', "facID = $id", 1)->row()->uID;
		$this->db->delete('fac_spec', 'facID = '.$id);
		$this->db->delete('faculty', 'facID = '.$id);
		$this->db->delete('access_rights', 'uID = '.$uID);
		$this->db->delete('users', 'uID = '.$uID);
		$this->db->query("UPDATE counter2 SET total = total - 1 WHERE module = 'faculty'");
		$this->db->trans_complete();
	}

	function get_form_data(&$data){
		$data['email'] = $this->input->post('email');
		$data['fn'] = $this->input->post('fn');
		$data['mn'] = $this->input->post('mn');
		$data['ln'] = $this->input->post('ln');
		$data['dob'] = $this->input->post('dob');
		$data['sex'] = $this->input->post('sex')['sex'];
		$data['address'] = $this->input->post('address');
		$data['cn'] = $this->input->post('cn');
	}
	
	// function check_exist($un, $id = NULL){
	// 	$exist = false;
	// 	if($id == NULL){
	// 		$query = $this->db->query("
	// 			SELECT 1 FROM users WHERE userName = '$un' LIMIT 1
	// 		");
	// 	}else{
	// 		$query = $this->db->query("
	// 			SELECT 1 FROM users WHERE uID <> $id AND userName = '$un' LIMIT 1
	// 		");
	// 	}
		
	// 	if($query->row()){
	// 		$exist = true;
	// 	}
	// 	return $exist;
	// }

	function check_form_id($id){
		$query = $this->db->select('1')->get_where('faculty', 'facID='.$id,1);
		if(!$query->row()){
			show_404();
		}
	}

	function is_safe_delete($id){
		$output = 0;
		$query = $this->db->select('1')->get_where('class', "facID = $id", 1)->row();

		if(!$query){
			$output = 1;
		}

		echo $output;

	}

	function fetchSpec(){
		echo json_encode(
			$this->db->query("SELECT s.specID, CONCAT(p.prosCode,' | ',s.specDesc) specDesc FROM specialization s INNER JOIN prospectus p ON s.prosID = p.prosID ORDER BY p.prosType, p.prosCode ASC")->result()
		);
	}

	function changeStatus(){
		$uID = $this->input->post('uID');
		$data['status'] = $this->input->post('status');
		$this->db->update('users', $data, "uID = $uID");
	}

	function populateSpec($id){
		echo json_encode(
			$this->db->query("
				SELECT s.specID, CONCAT(p.prosCode,' | ',s.specDesc) specDesc 
				FROM fac_spec fs 
				INNER JOIN specialization s ON fs.specID = s.specID 
				INNER JOIN prospectus p ON s.prosID = p.prosID
				WHERE fs.facID = $id
				ORDER BY p.prosType, p.prosCode ASC
				")->result()
		);
		// echo json_encode(
		// 	$this->db->query("
		// 		SELECT s.specID, CONCAT(p.prosCode,' | ',s.specDesc) specDesc 
		// 		FROM room_spec rs 
		// 		INNER JOIN specialization s ON rs.specID = s.specID 
		// 		INNER JOIN prospectus p ON s.prosID = p.prosID
		// 		WHERE rs.roomID = $id
		// 		ORDER BY p.prosType, p.prosCode ASC
		// 		")->result()
		// );
	}

}

?>