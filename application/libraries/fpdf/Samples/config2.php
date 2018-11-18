<?php
trait DbConfig 
{	
	private $servername;
	private $username;
	private $password;
	private $dbname;
	
	public $con;

	function __construct(){
		$this->servername = "localhost";
		$this->username = "root";
		$this->password = "";
		$this->dbname = "inclino";
		$this->con = new mysqli($this->servername,$this->username,$this->password,$this->dbname);	
	}
}
?>
