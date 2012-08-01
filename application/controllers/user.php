<?php
class User extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();
		$this->load->library('session'); 
		$this->load->model('User_model');
		if(($this->User_model->is_logged_in() == TRUE) && ($this->User_model->check_user_level() == TRUE)){
			
		}
		if(get_cookie('cinefilos')){
			$this->User_model->get_sess_from_cookie();
			redirect('home');
		}
	}
	
	function index($error = ''){
		$this->load->model('Movie_model');
		if($error){$data['login_error']=$error;}else{$data['login_error']='';}
		$data['title'] = 'Comunidad cinéfila';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'site/index';
		$this->load->view('includes/site_temp',$data);
	}

	function profile($id){
		$data['id_profile'] = $id;
		$data['title'] = 'View Profile';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'user/profile';
		$this->load->view('includes/template',$data);
	}
	
	function edit_profile(){
		$data['title'] = 'Edit Profile';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'user/edit_profile';
		$this->load->view('includes/template',$data);
	}

	function review($id_movie){
		$this->User_model->review($id_movie);		
		$this->already_saw($id_movie);
	}
	
	function delete_friendship($id){
		$this->User_model->delete_friendship($id);
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	function edit_account(){
		$this->User_model->edit_profile();
		$this->account();
	}
	
	function add_friendship($id){
		$this->User_model->add_friendship($id);
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	function activation($error = ''){
		if($error){$data['activation_error']=$error;}else{$data['activation_error']='';}
		$data['title'] = 'Activation';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'user/activation';
		$this->load->view('includes/template',$data);
	}
	
	function account(){
		$data['title'] = 'Account';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'user/account';
		$this->load->view('includes/template',$data);
	}

	function set_top($top, $id){
		$this->User_model->set_top($top,$id);
	}
	
	function change_order_top($type){
		$this->User_model->change_order_top($type);
	}
	
	function del_top($top){
		$this->User_model->del_top($top);
	}

	function already_saw($id_movie){
		$this->load->model('Movie_model');
		$this->Movie_model->already_saw($id_movie);
		$data['id_movie_saw'] = $id_movie;
		$data['title'] = 'Already saw';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'user/already_saw';
		$this->load->view('includes/template',$data);
	}
	
	function registration(){
		$vals = array(
			'img_path' => './captcha/', 
			'img_url' => base_url().'captcha/',
			'img_width' => '275',  
			'img_height' => '50', 
			'expiration' => '7200',  
		);
		$data['month'] = array(
				'1' => 'January',
				'2' => 'February',
				'3' => 'March',
				'4' => 'April',
				'5' => 'May',
				'6' => 'June',
				'7' => 'July',
				'8' => 'August',
				'9' => 'September',
				'10' => 'October',
				'11' => 'November',
				'12' => 'December',				
		);
		$excluded_days = array();
		for($x = 1; $x <=31; ++$x){
			if(!in_array($x, $excluded_days)){
				$days[$x] = $x;
			}
		}
		$excluded_years = array();
		for($x = date('Y')-18; $x >= date('Y')-100; --$x){
			if(!in_array($x, $excluded_years)){
				$years[$x] = $x;
			}
		}
		$data['year'] = $years;
		$data['day'] = $days;
		$data['cap'] = create_captcha($vals);
		$data['title'] = 'Registration Page';
		$data['discription'] = 'Cinéfilos registration page';
		$data['keyword'] = 'Cinéfilos, registration';
		$data['main_content'] = 'user/registration';
		$this->load->view('includes/template',$data);
	}
	
	function validate_login(){
		$this->form_validation->set_rules('username', 'Username','trim|required');
		$this->form_validation->set_rules('password', 'Password','trim|required');
		if($this->form_validation->run() == FALSE){
			$this->index();
		}else{
			$query = $this->User_model->validate();
			if($query){
				redirect('site');	
			}else{
				$error = 'Username & Password do not match';
				$this->index($error);
			}			
		}
	}
	
	function signup_success($to){
		$data['email'] = $to;
		$data['title'] = 'Signup Successful';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'user/signup_success';
		$data['robot'] = 'NOINDEX, NOFOLLOW';
		$this->load->view('includes/template', $data);
	}
	
	function change_photo(){
		$data['error'] = ' ';
		$data['title'] = 'Chage profile image';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'upload_form';
		$data['robot'] = 'NOINDEX, NOFOLLOW';
		$this->load->view('includes/template', $data);
	}
	
	function change_order($id1, $id2){
		$this->load->model('User_model');
		$this->User_model->change_order($id1, $id2);
	}
	
	function add_to_view($id){
		$this->load->model('User_model');
		$this->User_model->add_to_view($id);
	}	
	
	function enqueue_movie($id){
		$this->load->model('User_model');
		$this->User_model->add_to_view($id);
		redirect($_SERVER['HTTP_REFERER']);
	}	
	
	function dequeue_movie($id){
		$this->load->model('User_model');
		$this->User_model->del_to_view($id);
		redirect($_SERVER['HTTP_REFERER']);
	}	
	
	function replace_to_view($idnew, $id){
		$this->load->model('User_model');
		$reload = $this->User_model->replace_to_view($idnew, $id);
		if($reload)
			redirect($_SERVER['HTTP_REFERER']);
	}	
	
	function account_activation(){
		$this->load->model('User_model');
		$activationkey = $this->uri->segment(3);
		$query = $this->User_model->get_member_activationkey($activationkey);
		if($query->num_rows() > 0){
			foreach ($query->result() as $row){
				if($activationkey == $row->activationkey){
					$id = $row->id;
					$username = $row->username;
					$this->User_model->activate_user($id);
					$this->activation('<div style="color:green; text-aling:center; margin-left:15%;">'.$username.', Welcome to Cinéfilos <br> Please login to your account.'.'</div>');
				}
			}
		}else{
			$this->activation('<div style="color:black; text-aling:center; margin-left:15%;">The Activationkey: <div style="color:red; ">'.$activationkey.' </div>Is not in our records</div>');
		}

	}
	
	function create_member(){
		//borro captchas viejos
		$expiration = time()-7200 ;
		$sql = " DELETE FROM captcha WHERE captcha_time < ? ";
		$binds = array($expiration);
		$query = $this->db->query($sql, $binds);

		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email|unique[user.email_address]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|unique[user.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_lenght[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		//$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required');
		$this->form_validation->set_rules('captcha', 'Captcha', 'required|callback_check_captcha');

		
		if($this->form_validation->run() == FALSE){
			$this->registration();
		}else{
			//genero clave de activación
			$activationkey = '';
			$length = 32;
			$characters = "zxcvbnmasdfghjklqwertyuiop1234567890";
			for($p = 0; $p < $length; $p++){
				$activationkey .= $characters[mt_rand(0, strlen($characters)-1)];
			}
			$this->load->model('User_model');
			$to = $this->input->post('email_address');
			$from = 'no_replay@cinefilos.com.ar';
			$name = $this->input->post('first_name').' '.$this->input->post('last_name');
			$subject = 'Registration Cinéfilos';
			$message = 'Test a link <a href="http://localhost/socialNetwork/users/account_activation/'.$activationkey.'/">Click here</a>';
			$mail_sent = $this->User_model->email_send($to,$from,$name,$subject,$message);
			if($mail_sent){
				$this->User_model->create_member($activationkey);
				//a la página donde le decimos q tiene q mirar el mail
				$this->signup_success($to);
			}else{
				echo 'mail error';
			}
		}
	}

	function message_low_level(){
		list ($id, $name, $username) = $this->User_model->get_user_info($this->session->userdata('username'));
		$data['id'] = $id;
		$data['name'] = $name;
		$data['username'] = $username;
		$data['user_pic'] = $this->User_model->check_user_pic($id);
		$data['title'] = 'No Access';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'user/low_level';
		$data['robot'] = 'NOINDEX, NOFOLLOW';
		$this->load->view('includes/template', $data);
	}

	function resend_email(){
		$from = 'no_replay@cinefilos.com.ar';
		$id = $this->session->userdata('id');
		$name = $this->session->userdata('name');
		$username = $this->session->userdata('username');
		list ($activationkey,$to) = $this->User_model->get_resend_email($id);
		$subject = 'Registration Cinéfilos';
		$message = 'Test a link <a href="http://localhost/socialNetwork/users/account_activation/'.$activationkey.'/">Click here</a>';
		$this->User_model->email_send($to, $from, $name, $subject, $message);
		$this->signup_success($to);
	}

	function forgot_password(){
		$data['title'] = 'Forgot Password';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'user/forgot_password';
		$data['robot'] = 'NOINDEX, NOFOLLOW';
		$this->load->view('includes/template', $data);
	}

	function check_db_email(){
		$email_check = $this->User_model->is_email_in_DB($this->input->post('email_address'));
		return $email_check;
	}
	
	function password_reset(){
		$data['title'] = 'Forgot Password check email';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'user/check_email';
		$data['robot'] = 'NOINDEX, NOFOLLOW';
		$this->load->view('includes/template', $data);
	}
	
	function password_recovery(){
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email|callback_check_db_email');
		if($this->form_validation->run() == FALSE){
			$this->forgot_password();
		}else{
			$this->User_model->reset_password($this->input->post('email_address'));
			$this->password_reset();
		}
	}

	function error_view($error){
		$data['error'] = $error;
		$data['title'] = 'Error';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'user/error';
		$data['robot'] = 'NOINDEX, NOFOLLOW';
		$this->load->view('includes/template', $data);
	}

	function confirm_password_reset(){
		list($id, $username) = $this->User_model->get_user_info_temp_password($this->uri->segment(3));
		if(!$id || !$username){
			$this->error_view('This password does not exist');
		}else{
			$data['id'] = $id;
			$data['username'] = $username;
			$data['temp_password'] = $this->uri->segment(3);
			$data['title'] = 'Forgot password reset form';
			$data['discription'] = '';
			$data['keyword'] = '';
			$data['main_content'] = 'user/password_reset_form';
			$data['robot'] = 'NOINDEX, NOFOLLOW';
			$this->load->view('includes/template', $data);      
		}		
	}	

	function new_password(){
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_lenght[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		if($this->form_validation->run() == FALSE){
			$this->confirm_password_reset();
		}else{
			$this->User_model->change_password();
			$this->index('Your password has been reset. Please login');
		}
	}
	
	function check_captcha( $string )
    {
    	$expiration = time()-7200 ;
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
	    $binds = array($string, $this->input->ip_address(), $expiration);
	    $query = $this->db->query($sql, $binds);
	    $row = $query->row();
		
		if ( $row -> count > 0 )
		    {
		      return TRUE;
			  
		    }else{
		    	$this->form_validation->set_message('check_captcha', 'The captcha was incorrect!');
            return FALSE;
		  }
    }
	
	function rating()
    {
        $rating_value = $this->input->post("rate_val", true);
        $id_movie_rating = $this->input->post("id", true);
        $this->User_model->set_rating($id_movie_rating, $rating_value);

    }
	
	function set_agreement($degree, $id_friend)
    {
        $this->User_model->set_agreement($id_friend, $degree);

    }
		
	function search_friends(){

		if($this->input->get('s')!=NULL){
			$query = $this->input->get('s');
			$this->session->set_userdata(array('last_query' => $query));
		}
		else
			$query = $this->session->userdata('last_query');
		$data['query'] = $query;
		//paginado
        $config = array();
        $config["base_url"] = base_url() . "/index.php/user/search_friends";
        $config["total_rows"] = $this->User_model->search_friends_count($query);
		$config['use_page_numbers'] = FALSE;
        $config["per_page"] = 3;
        $config["uri_segment"] = 3;
		$config['full_tag_open'] = '<ul class="pager">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last Link';
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
 		$data["results"] = $this->User_model->search_friends($query, $config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

		$data['title'] = 'Search friends';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'user/search_friends';
		$this->load->view('includes/template',$data);
	}
	
	function friends()
    {
    	//paginado
        $config = array();
        $config["base_url"] = base_url() . "/index.php/user/friends";
        $config["total_rows"] = $this->User_model->friends_count();
		$config['use_page_numbers'] = FALSE;
        $config["per_page"] = 3;
        $config["uri_segment"] = 3;
		$config['full_tag_open'] = '<ul class="pager">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last Link';
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
 		$data["results"] = $this->User_model->friends($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $data['title'] = 'Friends';
		$data['discription'] = '';
		$data['keyword'] = '';
		$data['main_content'] = 'user/friends';
		$data['robot'] = 'NOINDEX, NOFOLLOW';
		$this->load->view('includes/template', $data);
    }

}

?>