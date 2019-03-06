<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Deans_List extends CI_Model{

	function populate($termID){
		echo json_encode(
			$this->db->get_where('deanslist_reqs', "termID = $termID")->result()
		);
	}


}

?>