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
        if ($method != 'index' && $method != 'login_validation' && $method != 'log_out'){
            $this->prevent_url_access();
        }
        $this->$method($params);
	}

	function index(){
		$this->my_loader('index');
	}

	// function register(){
	// 	$this->my_loader('register');
	// }

	// function first_time_login(){
	// 	$this->mdl_login->check_access();
	// 	$this->my_loader('first_time');
	// }

	// function change_pw_success(){
	// 	//$this->load->view('change_pw_success');
	// 	$this->my_loader('change_pw_success');
	// }

	// function get_students($search_val){
	// 	$this->mdl_login->get_students($search_val[0]);
	// }

	// function changePass(){
	// 	$this->mdl_login->check_access();
	// 	$this->mdl_login->changePass();	
	// }

	function login_validation(){
	    $this->form_validation->set_rules('un', 'Username', 'trim|required');
	    $this->form_validation->set_rules('pw', 'Password', 'trim|required');
        if($this->form_validation->run()){
            $this->mdl_login->login_validation();
        }else{
        	$this->form_validation->set_error_delimiters('<div class="has-text-danger help">', '</div>');
        	$this->index();
        } 
	}

	// function submit_registration(){
	// 	$this->mdl_login->submit_registration();
	// }

	function log_out(){
		$sess_array = array(
			'uID' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$this->session->sess_destroy();
		redirect(base_url() . 'login');
	}

	private function my_loader($view){
		$data['page'] = $view;
		$this->load->view('top', $data);
		$this->load->view($view);
		$this->load->view('bottom');
	}

	private function prevent_url_access(){
		if (!$this->input->is_ajax_request()) {
		  show_404();
		}
	}

}

?>