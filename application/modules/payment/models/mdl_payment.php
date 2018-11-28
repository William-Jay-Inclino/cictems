<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Payment extends CI_Model{

	function populate($studID){
		$query = $this->db->select('c.courseCode,y.yearDesc')->join('year y','s.yearID=y.yearID')->join('studprospectus sp','s.studID=sp.studID')->join('prospectus p','sp.prosID=p.prosID')->join('course c','p.courseID=c.courseID')->get_where('student s', "s.studID = $studID", 1)->row();
		$data['course'] = $query->courseCode;
		$data['year'] = $query->yearDesc;

		$data['fees'] = $this->db->select('f.feeID,f.amount,f.feeName,sf.payable,sf.receivable')->join('fees f', 'sf.feeID = f.feeID')->get_where('stud_fee sf', "studID = $studID AND (sf.payable > 0 OR sf.receivable > 0)")->result();

		echo json_encode($data);
	}

	function increment_logs(){
		$query = $this->db->query("SELECT 1 FROM counter2 WHERE module = 'payment_logs' LIMIT 1");
		$row =  $query->row();
		if($row){
			$this->db->query("UPDATE counter2 SET total = total + 1 WHERE module = 'payment_logs'");
		}else{
			$this->db->query("INSERT INTO counter2(module,total) VALUES('payment_logs','1')");
		}
	}

	function collectPayment(){
		$response = [];
		$feeID = $this->input->post('feeID');
		$studID = $this->input->post('studID');
		$amount = $this->input->post('amount');
		$or_number = $this->input->post('or_number');

		$is_or_number_exist = $this->db->select('1')->get_where('payments', "or_number = '$or_number'", 1)->row();
		if($is_or_number_exist){
			die('_error0');
		}else{
			$logs['studID'] = $studID;
			$logs['uID'] = $this->session->userdata('uID');
			$logs['feeID'] = $feeID;
			$logs['amount'] = $amount;
			$logs['action'] = 'collect';
			$logs['or_number'] = $this->input->post('or_number');

			$this->db->trans_start();

			$fee = $this->db->get_where('stud_fee', "studID = $studID AND feeID = $feeID", 1)->row();

			if($fee->payable == $amount){
				$response['status'] = 'paid';
				$payable = 0.00;
			}else{
				$response['status'] = 'partial';
				$payable = $fee->payable - $amount;
			}
			$this->db->update('stud_fee',['payable'=>$payable], "sfID = ".$fee->sfID);
			$this->db->insert('payments', $logs);
			$this->increment_logs();

			$this->db->trans_complete();

			echo json_encode($response);
		}
		
		

	}

	function refundPayment(){
		$feeID = $this->input->post('feeID');
		$studID = $this->input->post('studID');

		$this->db->trans_start();

		$logs['studID'] = $studID;
		$logs['uID'] = $this->session->userdata('uID');
		$logs['feeID'] = $feeID;
		$logs['amount'] = $this->input->post('amount');
		$logs['action'] = 'refund';
		$logs['or_number'] = $this->input->post('or_number');

		$this->db->update('stud_fee',['receivable'=>0.00], "feeID = $feeID AND studID = $studID");
		$this->db->insert('payments', $logs);
		$this->increment_logs();
		$this->db->trans_complete();

	}

}

?>