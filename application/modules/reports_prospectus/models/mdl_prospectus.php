<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Prospectus extends CI_Model{

	function get_prospectuses(){
		echo json_encode(
			$this->db->query("SELECT prosID,prosCode FROM prospectus ORDER BY prosCode ASC")->result()
		);
	}

	function get_subjects($prosID){
		//echo $prosID; die();
		$query2 = $this->db->select('CONCAT(c.courseDesc," (",c.courseCode,")") AS description,p.effectivity')->get_where('course c,prospectus p', 'p.courseID = c.courseID AND p.prosID = '.$prosID, 1);
		$prospectus = $query2->row_array();

		$query3 = $this->db->select('y.yearID')->group_by('y.duration')->order_by('y.duration','ASC')->get_where('subject s, year y', 's.yearID=y.yearID AND s.prosID='.$prosID);

		foreach($query3->result_array() as $row3){
			$query4 = $this->db->select('sem.semID,sem.semDesc,y.yearDesc')->group_by('sem.semID')->order_by('sem.semOrder','ASC')->get_where('subject s, semester sem, year y','s.yearID=y.yearID AND s.semID=sem.semID AND s.prosID = '.$prosID.' AND s.yearID = '.$row3['yearID']);
			foreach($query4->result_array() as $row4){

				$term =  $row4['yearDesc'].' - '.$row4['semDesc'];

				$query5 = $this->db->select('s.subID, s.subCode,s.subDesc,(s.lec + s.lab) units,(SELECT y.yearDesc FROM year_req yr,year y,subject s2 WHERE yr.subID=s2.subID AND yr.yearID=y.yearID AND s2.subID=s.subID LIMIT 1) year_req')->get_where('subject s','s.prosID = '.$prosID.' AND s.yearID = '.$row3['yearID'].' AND s.semID = '.$row4['semID']);
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