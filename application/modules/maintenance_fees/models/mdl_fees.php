<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Fees extends CI_Model{

	private function count_all($termID){
		$query = $this->db->query("SELECT total FROM counter WHERE module = 'fees' AND termID = $termID LIMIT 1");
		$rs = $query->row();
		if($rs){
			return $rs->total;
		}else{
			return 0;
		}
	}

	function create(){
		//print_r($_POST); die();
		$exist = false;
		$data = $this->input->post('data');
		$data['termID'] = $data['termID']['termID'];
		$data['tshirt'] = $data['tshirt']['tshirt'];
		$this->check_exist($data,$exist);
		if($exist){
			$output = ['status' => 0];
		}else{
			$this->db->insert('fees', $data);
			$output = ['status'=> 1,'id'=>$this->db->insert_id()];

			$query = $this->db->query("SELECT 1 FROM counter WHERE termID = ".$data['termID']." AND module = 'fees' LIMIT 1");
			$row =  $query->row();
			if($row){
				$this->db->query("UPDATE counter SET total = total + 1 WHERE termID = ".$data['termID']." AND module = 'fees'");
			}else{
				$this->db->insert('counter', ['module'=>'fees','termID'=>$data['termID'],'total'=>1]);
			}
		}

		echo json_encode($output);
	}

	function read($search_val = NULL, $page = '1', $per_page = '10',$termID = 24){
		$start = ($page - 1) * $per_page;
		$search_val = strtr($search_val, '_', ' ');
		if(trim($search_val) == ''){
			$query = $this->db->query("
				SELECT * FROM fees
				WHERE termID = $termID
				LIMIT $start, $per_page
			");
			$num_records = $this->count_all($termID);
		}else{
			$query = $this->db->query("
				SELECT * FROM fees
				WHERE feeName LIKE '%".$search_val."%' AND termID = $termID
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

		return $this->db->query("
			SELECT CONCAT(t.schoolYear,' ',s.semDesc) term,t.termID,f.feeID,f.feeName,f.feeDesc,f.dueDate,f.feeStatus,f.amount,f.tshirt 
			FROM fees f 
			INNER JOIN term t on f.termID = t.termID 
			INNER JOIN semester s on t.semID = s.semID 
			WHERE f.feeID = $id LIMIT 1
			")->row();
	}

	function update(){
		$exist = false;
		$data = $this->input->post('data');
		$id = $this->input->post('id');
		$data['termID'] = $data['termID']['termID'];
		$data['tshirt'] = $data['tshirt']['tshirt'];

		$this->db->trans_start();
		$this->check_exist($data,$exist,$id);

		if($exist){
			$output = ['status' => 0];
		}else{
			$new_amount = (double)$data['amount'];
			$amount = (double)$this->db->select('amount')->get_where('fees',"feeID = $id", 1)->row()->amount;

			$this->db->update('fees', $data, "feeID = $id");
			
			if($amount != $new_amount){
				$diff = $new_amount - $amount;

				$payers = $this->db->select('sfID,payable,receivable')->get_where('stud_fee', "feeID = $id")->result();

				foreach($payers as $p){
					if($diff > 0){ //ge pa dako ang amount
						if($p->receivable > 0.00){ 
							$x = $diff - $p->receivable;
							if($x >= 0){ //mas dako ang ge dagdag sa receivable
								$this->db->update('stud_fee',['payable'=>$x, 'receivable'=>0.00], "sfID = ".$p->sfID);	
							}else{
								$this->db->update('stud_fee',['receivable'=>abs($x)], "sfID = ".$p->sfID);	
							}
						}else{
							$this->db->update('stud_fee',['payable'=>$p->payable + $diff], "sfID = ".$p->sfID);	
						}
						
					}else{ //ge pa gamyan ang amount
						$x = $p->payable - abs($diff);
						if($x < 0){
							$this->db->update('stud_fee', ['payable'=>0.00, 'receivable' => abs($x)], "sfID = ".$p->sfID);
						}else{
							$this->db->update('stud_fee', ['payable'=>$x], "sfID = ".$p->sfID);
						}
					}
				}
			}

			
			$output = ['status' => 1];
		}
		$this->db->trans_complete();
		echo json_encode($output);
	}

	function delete($id, $termID){
		$this->db->trans_start();
		$this->db->delete('fees', 'feeID = '.$id);
		$this->db->query("UPDATE counter SET total = total - 1 WHERE module = 'section' AND termID = $termID");
		$this->db->trans_complete();
	}

	function check_exist($data,&$exist,$id = NULL){
		if($id == NULL){
			$query = $this->db->query("
				SELECT 1 FROM fees WHERE feeName = '".$data['feeName']."'  LIMIT 1
			");
		}else{
			$query = $this->db->query("
				SELECT 1 FROM fees WHERE feeID <> $id AND feeName = '".$data['feeName']."' LIMIT 1
			");
		}
		
		if($query->row()){
			$exist = true;
		}
	}

	function check_form_id($id){
		$query = $this->db->select('1')->get_where('fees', 'feeID='.$id,1);
		if(!$query->row()){
			show_404();
		}
	}

	function is_safe_delete($id){
		$output = 0;
		$query = $this->db->select('1')->get_where('stud_fee', "feeID = $id", 1)->row();
		$query2 = $this->db->select('1')->get_where('payments', "feeID = $id", 1)->row();

		if(!$query && !$query2){
			$output = 1;
		}
		echo $output;
	}

	function get_involved_students($feeID){
		return $this->db->query("
				SELECT s.studID,s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name,y.yearID,y.yearDesc,course.courseID,course.courseCode,y.yearID,course.courseID,sf.payable
				FROM stud_fee sf
				INNER JOIN student s ON sf.studID = s.studID 
				INNER JOIN users u ON s.uID = u.uID 
				INNER JOIN studprospectus sp ON s.studID = sp.studID
				INNER JOIN prospectus p ON sp.prosID = p.prosID  
				INNER JOIN course ON p.courseID = course.courseID  
				INNER JOIN year y ON s.yearID = y.yearID
				WHERE sf.feeID = $feeID
				ORDER BY name ASC
				")->result();
	}

	function populate($feeID){
		$data['courses'] = $this->db->query("SELECT courseID, courseCode FROM course ORDER BY courseCode ASC")->result();
		$data['years'] = $this->db->query("SELECT yearID, yearDesc FROM year ORDER BY duration ASC")->result();
		$data['involved_students'] = $this->get_involved_students($feeID);
		echo json_encode($data);
	}

	function generateFilter(){
		$total_added = 0;
		$courses = $this->input->post('courses');
		$years = $this->input->post('years');
		$termID = $this->input->post('termID');
		$feeID = $this->input->post('feeID');
		$students = [];

		$this->db->trans_start();
		$enrolled_students = $this->db->query("
			SELECT DISTINCT s.studID,s.controlNo,CONCAT(u.fn,' ',u.mn,' ',u.ln,' | ',s.controlNo) name,y.yearDesc,course.courseCode,y.yearID,course.courseID FROM studclass sc 
			INNER JOIN class c ON sc.classID = c.classID
			INNER JOIN student s ON sc.studID = s.studID 
			INNER JOIN users u ON s.uID = u.uID 
			INNER JOIN studprospectus sp ON s.studID = sp.studID
			INNER JOIN prospectus p ON sp.prosID = p.prosID  
			INNER JOIN course ON p.courseID = course.courseID  
			INNER JOIN year y ON s.yearID = y.yearID  
			WHERE c.termID = $termID"
		)->result();

		$involved_students = $this->db->query("SELECT studID FROM stud_fee WHERE feeID = $feeID")->result();
		$amount = $this->db->select('amount')->get_where('fees', "feeID = $feeID", 1)->row()->amount;

		foreach($enrolled_students as $es){
			$has_course = $has_year = false;

			if($courses){
				foreach($courses as $c){
					if($es->courseID == $c['courseID']){
						$has_course = true;
						break;
					}
				}
			}
			
			if($years){
				foreach($years as $y){
					if($es->yearID == $y['yearID']){
						$has_year = true;
						break;
					}
				}
			}

			if(!$courses && $years){
				if($has_year){
					$students[] = $es;
				}
			}else if($courses && !$years){
				if($has_course){
					$students[] = $es;
				}
			}else{
				if($has_year && $has_course){
					$students[] = $es;
				}
			}

		}

		foreach($students as $s){
			$exist = false;
			
			if($involved_students){
				//check if exist
				foreach($involved_students as $is){
					if($s->studID == $is->studID){
						$exist = true;
						break;
					}
				}
			}
			
			if(!$exist){
				$this->db->insert('stud_fee', ['studID'=>$s->studID,'feeID'=>$feeID,'payable'=>$amount]);
				++$total_added;
			}
		}	
		$this->db->trans_complete();
		echo json_encode(['involved_students'=>$this->get_involved_students($feeID), 'total_added'=>$total_added]);
	}

	function search_student($search_value = '', $termID){
		$search_value = strtr($search_value, '_', ' ');
		$query = $this->db->select("s.studID,s.controlNo,CONCAT(u.fn,' ',u.mn,' ',u.ln,' | ',s.controlNo) name,y.yearDesc,course.courseCode,y.yearID,course.courseID")
		->distinct('u.uID')
		->like("CONCAT(u.fn,' ',u.mn,' ',u.ln,' | ',s.controlNo)", "$search_value")
		->join('class c', "sc.classID = c.classID")
		->join('student s', "sc.studID = s.studID")
		->join('users u', "s.uID = u.uID")
		->join('studprospectus sp', "s.studID = sp.studID")
		->join('prospectus p', "sp.prosID = p.prosID")
		->join('course', "p.courseID = course.courseID")
		->join('year y', "s.yearID = y.yearID")
		->order_by('name','ASC')
		->get_where('studclass sc',"c.termID = $termID",10);

		echo json_encode($query->result());
	}

	function addStudents(){
		$total_added = 0;
		$feeID = $this->input->post('feeID');
		$tba_students = $this->input->post('tba_students');
		$involved_students = $this->db->query("SELECT studID FROM stud_fee WHERE feeID = $feeID")->result();
		$amount = $this->db->select('amount')->get_where('fees', "feeID = $feeID", 1)->row()->amount;
		$exist_studIDs = [];

		if($involved_students){
			$i = 0;
			foreach($tba_students as $s){
				foreach($involved_students as $is){
					if($s['studID'] == $is->studID){
						$exist_studIDs[] = $s['studID'];
					}
				}
				++$i;
			}
		}


		foreach($tba_students as $tba){
			if(!in_array($tba['studID'], $exist_studIDs)){
				$this->db->insert('stud_fee', ['studID'=>$tba['studID'], 'feeID'=>$feeID, 'payable'=>$amount]);
				++$total_added;
			}
		}
		echo json_encode(['involved_students'=>$this->get_involved_students($feeID), 'total_added'=>$total_added]);
	}

	function removeStud(){
		$feeID = $this->input->post('feeID');
		$studID = $this->input->post('studID');
		$this->db->delete('stud_fee',"feeID = $feeID AND studID = $studID");
	}

	function removeFilter(){
		$feeID = $this->input->post('feeID');
		$studIDs = $this->input->post('removed_studs');	

		foreach($studIDs as $studID){
			$this->db->delete('stud_fee', "feeID = $feeID AND studID = $studID");
		}

	}

	function cancelPayment($feeID){
		$this->db->trans_start();
		$amount = $this->db->select('amount')->get_where('fees', "feeID = $feeID", 1)->row()->amount;
		$payers = $this->db->select('sfID,payable,receivable')->get_where('stud_fee', "feeID = $feeID AND payable < '$amount'")->result();

		$this->db->update('fees', ['feeStatus'=>'cancelled'], "feeID = $feeID");
		foreach($payers as $p){
			if($p->receivable > 0){
				$this->db->update('stud_fee', ['receivable'=>$amount + $p->receivable], "sfID = ".$p->sfID);
			}else{
				$this->db->update('stud_fee', ['receivable'=>$amount - $p->payable], "sfID = ".$p->sfID);	
			}
		}
		$this->db->update('stud_fee', ['payable'=>0.00], "feeID = $feeID");
		
		$this->db->trans_complete();
	}

	function populate_transfer_fee($termID, $feeID){
		echo json_encode(
			$this->db->query("SELECT feeID, feeName FROM fees WHERE termID = $termID AND feeID <> $feeID AND feeStatus <> 'cancelled'")->result()
		);
	}

	function transferFee(){
		$affected_students = [];
		$current_fee = $this->input->post("current_fee");
		$transferred_feeID = $this->input->post("transferred_fee");
		$transferred_feeName = $this->db->select('feeName')->get_where('fees', "feeID = $transferred_feeID", 1)->row()->feeName;

		$this->db->trans_start();

		$feeAmount = $this->db->select('amount')->get_where('fees', "feeID = $current_fee", 1)->row()->amount;

		$students = $this->db->query("
			SELECT sf.studID,sf.payable,sf.receivable,s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name,c.courseCode,y.yearDesc
			FROM stud_fee sf 
			INNER JOIN student s ON sf.studID = s.studID 
			INNER JOIN studprospectus sp ON s.studID = sp.studID 
			INNER JOIN prospectus p ON sp.prosID = p.prosID  
			INNER JOIN course c ON p.courseID = c.courseID 
			INNER JOIN year y ON s.yearID = y.yearID 
			INNER JOIN users u ON s.uID = u.uID   
			WHERE sf.feeID = $current_fee AND sf.payable < $feeAmount
		")->result();
		
		foreach($students as $student){
			if($student->receivable > 0){
				$amount_refundable = $feeAmount + $student->receivable;
			}else{
				$amount_refundable = $feeAmount - $student->payable;
			}

			$transferred_fee = $this->db->query("SELECT payable,receivable FROM stud_fee WHERE feeID = $transferred_feeID AND studID = ".$student->studID." LIMIT 1")->row();

			if($transferred_fee){
				if($transferred_fee->payable > 0){
					$diff = $transferred_fee->payable - $amount_refundable; // if negative naay sukli. ma refundable na
					if($diff < 0){
						$refundable = abs($diff);
					}else{
						$payable = $diff;
					}
				}else if($transferred_fee->receivable >= 0){
					$refundable = $transferred_fee->receivable + $amount_refundable;
				}

				if($refundable){
					$this->db->update('stud_fee', ['payable'=>0.00, 'receivable'=>$refundable], "studID = ".$student->studID." AND feeID = $transferred_feeID");
				}else{
					$this->db->update('stud_fee', ['payable'=>$payable], "studID = ".$student->studID." AND feeID = $transferred_feeID");
				}
				$this->db->update('stud_fee', ['payable'=>0.00, 'receivable'=>0.00], "studID = ".$student->studID." AND feeID = $current_fee");

				$logs['studID'] = $student->studID;
				$logs['uID'] = $this->session->userdata('uID');
				$logs['feeID'] = $current_fee;
				if($refundable){
					$logs['amount'] = $refundable;
				}else{
					$logs['amount'] = $payable;
				}
				$logs['action'] = 'transfer debit to '.$transferred_feeName;

				$this->db->insert('payments', $logs);

				$affected_students[] = ['student' => $student, 'amount_transferred' => $amount_refundable];

			}else{
				if($student->receivable > 0){
					$this->db->update('stud_fee', ['receivable'=>$feeAmount + $student->receivable],  "studID = ".$student->studID." AND feeID = $current_fee");
				}else{
					$this->db->update('stud_fee', ['receivable'=>$feeAmount - $student->payable],  "studID = ".$student->studID." AND feeID = $current_fee");	
				}
			}

		}
		$this->db->update('fees', ['feeStatus'=>'cancelled'], "feeID = $current_fee");
		$this->db->update('stud_fee', ['payable'=>0.00], "feeID = $current_fee");
		//$this->cancelPayment($current_fee);

		$this->db->trans_complete();

		echo json_encode($affected_students);

	}

	function get_tshirt_size($id){
		$feeAmount = $this->db->select('amount')->get_where('fees', "feeID = $id", 1)->row()->amount;
		echo json_encode(
			$this->db->query("
				SELECT sf.sfID, CONCAT(u.ln,', ',u.fn) name, sf.tsize
				FROM stud_fee sf 
				INNER JOIN student s ON sf.studID = s.studID
				INNER JOIN users u ON s.uID = u.uID 
				WHERE sf.feeID = $id AND (sf.payable < $feeAmount OR sf.receivable > 0)
				ORDER BY name ASC
			")->result()
		);
	}

	function update_tsize(){
		//die(var_dump($_POST));
		$sfID = $this->input->post('sfID');
		$data['tsize'] = $this->input->post('tsize')['tsize'];
		$this->db->update('stud_fee', $data, "sfID = $sfID");
	}

}

?>