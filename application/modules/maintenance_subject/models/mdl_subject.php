<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Subject extends CI_Model{

	private function count_all(){
		$query = $this->db->query("SELECT total FROM counter2 WHERE module = 'subject' LIMIT 1");
		$rs = $query->row();
		if($rs){
			return $rs->total;
		}else{
			return 0;
		}
	}

	private function get_form_data(&$data){
		$data['specID'] = $this->input->post('spec')['specID'];
		$data['yearID'] = $this->input->post('year')['yearID'];
		$data['total_units'] = $this->input->post('totUnits')['unit'];
		$data['semID'] = $this->input->post('sem')['semID'];
		$data['subDesc'] = $this->input->post('subDesc');
		$data['nonSub_pre'] = $this->input->post('nonSub_pre');
	}

	private function insert_reqs($subID, $req, $req_type){
		foreach($req as $r){
			$this->db->insert('subject_req', ['subID'=>$subID,'req_type'=>$req_type,'req_subID'=>$r['subID']]);
		}
	}

	private function get_random_id($prosID){
		while(true){
			$id = substr(str_shuffle("123456789"), 0, 3);
			$sql = $this->db->query("SELECT 1 FROM subject WHERE id = $id AND prosID = $prosID LIMIT 1")->row();
			if(!$sql){
				break;
			}
		}
		return $id;
	}

	function create(){
		 // die(print_r($_POST));
		$prosID = $this->input->post('prospectus')['prosID'];
		$subCode = $this->input->post('subCode');
		$lec = $this->input->post('lec');
		$lab = $this->input->post('lab');
		$id = $id2 = 0;

		if($this->check_exist($prosID, $subCode)){
			echo 'exist';
		}else{
			$data['prosID'] = $prosID;
			$data['subCode'] = $subCode;

			$this->get_form_data($data);
			$pre = $this->input->post('pre');
			$pre2 = $this->input->post('pre2');
			$coreq = $this->input->post('coreq');

			$this->db->trans_start();

			$data['id'] = $this->get_random_id($prosID);

			if($lec){
				$data['units'] = $lec['unit'];
				$data['type'] = 'lec';
				$this->db->insert('subject', $data);
				$id = $this->db->insert_id();	

				if($pre){
					$this->insert_reqs($id,$pre,1);
				}
				if($pre2){
					$this->db->insert('year_req', ['subID' => $id, 'yearID' => $pre2['yearID']]);
				}
				if($coreq){
					$this->insert_reqs($id,$coreq,2);
				}

			}

			if($lab){
				$data['units'] = $lab['unit'];
				$data['type'] = 'lab';
				$this->db->insert('subject', $data);
				$id2 = $this->db->insert_id();	

				if($pre){
					$this->insert_reqs($id2,$pre,1);
				}
				if($pre2){
					$this->db->insert('year_req', ['subID' => $id2, 'yearID' => $pre2['yearID']]);
				}
				if($coreq){
					$this->insert_reqs($id2,$coreq,2);
				}

			}

			$query = $this->db->query("SELECT 1 FROM counter2 WHERE module = 'subject' LIMIT 1");
			$row =  $query->row();
			if($row){
				$this->db->query("UPDATE counter2 SET total = total + 1 WHERE module = 'subject'");
			}else{
				$this->db->query("INSERT INTO counter2(module,total) VALUES('subject',1)");
			}

			$this->db->trans_complete();

			echo json_encode(['id'=>$data['id'], 'prosID' => $prosID]);

		}
	}

	function read($option = 's.subCode',$search_val = NULL, $page = '1', $per_page = '10'){
		$start = ($page - 1) * $per_page;
		$search_val = strtr($search_val, '_', ' ');
		if(trim($search_val) == ''){
			$query = $this->db->query("
				SELECT DISTINCT s.id,s.prosID,s.subCode,s.subDesc,p.prosCode
				FROM subject s
				INNER JOIN prospectus p ON s.prosID=p.prosID 
				LIMIT $start, $per_page
			");
			$num_records = $this->count_all();
		}else{
			$query = $this->db->query("
				SELECT DISTINCT s.id,s.prosID,s.subCode,s.subDesc,p.prosCode
				FROM subject s
				INNER JOIN prospectus p ON s.prosID=p.prosID 
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

	function read_one($id, $prosID){
		$this->check_form_id($id, $prosID);

		$query = $this->db->query("
			SELECT s.subID,s.subCode,s.subDesc,s.total_units,s.nonSub_pre,p.prosID,p.prosCode,spec.specID,spec.specDesc,s.units,s.type,s.id,yy.yearID,yy.yearDesc,sem.semID,sem.semDesc,
			(SELECT CONCAT(y.yearDesc,' Standing') FROM year_req yr,year y,subject s2 WHERE yr.subID=s2.subID AND yr.yearID=y.yearID AND s2.subID=s.subID LIMIT 1) year_req
			FROM subject s 
			INNER JOIN prospectus p ON s.prosID = p.prosID
			INNER JOIN specialization spec ON s.specID = spec.specID 
			INNER JOIN year yy ON s.yearID = yy.yearID  
			INNER JOIN semester sem ON s.semID = sem.semID  
			WHERE s.id = $id AND s.prosID = $prosID
		")->result();
		
		return $query;
	}

	function update(){
		//die(print_r($_POST));
		$id = $this->input->post('id');
		$prosID = $this->input->post('prospectus')['prosID'];
		$subCode = $this->input->post('subCode');

		if($this->check_exist($prosID, $subCode, $id)){
			echo 'exist';
			die();
		}else{

			$subIDs = $this->db->select('subID')->get_where('subject', "id = $id AND prosID = $prosID")->result();

			$data['prosID'] = $prosID;
			$data['subCode'] = $subCode;

			$this->get_form_data($data);
			$this->db->trans_start();

			$this->db->update('subject', $data, "id = $id");

			$pre = $this->input->post('pre');
			$pre2 = $this->input->post('pre2');
			$coreq = $this->input->post('coreq');
			foreach($subIDs as $sids){

				$this->db->delete('subject_req', "subID = ".$sids->subID);
				$this->db->delete('year_req', "subID = ".$sids->subID);

				if($pre){
					$this->insert_reqs($sids->subID,$pre,1);
				}
				if($pre2){
					$this->db->insert('year_req', ['subID' => $sids->subID, 'yearID' => $pre2['yearID']]);
				}
				if($coreq){
					$this->insert_reqs($sids->subID,$coreq,2);
				}
			}

			

			$this->db->trans_complete();

		}
	}

	function delete($subID){
		$this->db->trans_start();

		$id = $this->db->select('id')->get_where('subject', "subID = $subID", 1)->row()->id;

		$query = $this->db->query("
			SELECT (SELECT 1 FROM year_req WHERE subID = $subID LIMIT 1) yr, (SELECT 1 FROM subject_req WHERE subID =$subID LIMIT 1) sr
		")->row();
		if($query->yr){
			$this->db->delete('year_req', 'subID = '.$subID);
		}
		if($query->sr){
			$this->db->delete('subject_req', 'subID = '.$subID);
		}
		$this->db->delete('subject', 'subID = '.$subID);

		$sql = $this->db->select('1')->get_where('subject', "id = $id", 1)->row();

		if(!$sql){
			$this->db->query("UPDATE counter2 SET total = total - 1 WHERE module = 'subject'");
		}

		$this->db->trans_complete();
	}

	function check_exist($prosID, $subCode, $id = NULL){
		$exist = false;
		if($id == NULL){
			$query = $this->db->query("
				SELECT 1 FROM subject WHERE prosID = $prosID AND subCode = '$subCode'  LIMIT 1
			");
		}else{
			$query = $this->db->query("
				SELECT 1 FROM subject WHERE id <> $id AND prosID = $prosID AND subCode = '$subCode'  LIMIT 1
			");
		}
		
		if($query->row()){
			$exist = true;
		}
		return $exist;
	}

	function check_form_id($id, $prosID){
		$query = $this->db->select('1')->get_where('subject', 'id='.$id.' AND prosID = '.$prosID,1);
		if(!$query->row()){
			show_404();
		}
	}

	function is_safe_delete($id, $prosID){
		$output = 1;
		$this->db->trans_start();

		$subIDs = $this->db->select('subID')->get_where('subject', "id = $id AND prosID = $prosID")->result();

		foreach($subIDs as $sids){
			$query = $this->db->select('1')->get_where('class', "subID = ".$sids->subID, 1)->row();
			$query2 = $this->db->select('1')->get_where('studgrade', "subID = ".$sids->subID, 1)->row();
			// $query3 = $this->db->select('1')->get_where('subject_req', "subID = ".$sids->subID, 1)->row();
			$query4 = $this->db->select('1')->get_where('year_req', "subID = ".$sids->subID, 1)->row();
			$query5 = $this->db->select('1')->get_where('subject_req', "req_subID = ".$sids->subID, 1)->row();

			if($query || $query2 || $query4 || $query5){
				$output = 0;
				break;
			}
		}

		$this->db->trans_complete();

		echo $output;

	}

	function get_prospectuses(){
		echo json_encode(
			$this->db->query("
			SELECT prosID,prosCode FROM prospectus ORDER BY prosID DESC, prosCode ASC
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

	function get_semesters(){
		echo json_encode(
			$this->db->query("
				SELECT semID,semDesc FROM semester ORDER BY semOrder ASC
			")->result()
		);
	}

	function get_reqs($prosID, $yearID, $semID, $id){
		$data = [];
		if($id == 0){
			$query = $this->db->query("
				SELECT DISTINCT id,prosID,subCode FROM subject WHERE prosID=$prosID and yearID <= $yearID
			")->result();
		}else{
			$query = $this->db->query("
				SELECT DISTINCT id,prosID,subCode FROM subject WHERE prosID=$prosID and yearID <= $yearID AND id <> $id
			")->result();
		}
		foreach($query as $q){
			$subID = $this->db->select('subID')->get_where('subject', "id = ".$q->id." AND prosID = ".$q->prosID, 1)->row()->subID;
			$data[] = ['id'=>$q->id,'subID'=>$subID,'subCode'=>$q->subCode];
		}
		echo json_encode($data);
	}

	function get_requisites($id){
		$query = $this->db->query("
			SELECT sr.req_subID,req_type,(SELECT subCode FROM subject WHERE subID = sr.req_subID) req_code 
			FROM subject s 
			INNER JOIN subject_req sr ON sr.subID = s.subID 
			WHERE s.subID = $id
		")->result();

		echo json_encode($query);
	}

	function fetchYearReq($id){
		$query = $this->db->query("
				SELECT y.yearID, y.yearDesc FROM year_req yr,year y,subject s2 WHERE yr.subID=s2.subID AND yr.yearID=y.yearID AND s2.subID=$id LIMIT 1
			")->row();
		if($query){
			echo json_encode($query);
		}
		
	}

	function populate($id){
		$data['yearReq'] =$this->db->query("
			SELECT y.yearID, y.yearDesc FROM year_req yr,year y,subject s2 WHERE yr.subID=s2.subID AND yr.yearID=y.yearID AND s2.subID=$id LIMIT 1
		")->row();
		$data['prospectus'] = $this->db->query("
			SELECT prosID,prosCode FROM prospectus ORDER BY prosID DESC, prosCode ASC
		")->result();
		$data['reqs'] = $this->db->query("
			SELECT sr.req_subID,req_type,(SELECT subCode FROM subject WHERE subID = sr.req_subID) req_code 
			FROM subject s 
			INNER JOIN subject_req sr ON sr.subID = s.subID 
			WHERE s.subID = $id
		")->result();
		$data['specs'] = $this->db->order_by('specDesc ASC')->get('specialization')->result();
		echo json_encode($data);
	}

	function populate2(){
		$data['prospectus'] = $this->db->query("
			SELECT prosID,prosCode FROM prospectus ORDER BY prosID DESC, prosCode ASC
		")->result();
		$data['specs'] = $this->db->order_by('specDesc ASC')->get('specialization')->result();
		echo json_encode($data);
	}

	function save_unit($unit, $subID){
		//$this->db->trans_start();
		//$subID = $this->db->select('subID')->get_where('subject', "id = $id AND type = '$val'", 1)->row()->subID;
		$this->db->update('subject',['units'=>$unit], "subID = $subID");
		//$this->db->trans_complete();
	}

	function populateShow($id, $prosID){
		$data['sub'] = $this->db->query("
			SELECT s.subID,s.subCode,s.subDesc,s.nonSub_pre,p.prosID,p.prosCode,spec.specID,spec.specDesc,s.units,s.type,s.id,yy.yearID,yy.yearDesc,sem.semID,sem.semDesc,
			(SELECT CONCAT(y.yearDesc,' Standing') FROM year_req yr,year y,subject s2 WHERE yr.subID=s2.subID AND yr.yearID=y.yearID AND s2.subID=s.subID LIMIT 1) year_req
			FROM subject s 
			INNER JOIN prospectus p ON s.prosID = p.prosID
			INNER JOIN specialization spec ON s.specID = spec.specID 
			INNER JOIN year yy ON s.yearID = yy.yearID  
			INNER JOIN semester sem ON s.semID = sem.semID  
			WHERE s.id = $id AND s.prosID = $prosID
		")->result();

		$data['reqs'] = $this->db->query("
			SELECT sr.req_subID,req_type,(SELECT subCode FROM subject WHERE subID = sr.req_subID) req_code 
			FROM subject s 
			INNER JOIN subject_req sr ON sr.subID = s.subID 
			WHERE s.subID = ".$data['sub'][0]->subID."
		")->result();

		echo json_encode($data);

	}

	function saveAddUnit(){
		
		$id = $this->input->post('id');
		$prosID = $this->input->post('prosID');
		
		$this->db->trans_start();
		$sql = $this->db->get_where('subject', "prosID = $prosID AND id = $id", 1)->row();
		$data['prosID'] = $prosID;
		$data['yearID'] = $sql->yearID;
		$data['semID'] = $sql->semID;
		$data['specID'] = $sql->specID;
		$data['subCode'] = $sql->subCode;
		$data['subDesc'] = $sql->subDesc;
		$data['total_units'] = $sql->total_units;
		$data['units'] = $this->input->post('units');
		$data['type'] = $this->input->post('type');
		$data['id'] = $id;
		$this->db->insert('subject', $data);
		$this->db->trans_complete();
	}

}

?>