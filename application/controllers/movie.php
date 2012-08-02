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
			$query = $this->input->get('s');
			$this->session->set_userdata(array('last_query_movie' => $query));
		}
		else
			$query = $this->session->userdata('last_query_movie');
		$data["query"] = $query;
		
		//paginado
        $config = array();
        $config["base_url"] = base_url() . "/index.php/movie/search_movies";
        $config["total_rows"] = $this->Movie_model->search_movies_count($query);
		$config['use_page_numbers'] = FALSE;
        $config["per_page"] = 3;
        $config["uri_segment"] = 3;
		$config['full_tag_open'] = '<ul class="pager">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] = '<<';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '>>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '<a></li>';
        $this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
 		$data["results"] = $this->Movie_model->search_movies($query, $config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

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
		$data['recommends_searchs'] = $this->Movie_model->search_recommend_movies($query);
		$data['title'] = 'Account';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'user/account';
		$this->load->view('includes/template',$data);
	}
	
	function search_recommend_movies_to_top(){
		$this->load->model('User_model');
		$this->load->model('Movie_model');
		$query = $this->input->get('s');
		$data['top_searchs'] = $this->Movie_model->search_recommend_movies($query);
		$data['title'] = 'Account';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'user/account';
		$this->load->view('includes/template',$data);
	}

	function search_actor($id_actor){
		$this->load->model('User_model');
		$this->load->model('Movie_model');
		$query = $id_actor;
		$data["query"] = $query;
		
		//paginado
        $config = array();
        $config["base_url"] = base_url() . "/index.php/movie/search_actor";
        $config["total_rows"] = $this->Movie_model->search_actor_count($query);
		$config['use_page_numbers'] = FALSE;
        $config["per_page"] = 3;
        $config["uri_segment"] = 3;
		$config['full_tag_open'] = '<ul class="pager">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] = '<<';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '>>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '<a></li>';
        $this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
 		$data["results"] = $this->Movie_model->search_actor($query, $config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		
		$this->db->where('id',$query);
		$q = $this->db->get('actor');
		foreach($q->result() as $r){					
			$data["query"] = 'Actor = '.$r->name;								
		}

		$data['title'] = 'Search movies';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'movie/search_movies';
		$this->load->view('includes/template',$data);
	}	

	function search_director($id_director){
		$this->load->model('User_model');
		$this->load->model('Movie_model');
		$query = $id_director;
		$data["query"] = $query;
		
		//paginado
        $config = array();
        $config["base_url"] = base_url() . "/index.php/movie/search_director";
        $config["total_rows"] = $this->Movie_model->search_director_count($query);
		$config['use_page_numbers'] = FALSE;
        $config["per_page"] = 3;
        $config["uri_segment"] = 3;
		$config['full_tag_open'] = '<ul class="pager">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] = '<<';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '>>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '<a></li>';
        $this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
 		$data["results"] = $this->Movie_model->search_director($query, $config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		
		$this->db->where('id',$query);
		$q = $this->db->get('director');
		foreach($q->result() as $r){					
			$data["query"] = 'Director = '.$r->name;								
		}

		$data['title'] = 'Search movies';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'movie/search_movies';
		$this->load->view('includes/template',$data);
	}	

}

?>