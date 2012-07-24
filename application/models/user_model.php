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
	
	function edit_profile(){
		$new_data = array (
			'username' => $this->input->post('username'),
			'from' => $this->input->post('from'),
			'ocupation' => $this->input->post('ocupation'),
			'language' => $this->input->post('language'),
			'relationship_status' => $this->input->post('relationship_status'),
			'about' => $this->input->post('about')
		);
		$this->db->where('id', $this->session->userdata('id'));
		$insert = $this->db->update('user', $new_data);		
		return $insert;
	}

	function review($id_movie){
		if($this->input->post('review')!=""){
				$new_data = array (
					'id_user' => $this->session->userdata('id'),
					'id_movie' => $id_movie,
					'critica' => $this->input->post('review')
				);
				$this->db->where('id_user', $this->session->userdata('id'));
				$this->db->where('id_movie', $id_movie);
				$query = $this->db->get('critica_movie');
				if($query->num_rows == 0){
					$this->db->where('id_user', $this->session->userdata('id'));
					$this->db->where('id_movie', $id_movie);
					$insert = $this->db->insert('critica_movie', $new_data);		
					return $insert;
				}else{
					$this->db->where('id_user', $this->session->userdata('id'));
					$this->db->where('id_movie', $id_movie);
					$insert = $this->db->update('critica_movie', $new_data);		
					return $insert;
				}
			}
		}


	function get_review($id_movie){
		$critica = "";
		$this->db->where('id_movie',$id_movie);
		$this->db->where('id_user',$this->session->userdata('id'));
		$query = $this->db->get('critica_movie');
		if($query->num_rows == 1){
			foreach($query->result() as $row){
				$critica = $row->critica;
			}
		}
		return $critica;
	}
	
	function get_rating($id_movie){
		$rating = "0";
		$this->db->where('id_movie',$id_movie);
		$this->db->where('id_user',$this->session->userdata('id'));
		$query = $this->db->get('calification_movie');
		if($query->num_rows == 1){
			foreach($query->result() as $row){
				$rating = $row->calification;
			}
		}
		return $rating;
	}
	
	function get_agreement($id_friend){
		$this->db->where('id_user',$this->session->userdata('id'));
		$this->db->where('id_friend',$id_friend);
		$query = $this->db->get('friendship');
		if($query->num_rows > 0){
			foreach($query->result() as $row){
				return $row->agreement;
			}
	    }
		return 0;
	}
	
	function set_rating($id_movie_rating, $rating_value){		
		$new_data = array (
			'id_user' => $this->session->userdata('id'),
			'id_movie' => $id_movie_rating,
			'calification' => $rating_value,
			'created_on' => date('y-m-d')
		);
		$this->db->where('id_user', $this->session->userdata('id'));
		$this->db->where('id_movie', $id_movie_rating);
		$query = $this->db->get('calification_movie');
		if($query->num_rows == 0){
			$this->db->where('id_user', $this->session->userdata('id'));
			$this->db->where('id_movie', $id_movie_rating);
			$insert = $this->db->insert('calification_movie', $new_data);		
			return $insert;
		}else{
			$this->db->where('id_user', $this->session->userdata('id'));
			$this->db->where('id_movie', $id_movie_rating);
			$insert = $this->db->update('calification_movie', $new_data);		
			return $insert;
		}
	}
	
	function set_agreement($id_friend, $degree){		
		$new_data = array (
			'id_user' => $this->session->userdata('id'),
			'id_friend' => $id_friend,
			'created_on' => date('y-m-d'),
			'agreement' => $degree+1
		);
		$this->db->where('id_user', $this->session->userdata('id'));
		$this->db->where('id_friend', $id_friend);
		$query = $this->db->get('friendship');
		if($query->num_rows == 0){
			$this->db->where('id_user', $this->session->userdata('id'));
			$this->db->where('id_friend', $id_friend);
			$insert = $this->db->insert('friendship', $new_data);		
			return $insert;
		}else{
			$this->db->where('id_user', $this->session->userdata('id'));
			$this->db->where('id_friend', $id_friend);
			$insert = $this->db->update('friendship', $new_data);		
			return $insert;
		}
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
		
		if(isset( $_POST['rember_me']))
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
				$data = array(
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
				    'name'   => 'cinefilos',
				    'value'  => 'The Value',
				    'expire' => '86500',
				    'domain' => 'localhost',
				    'path'   => '/',
				    'prefix' => 'myprefix_',
				    'secure' => TRUE
				);
				
				//setcookie('cinefilos', 'Value', time()+450000);
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
	
	function info_profile($id_profile){
		$this->db->where('id',$id_profile);
		$query = $this->db->get('user');
		if($query->num_rows == 1){
			foreach($query->result() as $row){
				$username = $row->username;
				$id = $row->id;
				$sex = $row->sex;
				$month = $row->month;
				$day = $row->day;
				$year = $row->year;
				$created_on = $row->created_on;
				$last_active = $row->last_active;
				$photo = $row->photo;
				$ocupation = $row->ocupation;
				$about = $row->about;
				$from = $row->from;
				$language = $row->language;
				$relationship_status = $row->relationship_status;
			}
		}else{
			redirect('user');
		}
		return array ('id' => $id, 'username' => $username,'sex' => $sex,'month' => $month,'day' =>  $day,'year' =>  $year,'created_on' =>  $created_on,'last_active' =>  $last_active,	'photo' => $photo,'ocupation' => $ocupation,
					'about' => $about,'from' => $from,'language' => $language,'relationship_status' => $relationship_status);
	}
	
	function movies_to_view($id_profile){
		$list[0] = "";$list[1] = "";$list[2] = "";$list[3] = "";$list[4] = "";
		$this->db->where('id_user',$id_profile);
		$query = $this->db->get('to_view');
		$i = 0;
		if($query->num_rows > 0){
			foreach($query->result() as $row){
				$this->db->where('id',$row->id_movie);
				$q = $this->db->get('movie');
				foreach($q->result() as $row){
					$list[$i] = array('id' => $row->id, 'title' => $row->title, 'year' => $row->year, 'thumbnail' => $row->thumbnail, 'calification' => $row->calification);
				}
				$i++;
				if($i>4)
					return $list;
			}
		}
		while ($i<5){
			$list[$i] = array('id' => '0', 'title' => 'No selected', 'year' => '', 'thumbnail' => '/socialNetwork/img/dummies/nothing.jpg', 'calification' => '');
			$i++;
		}
		return $list;
	}
	
	function add_to_view($id1){
		$new_data = array (
			'id_user' => $this->session->userdata('id'),
			'id_movie' => $id1
		);
		
		$insert = $this->db->insert('to_view', $new_data);
		return $insert;
	}
	
	function replace_to_view($idnew, $id){
		$this->add_to_view($idnew);
		$this->change_order($idnew, $id);
		
		$this->db->where('id_user',$this->session->userdata('id'));
		$query = $this->db->get('to_view');
		if($query->num_rows <4)
			return true;
		else 
			return false;
	}
	
	function change_order($id1, $id2){
		$this->db->where('id_user',$this->session->userdata('id'));
		$this->db->where('id_movie',$id1);
		$query = $this->db->get('to_view');
		foreach($query->result() as $row){
			$id_aux = $row->id;
			$id_movie_aux = $row->id_movie;
			$id_user_aux = $row->id_user;
		}
		$this->db->where('id_user',$this->session->userdata('id'));
		$this->db->where('id_movie',$id2);
		$query = $this->db->get('to_view');
		foreach($query->result() as $row){
			$id_aux2 = $row->id;
			$id_movie_aux2 = $row->id_movie;
			$id_user_aux2 = $row->id_user;
		}
		$new_data1 = array (
			'id_movie' => $id_movie_aux2,
			'id_user' => $id_user_aux2
		);
		$new_data2 = array (
			'id_movie' => $id_movie_aux,
			'id_user' => $id_user_aux
		);
		$this->db->where('id', $id_aux);
		$this->db->update('to_view', $new_data1);	
		$this->db->where('id', $id_aux2);
		$this->db->update('to_view', $new_data2);	
		return true;
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
	
	function search_friends($query){
		$this->db->like('username',$query);
		$this->db->where('id !=',$this->session->userdata('id'));
		$result = array();
		$i = 0;
		$query = $this->db->get('user');
		if($query->num_rows > 0){
			foreach($query->result() as $row){
				$username = $row->username;
				$id = $row->id;
				$photo = $row->photo;
				$result[$i] = array ('id' => $id, 'username' => $username, 'photo' => $photo);
				$i++;
			}
        }
		return $result;		
	}

	function get_resend_email($id){
		$query = $this->db->where('id', $id)->get('user');
		foreach($query->result() as $row){
			$activationkey = $row->activationkey;
			$to = $row->email_address;
		}
		return array ($activationkey, $to);
	}
	
	function is_friend($id){
		$this->db->where('id_user',$this->session->userdata('id'));
		$this->db->where('id_friend',$id);
		$query = $this->db->get('friendship');
		if($query->num_rows > 0){
			return TRUE;
	    }
		return FALSE;		
	}
	
	function delete_friendship($id){
		$myid = $this->session->userdata('id');
		$sql = " DELETE FROM friendship WHERE id_user = $myid AND id_friend = ?";
		$binds = array($id);
		$query = $this->db->query($sql, $binds);		
	}
	
	function add_friendship($id){
		$myid = $this->session->userdata('id');
		$sql = "INSERT INTO friendship(id_user,id_friend,created_on)VALUES ($myid,?,CURDATE());";
		$binds = array($id);
		$query = $this->db->query($sql, $binds);		
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
		
	function get_photo(){
		$id = $this->session->userdata('id');
		$this->db->where('id',$id);
		$query = $this->db->get('user');
		if($query->num_rows == 1){
			foreach($query->result() as $row){
				return $row->photo;
			}
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
	function update_photo($photo){
		$id = $this->session->userdata('id');
		$data = array(
					'photo' => $photo
					);
		$this->db->where('id', $id)->update('user', $data);
	}
	
	function friends_count(){		
		$this->db->where('id_user',$this->session->userdata('id'));
		$query = $this->db->get('friendship');
		return $query->num_rows;

	}
	
	function friends($limit, $start){
		$this->db->limit($limit, $start);		
		$this->db->where('id_user',$this->session->userdata('id'));
		$result = array();
		$query = $this->db->get('friendship');
		$i = 0;
		if($query->num_rows > 0){
			foreach($query->result() as $row){
				$id_friend = $row->id_friend;
				$id = $row->id;
				$created_on = $row->created_on;
				$this->db->where('id',$id_friend);
				$query2 = $this->db->get('user');
				if($query2->num_rows > 0){
					foreach($query2->result() as $row2){
						$username = $row2->username;
						$photo = $row2->photo;
						$result[$i] = array ('id' => $id, 'id_friend' => $id_friend, 'created_on' => $created_on, 'username' => $username, 'photo' => $photo);
					}
		        }
				$i++;
			}
        }
		return $result;		
	}
		
}

?>