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
		//print_r($_POST);
		$exist = false;
		$data = $this->input->post('data');
		$data['termID'] = $data['termID']['termID'];
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

	function read($option = 'feeName',$search_val = NULL, $page = '1', $per_page = '10',$termID = 24){
		$start = ($page - 1) * $per_page;
		$search_val = strtr($search_val, '_', ' ');
		if(trim($search_val) == ''){
			$query = $this->db->query("
				SELECT feeID,feeName,feeDesc,dueDate,feeStatus,amount FROM fees
				WHERE termID = $termID
				LIMIT $start, $per_page
			");
			$num_records = $this->count_all($termID);
		}else{
			$query = $this->db->query("
				SELECT feeID,feeName,feeDesc,dueDate,feeStatus,amount FROM fees
				WHERE $option LIKE '%".$search_val."%' AND termID = $termID
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
			SELECT CONCAT(t.schoolYear,' ',s.semDesc) term,t.termID,f.feeID,f.feeName,f.feeDesc,f.dueDate,f.feeStatus,f.amount 
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

		$this->check_exist($data,$exist,$id);

		if($exist){
			$output = ['status' => 0];
		}else{
			$this->db->update('fees', $data, "feeID = $id");
			$output = ['status' => 1];
		}

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
				SELECT s.studID,s.controlNo,CONCAT(u.ln,', ',u.fn,' ',u.mn) name,y.yearID,y.yearDesc,course.courseID,course.courseCode,y.yearID,course.courseID,sf.balance
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
		$courses = $this->input->post('courses');
		$years = $this->input->post('years');
		$termID = $this->input->post('termID');
		$feeID = $this->input->post('feeID');
		$students = [];

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

			if($has_year || $has_course){
				$students[] = $es;
			}

			// if(!$courses && $years){
			// 	if($has_year){
			// 		$students[] = $es;
			// 	}
			// }else if($courses && !$years){
			// 	if($has_course){
			// 		$students[] = $es;
			// 	}
			// }else{
			// 	if($has_year && $has_course){
			// 		$students[] = $es;
			// 	}
			// }

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
				$this->db->insert('stud_fee', ['studID'=>$s->studID,'feeID'=>$feeID,'balance'=>$amount]);
			}
		}	
		
		echo json_encode($this->get_involved_students($feeID));
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
		$feeID = $this->input->post('feeID');
		$tba_students = $this->input->post('tba_students');
		$involved_students = $this->db->query("SELECT studID FROM stud_fee WHERE feeID = $feeID")->result();
		$amount = $this->db->select('amount')->get_where('fees', "feeID = $feeID", 1)->row()->amount;

		if($involved_students){
			$i = 0;
			foreach($tba_students as $s){
				foreach($involved_students as $is){
					if($s['studID'] == $is->studID){
						array_splice($tba_students, $i, 1);
					}
				}
				++$i;
			}
		}


		foreach($tba_students as $tba){
			$this->db->insert('stud_fee', ['studID'=>$tba['studID'], 'feeID'=>$feeID, 'balance'=>$amount]);
		}
		echo json_encode($this->get_involved_students($feeID));
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

}

?>