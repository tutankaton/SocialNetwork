<?php
class User_model extends CI_Model{
	
	function email_send($to,$from,$name,$subject,$message){
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'localhost';
		$config['smtp_port'] = '25';
		$config['smtp_user'] = 'postmaster';
		$config['smtp_pass'] = '';
		
		$this->load->library('email', $config);
		$this->email->from($from, $name);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		
		if($this->email->send()){
			return true;
		}else{
			return false;	
		}
	}

	function create_member($activationkey){
		$new_member_insert_data = array (
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email_address' => $this->input->post('email_address'),
			'username' => $this->input->post('username'),
			'sex' => $this->input->post('sex'),
			'month' => $this->input->post('month'),
			'day' => $this->input->post('day'),
			'year' => $this->input->post('year'),
			'password' => md5($this->input->post('password')),
			'activationkey' => $activationkey,
			'user_level' => 0,
			'created_on' => date('y-m-d'),
			'last_active' => date('y-m-d',time())
		);
		
		$insert = $this->db->insert('user', $new_member_insert_data);
		return $insert;
	}

	function get_member_activationkey($activationkey){
		$query = $this->db->where('activationkey',$activationkey)->get('user');
		return $query;
	}
	
	function activate_user($id){
		mkdir("members/$id", 0755);
		$data = array(
						'activationkey' => '',
						'user_level' => '1'
					);
		$this->db->update('user', $data, "id = $id");
	}

	function validate(){

		$this->db->where('username', $_POST['username']);
		$this->db->where('password', md5($_POST['password']));
		
		$check_box = $_POST['rember_me'];
		
		$query = $this->db->get('user');
		if($query->num_rows == 1){
			foreach ($query->result() as $row) {
				$user_level = $row->user_level;	
				$username = $row->username;	
				$password = $row->password;
				$id = $row->id;	
				$first_name = $row->user_level;	
				$last_name = $row->last_name;	
				$data = $arrayName = array(
										'username' => $username,
										'id' => $id,
										'name' => $first_name.' '.$last_name,
										'user_level' => $user_level,
										'is_logged_in' => true											
										);
				$this->session->set_userdata($data);		
			}
			
			if($check_box == "accept"){
				$value = array (
								'id' => $id,
								'username' => $username
								);
				$value = serialize($value);
				$cookie = array(
								'name' => 'cinefilos',
								'value' => $value,
								'expire' => '2410000',
								'domain' => 'localhost',
								'path' => '/socialNetwork/',
								'prefix' => '',
								'secure' => FALSE
								);
				set_cookie($cookie);
			}
			
			return true;
		}else{
			return false;
		}
	}

