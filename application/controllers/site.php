<?php
class Site extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Movie_model');
		if(get_cookie('cinefilos') && !$this->User_model->is_logged_in()){
			$this->User_model->get_sess_from_cookie();
		}elseif(!$this->User_model->is_logged_in() || $this->User_model->is_logged_in() != TRUE){
			redirect('login');
		}
		if($this->User_model->is_logged_in()){
			if(!$this->User_model->check_user_level()){
				redirect('verify');
			}else{
				$this->User_model->update_online_status();
			}
		}
	}
	
	function index($error = ''){
		$data['title'] = 'Home Page';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'user/index';
		$this->load->view('includes/site_temp',$data);
	}

}

?>
