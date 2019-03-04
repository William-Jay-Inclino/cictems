<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Prospectus extends CI_Model{

	function updateReport(){
		$data = $this->input->post('data');
		$this->db->update('reports', $data, "module = 'reports_prospectus'");
	}

	function populate($prosID = NULL){
		$sql = $this->db->query("SELECT name, description FROM reports WHERE module = 'reports_prospectus'")->row();
		$specs = $this->db->get_where('specialization', "prosID = $prosID")->result();
		$holder = [];
		if($prosID){
			foreach($specs as $s){
				$total = $this->db->query("SELECT SUM(units) total FROM subject WHERE prosID = $prosID AND specID = ".$s->specID)->row()->total;
				$holder[] = ['specID'=>$s->specID,'specDesc'=>$s->specDesc,'specColor'=>$s->specColor,'total'=>$total];
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
			SELECT CONCAT(c.courseDesc,' (',c.courseCode,')') AS description,p.prosDesc,p.effectivity,p.prosDesc2,DATE_FORMAT(p.updated_at, '%M %d %Y') updated_at
			FROM prospectus p  
			INNER JOIN course c ON p.courseID=c.courseID 
			WHERE p.prosID = $prosID LIMIT 1
		")->row();

		$data['specializations'] = $this->db->get_where('specialization', "prosID = $prosID")->result();

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
				$holder = $last_added = [];
				$tot_units = 0;

				$subjects = $this->db->query("
					SELECT s.subID,s.id,sp.specID,sp.specColor,s.is_counted,s.subCode,s.subDesc,s.type,s.units,s.total_units,s.total_units,s.nonSub_pre,(SELECT yearDesc FROM year_req yr,year y,subject s2 WHERE yr.subID=s2.subID AND yr.yearID=y.yearID AND s2.subID=s.subID LIMIT 1) year_req
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

					if($subject->is_counted == 'no'){
						$subject->specColor = 'red';
					}

					if($last_added){
						if($last_added->id != $subject->id && $subject->is_counted == 'yes'){
							$tot_units += $subject->total_units;
						}
					}else{
						if($subject->is_counted == 'yes'){
							$tot_units = $subject->total_units;	
						}
					}

					$lec = $lab = 0;

					if($subject->type == 'lec'){
						$lec = $subject->units;
					}else if($subject->type == 'lab'){
						$lab = $subject->units;
					}

					$holder[] = ['subject'=>$subject,'sub_req'=>$sub_req, 'lec'=>$lec,'lab'=>$lab];	
					$last_added = $subject;
				}
				$this->prepare_subject($holder);
				$holder2[] = ['term' => $term, 'subjects' => $holder, 'tot_units'=>$tot_units];

			}

		}

		$data['subjects'] = $holder2;

		if($val == NULL){
			echo json_encode($data);	
		}else{
			return $data;
		}
		

	}

	private function prepare_subject(&$subjects){
		$container = [];
		foreach($subjects as $s){
			$insert = true;
			$i = 0;
			foreach($container as $c){
				//die(var_dump($s));
				if($c['subject']->id == $s['subject']->id){
					if($s['subject']->type == 'lec'){
						$container[$i]['lec'] = $s['subject']->units;	
					}else{
						$container[$i]['lab'] = $s['subject']->units;	
					}
					$insert = false;
					break;
				}
				++$i;
			}
			if($insert){
				$container[] = $s;
			}
		}

		$subjects = $container;
	}

	// function get_subjects2($prosID, $val = NULL){
	// 	$holder2 = [];
	// 	$data['prospectus'] = $this->db->query("
	// 		SELECT CONCAT(c.courseDesc,' (',c.courseCode,')') AS description,p.effectivity 
	// 		FROM prospectus p  
	// 		INNER JOIN course c ON p.courseID=c.courseID 
	// 		WHERE p.prosID = $prosID LIMIT 1
	// 	")->row();

	// 	$data['specializations'] = $this->db->get_where('specialization', "prosID = $prosID")->result();

	// 	$years = $this->db->query("SELECT y.yearID, y.yearDesc FROM subject s INNER JOIN year y ON s.yearID = y.yearID WHERE s.prosID = $prosID GROUP BY y.yearID ORDER BY y.duration ASC")->result();

	// 	foreach($years as $y){
	// 		$sems = $this->db->query("
	// 			SELECT sem.semID, sem.semDesc FROM subject s 
	// 			INNER JOIN semester sem ON s.semID=sem.semID 
	// 			WHERE s.prosID = $prosID AND s.yearID = ".$y->yearID."
	// 			GROUP BY sem.semID
	// 			ORDER BY sem.semOrder ASC
	// 		")->result();

	// 		foreach($sems as $sem){
	// 			$term = $y->yearDesc.' - '.$sem->semDesc;
	// 			$holder = $last_added = [];
	// 			$tot_units = 0;

	// 			$subjects = $this->db->query("
	// 				SELECT s.subID,s.id,sp.specID,s.subCode,s.subDesc,s.type,s.units,s.total_units,s.nonSub_pre,(SELECT yearDesc FROM year_req yr,year y,subject s2 WHERE yr.subID=s2.subID AND yr.yearID=y.yearID AND s2.subID=s.subID LIMIT 1) year_req
	// 				FROM subject s
	// 				INNER JOIN specialization sp ON s.specID = sp.specID
	// 				WHERE s.prosID = $prosID AND s.yearID = ".$y->yearID." AND s.semID = ".$sem->semID."
	// 			")->result();
	// 			//die($this->db->last_query());
	// 			foreach($subjects as $subject){
					
	// 				$sub_req = $this->db->query("
	// 					SELECT sr.req_subID,req_type, (SELECT subCode FROM subject WHERE subID = sr.req_subID) req_code
	// 					FROM subject s 
	// 					INNER JOIN subject_req sr ON s.subID = sr.subID AND s.subID = ".$subject->subID."
	// 				")->result();

	// 				if($last_added){
	// 					if($last_added->id != $subject->id){
	// 						$tot_units += $subject->total_units;
	// 					}	
	// 				}else{
	// 					$tot_units = $subject->total_units;
	// 				}
					

	// 				$holder[] = ['subject'=>$subject,'sub_req'=>$sub_req];
	// 				$last_added = $subject;
	// 			}

	// 			$holder2[] = ['term' => $term, 'subjects' => $holder, 'tot_units'=>$tot_units];

	// 		}

	// 	}

	// 	$data['subjects'] = $holder2;

	// 	if($val == NULL){
	// 		echo json_encode($data);	
	// 	}else{
	// 		return $data;
	// 	}
		

	// }

}

?>