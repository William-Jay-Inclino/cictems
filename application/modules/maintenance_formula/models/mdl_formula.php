<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Formula extends CI_Model{

	function get_percentage(){
		return $this->db->query("SELECT prelim*100 prelim,midterm*100 midterm,prefi*100 prefi,final*100 final FROM grade_formula")->row();
	}

	function update(){
		$data['prelim'] = $this->input->post('prelim') / 100;
		$data['midterm'] = $this->input->post('midterm') / 100;
		$data['prefi'] = $this->input->post('prefi') / 100;
		$data['final'] = $this->input->post('final') / 100;

		$this->db->update('grade_formula', $data);
		echo json_encode(
			$this->get_percentage()
		);

	}


}

?>