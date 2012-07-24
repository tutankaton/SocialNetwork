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
	
	function delete_toview($id_movie){
		$this->load->model('User_model');
		$this->load->model('Movie_model');
		$this->Movie_model->delete_toview($id_movie);

		$data['title'] = 'Account';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'user/account';
		$this->load->view('includes/template',$data);
	}

	function search_recommend_movies(){
		$this->load->model('User_model');
		$this->load->model('Movie_model');
		$query = $this->input->get('s');
		$data['recommends'] = $this->Movie_model->search_recommend_movies($query);
		$data['title'] = 'Account';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'user/account';
		$this->load->view('includes/template',$data);
	}

}

?>