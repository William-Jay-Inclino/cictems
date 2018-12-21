<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Prospectus extends CI_Model{

	function updateReport(){
		$data = $this->input->post('data');
		$this->db->update('reports', $data, "module = 'reports_prospectus'");
	}

	function populate($prosID = NULL){
		$sql = $this->db->query("SELECT name, description FROM reports WHERE module = 'reports_prospectus'")->row();
		$specs = $this->db->get('specialization')->result();

		if($prosID){
			foreach($specs as $s){
				$total = $this->db->query("SELECT COUNT(1) total FROM subject WHERE prosID = $prosID AND specID = ".$s->specID)->row()->total;
				$holder[] = ['specID'=>$s->specID,'specDesc'=>$s->specDesc,'total'=>$total];
			}
			return ['populate'=>$sql, 'specializations'=>$holder];
		}else{
			return $sql;
		}
	}

	function get_prospectuses(){
		echo json_encode(
			$this->db->query("SELECT prosID,prosCode FROM prospectus ORDER BY prosID DESC, prosCode ASC")->result()
		);
	}

	function get_subjects($prosID, $val = NULL){
		$holder2 = [];
		$data['prospectus'] = $this->db->query("
			SELECT CONCAT(c.courseDesc,' (',c.courseCode,')') AS description,p.effectivity 
			FROM prospectus p  
			INNER JOIN course c ON p.courseID=c.courseID 
			WHERE p.prosID = $prosID LIMIT 1
		")->row();

		$data['specializations'] = $this->db->get('specialization')->result();

		$years = $this->db->query("SELECT y.yearID, y.yearDesc FROM subject s INNER JOIN year y ON s.yearID = y.yearID WHERE s.prosID = $prosID GROUP BY y.yearID ORDER BY y.duration ASC")->result();

		foreach($years as $y){
			$sems = $this->db->query("
				SELECT sem.semID, sem.semDesc FROM subject s 
				INNER JOIN semester sem ON s.semID=sem.semID 
				WHERE s.prosID = $prosID AND s.yearID = ".$y->yearID."
				GROUP BY sem.semID
				ORDER BY sem.semOrder ASC
			")->result();

			foreach($sems as $sem){
				$term = $y->yearDesc.' - '.$sem->semDesc;
				$holder = [];

				$subjects = $this->db->query("
					SELECT s.subID,s.id,sp.specID,s.subCode,s.subDesc,s.type,s.units,s.nonSub_pre,(SELECT yearDesc FROM year_req yr,year y,subject s2 WHERE yr.subID=s2.subID AND yr.yearID=y.yearID AND s2.subID=s.subID LIMIT 1) year_req
					FROM subject s
					INNER JOIN specialization sp ON s.specID = sp.specID
					WHERE s.prosID = $prosID AND s.yearID = ".$y->yearID." AND s.semID = ".$sem->semID."
				")->result();

				foreach($subjects as $subject){

					$sub_req = $this->db->query("
						SELECT sr.req_subID,req_type, (SELECT subCode FROM subject WHERE subID = sr.req_subID) req_code
						FROM subject s 
						INNER JOIN subject_req sr ON s.subID = sr.subID AND s.subID = ".$subject->subID."
					")->result();

					$holder[] = ['subject'=>$subject,'sub_req'=>$sub_req];

				}

				$holder2[] = ['term' => $term, 'subjects' => $holder];

			}

		}

		$data['subjects'] = $holder2;

		if($val == NULL){
			echo json_encode($data);	
		}else{
			return $data;
		}
		

	}

	function get_subjects2($prosID){
		//echo $prosID; die();
		$holder2 = [];
		$query2 = $this->db->select('CONCAT(c.courseDesc," (",c.courseCode,")") AS description,p.effectivity')->get_where('course c,prospectus p', 'p.courseID = c.courseID AND p.prosID = '.$prosID, 1);
		$prospectus = $query2->row_array();

		$query3 = $this->db->select('y.yearID')->group_by('y.duration')->order_by('y.duration','ASC')->get_where('subject s, year y', 's.yearID=y.yearID AND s.prosID='.$prosID);

		foreach($query3->result_array() as $row3){
			$query4 = $this->db->select('sem.semID,sem.semDesc,y.yearDesc')->group_by('sem.semID')->order_by('sem.semOrder','ASC')->get_where('subject s, semester sem, year y','s.yearID=y.yearID AND s.semID=sem.semID AND s.prosID = '.$prosID.' AND s.yearID = '.$row3['yearID']);
			foreach($query4->result_array() as $row4){

				$term =  $row4['yearDesc'].' - '.$row4['semDesc'];

				$query5 = $this->db->select('s.subID, s.subCode,s.subDesc,s.type,s.units,(SELECT y.yearDesc FROM year_req yr,year y,subject s2 WHERE yr.subID=s2.subID AND yr.yearID=y.yearID AND s2.subID=s.subID LIMIT 1) year_req')->get_where('subject s','s.prosID = '.$prosID.' AND s.yearID = '.$row3['yearID'].' AND s.semID = '.$row4['semID']);
				$row5 = $query5->result_array();

				foreach($row5 as $val){

					$query6 = $this->db->select('sr.req_subID,req_type, (SELECT subCode FROM subject WHERE subID = sr.req_subID) req_code')->get_where('subject s, subject_req sr','sr.subID=s.subID AND s.subID = '.$val['subID']);
					$row6 = $query6->result_array();

					$holder[] = ['subject'=>$val,'sub_req'=>$row6];
				}

				$holder2[] = array(
									'term' => $term,
									'subjects' => $holder
								);
				$holder = [];
			}
		}

		$output = ['prospectus'=>$prospectus, 'subjects'=>$holder2];
		echo json_encode($output);
	}

}

?>