<?php
class Movie extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();


	}
	
	function index(){

	}
	
	function view($id){
		$this->load->model('User_model');
		$this->load->model('Movie_model');
		$data['id'] = $id;
		$data['title'] = 'View Movie';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'movie/view';
		$this->load->view('includes/template',$data);
	}

}

?>