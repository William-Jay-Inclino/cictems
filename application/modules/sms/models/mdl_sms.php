<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_Sms extends CI_Model{

	function sendSMS(){
		mail("09106024370@gmail.com", "", "Your packaged has arrived!", "From: David Walsh <david@davidwalsh.name>\r\n");
	}

}

?>