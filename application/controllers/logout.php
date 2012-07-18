<?php
class Logout extends CI_Controller{
	
	function index(){
		$coo = delete_cookie('cinefilos');

		
		$this->session->sess_destroy();
		redirect('login');
	}	
}

?>