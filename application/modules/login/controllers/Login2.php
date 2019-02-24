<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Login extends MX_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_login');
		$this->load->library('form_validation'); 
		$this->load->helper('form');
	}

	function _remap($method, $params = []){
        if ($method != 'index' && $method != 'register' && $method != 'login_validation' && $method != 'changePass' && $method != 'log_out' && $method != 'first_time_login' && $method != 'change_pw_success'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function index(){
		$this->load->view('index');
	}

	function register(){
		$this->load->view('register');
	}

	function first_time_login(){
		$this->mdl_login->check_access();
		$this->load->view('first_time');
	}

	function change_pw_success(){
		$this->load->view('change_pw_success');
	}

	function get_students($search_val){
		$this->mdl_login->get_students($search_val[0]);
	}

	function changePass(){
		$this->mdl_login->check_access();
		$this->mdl_login->changePass();	
	}

	function login_validation(){
	    $this->form_validation->set_rules('un', 'Username', 'trim|required');
        if($this->form_validation->run()){
            $this->mdl_login->login_validation();
        }else{
        	$this->form_validation->set_error_delimiters('<div class="has-text-danger help">', '</div>');
        	$this->index();
        } 
	}

	function submit_registration(){
		$this->mdl_login->submit_registration();
	}

	function log_out(){
		$sess_array = array(
			'uID' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$this->session->sess_destroy();
		redirect(base_url() . 'login');
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>