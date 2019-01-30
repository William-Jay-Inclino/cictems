<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class MY_Controller extends MX_Controller{

	protected $_data = [];
	protected $_template;

	function __construct($current_module){
		parent::__construct();
		$this->check_login();
		$this->authenticate($current_module);
		$this->get_current_term();
	}

	private function check_login(){
		if(!$this->session->userdata('uID')){
			redirect('login');
		}
	}

	private function authenticate($current_module){
		//query for getting the role_id of user goes here!
		$this->_data['user_access'] = [];
		$user = $this->db->select('roleID,fn')->get_where('users', 'uID = '.$this->session->userdata('uID'), 1)->row();
		$roleID = $user->roleID;
		$this->_data['displayedName'] = $user->fn;
		$this->_data['roleID'] = $roleID;
		$this->_data['current_module'] = $current_module;
		if($roleID == 1){
			$this->_template = 'templates/admin';
		}else{
			// query for getting the user access goes here!
			$arr = [];
			$arr2 = ['trans' => false, 'main' => false, 'users' => false, 'reports' => false];
			$modules = $this->db->query("
				SELECT modID FROM access_rights WHERE uID = ". $this->session->userdata('uID')
			)->result();
			foreach($modules as $m){
				$arr[] = $m->modID;
				if($m->modID >= 2 && $m->modID <= 4){
					$arr2['trans'] = true;
				}else if($m->modID >= 5 && $m->modID <= 13){
					$arr2['main'] = true;
				}else if($m->modID >= 14 && $m->modID <= 17){
					$arr2['users'] = true;
				}else if($m->modID >= 18 && $m->modID <= 22){
					$arr2['reports'] = true;
				}
			}
			//die($this->_current_module);
			// go to modules table in db for identification of modules
			if(!in_array($current_module, $arr) && ($current_module != 0 && $current_module != 100 && $current_module != 101)){
				if($roleID != 2){
					show_404();
				}
				if($roleID == 2 && ($current_module != 24 && $current_module != 24.1)){
					show_404();
				}
			}
			$this->_data['user_access'] = $arr;
			$this->_data['module_category'] = $arr2;
			if($roleID == 2){
				$this->_template = 'templates/faculty';
			}else if($roleID == 3){
				$this->_template = 'templates/staff';
			}else if($roleID == 4){
				$this->_template = 'templates/student';
			}else if($roleID == 5){
				$this->_template = 'templates/guardian';
			}
		}
	} 

	private function get_current_term(){
		$query = $this->db->query("SELECT t.termID,s.semID,CONCAT(t.schoolYear,' ',s.semDesc) AS term FROM term t INNER JOIN semester s ON t.semID = s.semID WHERE t.termStat = 'active'");
		$this->_data['current_term'] = $query->row();
	}

}

?>