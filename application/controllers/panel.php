<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends CI_Controller {
	
	public function login(){
		$this->load->view('panel/login');
	}
	
	public function index(){
		echo "nothing";
		$this->login();
	}
}

?>