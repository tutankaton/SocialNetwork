<?php
class Logout extends CI_Controller{
	
	function index(){
		delete_cookie('cinefilos', 'localhost');
		$this->session->sess_destroy();
		redirect('login');
	}	
}

?>