	function check_user_level(){
		if($this->session->userdata('user_level') > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function get_user_info($username){
		$this->db->where('username',$username);
		$query = $this->db->get('user');
		if($query->num_rows == 1){
			foreach($query->result() as $row){
				$name = $row->first_name.' '.$row->last_name;
				$id = $row->id;
			}
		}else{
			redirect('user');
		}
		return array ($id, $name, $username);
	}

	function get_resend_email($id){
		$query = $this->db->where('id', $id)->get('user');
		foreach($query->result() as $row){
			$activationkey = $row->activationkey;
			$to = $row->email_address;
		}
		return array ($activationkey, $to);
	}

	function is_email_in_DB($email){
		$query = $this->db->where('email_address', $email)->get('user');
		if($query->num_rows == 1){
			return TRUE;
		}else{
			$this->form_validation->set_message('check_db_email', 'The Email is '.$email.' is not in our records');
			return FALSE;
		}
	}
	
	function reset_password($email){
		$temp_password = '';
		$length = 8;
		$p = 0;
		$characters = "zxcvbnmasdfghjklqwertyuiop1234567890";
		for ($p = 0; $p < $length; $p++){
			$temp_password .= $characters[mt_rand(0, strlen($characters)-1)];
		}
		
		$to = $email;
		$query = $this->db->where('email_address', $email)->get('user');
		foreach($query->result() as $row){
			$name = $row->first_name.' '.$row->last_name;
			$id = $row->id;
		}
		$data = array(
					'temp_password' => $temp_password
					);
		$this->db->update('user', $data, "id = $id");
		$from = 'no_reply@cinefilos.com.ar';
		$subject = 'Lost password cinéfilos';
		$message = 'A request for password reset has been sent to Cinéfilos. If this you did not request a Password reset please ignore this message. To reset your password please click https://localhost/socialNetwork/user/confirm_password_reset/'.$temp_password.'/';
		$this->email_send($to, $from, $name, $subject, $message);
	}

	function get_user_info_temp_password($temp_password){
		$query = $this->db->where('temp_password',$temp_password)->get('user');
		if($query->num_rows > 0){
			foreach ($query->result() as $row){
				$id = $row->id;
				$username = $row->username;
			}
		}else{
			$id = false;
			$username = false;
		}
		return array($id,$username);
	}
	
	function change_password(){
		$id = $this->input->post('id');
		$data = array(
					'password' => md5($this->input->post('password')),
					'temp_password' => ''
					);
		$query = $this->db->update('user', $data, "id = $id");	
	}
	
	function is_logged_in(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != TRUE){
			return FALSE;
		}else{
			return TRUE;
		}
	}

	function get_sess_from_cookie(){
		$cookie = get_cookie('cinefilos');
		$value = unserialize($cookie);
		$id = $value['id'];
		$username = $value['username'];
		
		$this->db->where('username',$username);
		$this->db->where('id',$id);
		$query = $this->db->get('user');
		if($query->num_rows == 1){
			foreach ($query->result() as $row){
				$user_level = $row->user_level;
				$username = $row->username;
				$password = $row->password;
				$id = $row->id;
				$first_name = $row->first_name;
				$last_name = $row->last_name;
			}
		}
		$data = array(
					'username' => $username,
					'id' => $id,
					'name' => $first_name.' '.$last_name,
					'user_level' => $user_level,
					'is_logged_in' => TRUE
					);
		$this->session->set_userdata($data);
	}

	function update_online_status(){
		$cookie = get_cookie('cinefilos');
		$value = unserialize($cookie);
		$id = $value['id'];
		$this->load->helper('date');
		$data = array(
					'last_active' => now()
					);
		$this->db->where('id', $id)->update('user', $data);
	}
		
}
/*
class User_model extends CI_Model{
	
	function email_send($to,$from,$name,$subject,$message){
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'localhost';
		$config['smtp_port'] = '25';
		$config['smtp_user'] = 'postmaster';
		$config['smtp_pass'] = '';
		
		$this->load->library('email', $config);
		$this->email->from($from, $name);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		
		if($this->email->send()){
			return true;
		}else{
			return false;	
		}
	}

	function create_member($activationkey){
		$new_member_insert_data = array (
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email_address' => $this->input->post('email_address'),
			'username' => $this->input->post('username'),
			'sex' => $this->input->post('sex'),
			'month' => $this->input->post('month'),
			'day' => $this->input->post('day'),
			'year' => $this->input->post('year'),
			'password' => md5($this->input->post('password')),
			'activationkey' => $activationkey,
			'user_level' => 0,
			'created_on' => date('y-m-d'),
			'last_active' => date('y-m-d',time())
		);
		
		$insert = $this->db->insert('user', $new_member_insert_data);
		return $insert;
	}

	function get_member_activationkey($activationkey){
		$query = $this->db->where('activationkey',$activationkey)->get('user');
		return $query;
	}
	
	function activate_user($id){
		mkdir("members/$id", 0755);
		$data = array(
						'activationkey' => '',
						'user_level' => '1'
					);
		$this->db->update('user', $data, "id = $id");
	}

	function validate(){
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));
		
		$check_box = $this->input->post('rember_me');
		
		$query = $this->db->get('user');
		if($query->num_rows == 1){
			foreach ($query->result() as $row) {
				$user_level = $row->user_level;	
				$username = $row->username;	
				$password = $row->password;
				$id = $row->id;	
				$first_name = $row->user_level;	
				$last_name = $row->last_name;	
				$data = $arrayName = array(
										'username' => $username,
										'id' => $id,
										'name' => $first_name.' '.$last_name,
										'user_level' => $user_level,
										'is_logged_in' => true											
										);
				$this->session->set_userdata($data);		
			}
			
			if($check_box == "accept"){
				$value = array (
								'id' => $id,
								'username' => $username
								);
				$value = serialize($value);
				$cookie = array(
								'name' => 'cinefilos',
								'value' => $value,
								'expire' => '2410000',
								'domain' => 'localhost',
								'path' => '/socialNetwork/',
								'prefix' => '',
								'secure' => FALSE
								);
				set_cookie($cookie);
			}
			
			return true;
		}else{
			return false;
		}
	}

	function check_user_level(){
		if($this->session->userdata('user_level') > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function get_user_info($username){
		$this->db->where('username',$username);
		$query = $this->db->get('user');
		if($query->num_rows == 1){
			foreach($query->result() as $row){
				$name = $row->first_name.' '.$row->last_name;
				$id = $row->id;
			}
		}else{
			redirect('user');
		}
		return array ($id, $name, $username);
	}

	function get_resend_email($id){
		$query = $this->db->where('id', $id)->get('user');
		foreach($query->result() as $row){
			$activationkey = $row->activationkey;
			$to = $row->email_address;
		}
		return array ($activationkey, $to);
	}

	function is_email_in_DB($email){
		$query = $this->db->where('email_address', $email)->get('user');
		if($query->num_rows == 1){
			return TRUE;
		}else{
			$this->form_validation->set_message('check_db_email', 'The Email is '.$email.' is not in our records');
			return FALSE;
		}
	}
	
	function reset_password($email){
		$temp_password = '';
		$length = 8;
		$p = 0;
		$characters = "zxcvbnmasdfghjklqwertyuiop1234567890";
		for ($p = 0; $p < $length; $p++){
			$temp_password .= $characters[mt_rand(0, strlen($characters)-1)];
		}
		
		$to = $email;
		$query = $this->db->where('email_address', $email)->get('user');
		foreach($query->result() as $row){
			$name = $row->first_name.' '.$row->last_name;
			$id = $row->id;
		}
		$data = array(
					'temp_password' => $temp_password
					);
		$this->db->update('user', $data, "id = $id");
		$from = 'no_reply@cinefilos.com.ar';
		$subject = 'Lost password cinéfilos';
		$message = 'A request for password reset has been sent to Cinéfilos. If this you did not request a Password reset please ignore this message. To reset your password please click https://localhost/socialNetwork/user/confirm_password_reset/'.$temp_password.'/';
		$this->email_send($to, $from, $name, $subject, $message);
	}

	function get_user_info_temp_password($temp_password){
		$query = $this->db->where('temp_password',$temp_password)->get('user');
		if($query->num_rows > 0){
			foreach ($query->result() as $row){
				$id = $row->id;
				$username = $row->username;
			}
		}else{
			$id = false;
			$username = false;
		}
		return array($id,$username);
	}
	
	function change_password(){
		$id = $this->input->post('id');
		$data = array(
					'password' => md5($this->input->post('password')),
					'temp_password' => ''
					);
		$query = $this->db->update('user', $data, "id = $id");	
	}
	
	function is_logged_in(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != TRUE){
			return FALSE;
		}else{
			return TRUE;
		}
	}

	function get_sess_from_cookie(){
		$cookie = get_cookie('cinefilos');
		$value = unserialize($cookie);
		$id = $value['id'];
		$username = $value['username'];
		
		$this->db->where('username',$username);
		$this->db->where('id',$id);
		$query = $this->db->get('user');
		if($query->num_rows == 1){
			foreach ($query->result() as $row){
				$user_level = $row->user_level;
				$username = $row->username;
				$password = $row->password;
				$id = $row->id;
				$first_name = $row->first_name;
				$last_name = $row->last_name;
			}
		}
		$data = array(
					'username' => $username,
					'id' => $id,
					'name' => $first_name.' '.$last_name,
					'user_level' => $user_level,
					'is_logged_in' => TRUE
					);
		$this->session->set_userdata($data);
	}

	function update_online_status(){
		$cookie = get_cookie('cinefilos');
		$value = unserialize($cookie);
		$id = $value['id'];
		$this->load->helper('date');
		$data = array(
					'last_active' => now()
					);
		$this->db->where('id', $id)->update('user', $data);
	}
		
}
*/
?>