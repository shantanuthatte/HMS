<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends CI_Controller {
	
	
	
	public function Panel(){
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
	}
	public function login(){
		$this->load->model('user', '', TRUE);
		//echo $this->input->post('username');
		if($this->user->validUser($this->input->post('username'), $this->input->post('password')))
		{
			$this->session->set_userdata('loggedIn', TRUE);
			$this->session->set_userdata('username', $this->input->post('username'));
			$this->session->set_userdata('password', $this->input->post('password'));
			//$data['user'] = User::selectUser(FALSE,0,$this->input->post('username'), $this->input->post('password'));
			//$this->load->view('panel/home_view', $data);
			redirect('/panel');
		}
		else
		{
			echo"Error";
			$data['error']="Invalid username or password";
			$this->load->view('panel/login_view', $data);
		}
		//$this->load->view('panel/login_view');
	}
	
	public function logout(){
		if($this->input->post('username') == $this->session->userdata('username'))
			$this->session->sess_destroy();
		redirect('/panel');
	}
	
	public function index($data=NULL){
		if(!$this->session->userdata('loggedIn'))
		{
			echo "Not loged in";
			redirect('/panel/login');
		}
		else
			$this->load->view('panel/home_view');
			echo("Logged in");
	}
}

?>