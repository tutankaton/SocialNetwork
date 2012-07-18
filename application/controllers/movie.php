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
	
	function search_movies(){
		$this->load->model('User_model');
		$this->load->model('Movie_model');
		if($this->input->get('s')!=NULL){
			$data['query'] = $this->input->get('s');
			$this->session->set_userdata(array('last_query_movie' => $data['query']));
		}
		else
			$data['query'] = $this->session->userdata('last_query_movie');

		$data['title'] = 'Search movies';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'movie/search_movies';
		$this->load->view('includes/template',$data);
	}	

}

?>