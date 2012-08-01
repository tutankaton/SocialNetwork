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

	function get_top($id_profile){
		$this->db->where('id',$id_profile);
		$query = $this->db->get('user');
		if($query->num_rows > 0){
			foreach($query->result() as $row){
				if($row->top1 != NULL){
					$this->db->where('id',$row->top1);
					$q = $this->db->get('movie');
					foreach($q->result() as $auxrow){
						$list[0] = array('id' => $auxrow->id, 'title' => $auxrow->title, 'year' => $auxrow->year, 'thumbnail' => $auxrow->thumbnail, 'calification' => $auxrow->calification);
					}
				}else{
					$list[0] = array('id' => '0', 'title' => 'No selected', 'year' => '', 'thumbnail' => '/socialNetwork/img/dummies/nothing.jpg', 'calification' => '');
				}
				if($row->top2 != NULL){
					$this->db->where('id',$row->top2);
					$q = $this->db->get('movie');
					foreach($q->result() as $auxrow){
						$list[1] = array('id' => $auxrow->id, 'title' => $auxrow->title, 'year' => $auxrow->year, 'thumbnail' => $auxrow->thumbnail, 'calification' => $auxrow->calification);
					}
				}else{
					$list[1] = array('id' => '0', 'title' => 'No selected', 'year' => '', 'thumbnail' => '/socialNetwork/img/dummies/nothing.jpg', 'calification' => '');
				}
				if($row->top3 != NULL){
					$this->db->where('id',$row->top3);
					$q = $this->db->get('movie');
					foreach($q->result() as $auxrow){
						$list[2] = array('id' => $auxrow->id, 'title' => $auxrow->title, 'year' => $auxrow->year, 'thumbnail' => $auxrow->thumbnail, 'calification' => $auxrow->calification);
					}
				}else{
					$list[2] = array('id' => '0', 'title' => 'No selected', 'year' => '', 'thumbnail' => '/socialNetwork/img/dummies/nothing.jpg', 'calification' => '');
				}
			}
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

	function del_to_view($id1){
		$this->db->where('id_movie',$id1);
		$this->db->where('id_user', $this->session->userdata('id'));
		$this->db->delete('to_view'); 
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
	
	function set_top($top, $id){
		if($top==1){
			$new_data = array (
				'top1' => $id
			);
			$this->db->where('id', $this->session->userdata('id'));
			$this->db->update('user', $new_data);	
		}else if ($top==2){
			$new_data = array (
				'top2' => $id
			);
			$this->db->where('id', $this->session->userdata('id'));
			$this->db->update('user', $new_data);	
		}	
		else if ($top==3){
			$new_data = array (
				'top3' => $id
			);
			$this->db->where('id', $this->session->userdata('id'));
			$this->db->update('user', $new_data);	
		}		
		return true;
	}
	
	function del_top($top){
		if($top==1){
			$new_data = array (
				'top1' => NULL
			);
			$this->db->where('id', $this->session->userdata('id'));
			$this->db->update('user', $new_data);	
		}else if ($top==2){
			$new_data = array (
				'top2' => NULL
			);
			$this->db->where('id', $this->session->userdata('id'));
			$this->db->update('user', $new_data);	
		}	
		else if ($top==3){
			$new_data = array (
				'top3' => NULL
			);
			$this->db->where('id', $this->session->userdata('id'));
			$this->db->update('user', $new_data);	
		}		
		return true;
	}
	
	function change_order_top($type){ 
		$this->db->where('id',$this->session->userdata('id'));
		$query = $this->db->get('user');
		if($type==0){
			foreach($query->result() as $row){
			$id_top1 = $row->top2;
			$id_top2 = $row->top1;
			$new_data = array (
				'top1' => $id_top1,
				'top2' => $id_top2
				);
			$this->db->where('id', $this->session->userdata('id'));
			$this->db->update('user', $new_data);	
			}
		}else if ($type==1){
			foreach($query->result() as $row){
			$id_top1 = $row->top3;
			$id_top3 = $row->top1;
			$new_data = array (
				'top1' => $id_top1,
				'top3' => $id_top3
				);
			$this->db->where('id', $this->session->userdata('id'));
			$this->db->update('user', $new_data);	
			}
		}else if ($type==2){
			foreach($query->result() as $row){
			$id_top3 = $row->top2;
			$id_top2 = $row->top3;
			$new_data = array (
				'top3' => $id_top3,
				'top2' => $id_top2
				);
			$this->db->where('id', $this->session->userdata('id'));
			$this->db->update('user', $new_data);	
			}
		}	
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
	
	function search_friends($query, $limit, $start){
		$this->db->limit($limit, $start);	
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

	function search_friends_count($query){		
		$this->db->like('username',$query);
		$this->db->where('id !=',$this->session->userdata('id'));
		$query = $this->db->get('user');
		return $query->num_rows;
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
	
	function is_enqueue($id){
		$this->db->where('id_user',$this->session->userdata('id'));
		$this->db->where('id_movie',$id);
		$query = $this->db->get('to_view');
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
	
	function is_already_saw($id){		
		if($this->is_logged_in()){
			$this->db->where('id_user',$this->session->userdata('id'));
			$this->db->where('id_movie',$id);
			$query = $this->db->get('already_view');			
			if($query->num_rows > 0){
				return TRUE;
	        }
		}
		return FALSE;
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

	function recomends_movies_to_view(){
		$id_user = $this->session->userdata('id');
		$this->load->model('Movie_model'); $this->Movie_model->recomends_movies_general(NULL);
		//recupero amigos
		$this->db->where('id_user',$id_user);
		$query = $this->db->get('friendship');
		$i = 0;
		if($query->num_rows > 0){
			foreach($query->result() as $row){
				if($row->agreement == NULL)
					$friends[$i] = array('agreement' => "5", 'id_friend' => $row->id_friend);
				else 
					$friends[$i] = array('agreement' => $row->agreement, 'id_friend' => $row->id_friend);
				$i++;
			}
		}		
		
		$movies = array();
		$movies_info = array();
		$indice = 1;
		if(isset($friends)){
			foreach ($friends as $friend) {
				$this->db->where('id_user',$friend['id_friend']);
				$query = $this->db->get('calification_movie');
				foreach($query->result() as $row){
					$aux = array_search($row->id_movie, $movies); //false si no existe
					if(!$aux){
						$movies[$indice] = $row->id_movie;
						$movies_info[$indice] = array('id_movie' => $row->id_movie, 'calification' => $row->calification * $friend['agreement'],'factor' => $friend['agreement']);
						$indice++;
					}else{
						$calification_aux = $movies_info[$aux]['calification'];
						$factor_aux = $movies_info[$aux]['factor'];
						$movies_info[$aux] = array('id_movie' => $row->id_movie, 'calification' => $calification_aux + $row->calification * $friend['agreement'],'factor' => $factor_aux + $friend['agreement']);
					}
				}
			}
		}
		//recupero ya vistas
		$this->db->where('id_user',$id_user);
		$query = $this->db->get('already_view');
		$i = 0;
		if($query->num_rows > 0){
			foreach($query->result() as $row){
				$already_view[$i] = $row->id_movie;
				$i++;
			}			
		}
		
		$definitive_list = array();
		$i = 0;
		foreach ($movies_info as $possible_movie) {
			$la_vi = array_search($possible_movie['id_movie'], $already_view);
			if(!$la_vi){
				$definitive_list[$i] = array('rank' => $possible_movie['calification']/$possible_movie['factor'], 'id_movie' => $possible_movie['id_movie']);
				$i++;
			}
		}
		//ordeno por ranking
		array_multisort($definitive_list, SORT_DESC);
		
		$i = 0;
		if ($definitive_list!=NULL){
			foreach ($definitive_list as $reco) {
				$this->db->where('id',$reco['id_movie']);
				$query = $this->db->get('movie');
				if($query->num_rows > 0){
					foreach($query->result() as $row){
							$title = $row->title;
							$id = $row->id;
							$image = $row->image;
							$thumbnail = $row->thumbnail;
							$year = $row->year;
							$calification = $row->calification;
							$sinopsis = $row->sinopsis;
							$result[$i] = array ('id' => $id, 'title' => $title, 'image' => $image, 'thumbnail' => $thumbnail, 'year' => $year, 'calification' => $calification, 'sinopsis' => $sinopsis);
							$i++;
					}
		        }
			}
			return $result;
		}
		return array();
	}

	function recomends_movies_to_top(){
		$id_user = $this->session->userdata('id');
		
		//recupero ya vistas
		$this->db->where('id_user',$id_user);
		$query = $this->db->get('already_view');
		$i = 0;
		if($query->num_rows > 0){
			foreach($query->result() as $row){
				$this->db->where('id_user',$id_user);
				$this->db->where('id_movie',$row->id_movie);
				$q = $this->db->get('calification_movie');
				if($q->num_rows > 0){
					foreach($q->result() as $r){
						$recomends_movies_to_top[$i] = array('calification' => $r->calification, 'id_movie' => $row->id_movie);
					}			
				}else{
					$recomends_movies_to_top[$i] = array('calification' => 2.5, 'id_movie' => $row->id_movie);
				}
				$i++;
			}
		}

		array_multisort($recomends_movies_to_top, SORT_DESC);
		$i = 0;
		foreach ($recomends_movies_to_top as $reco) {
			$this->db->where('id',$reco['id_movie']);
			$query = $this->db->get('movie');
			if($query->num_rows > 0){
				foreach($query->result() as $row){
						$title = $row->title;
						$id = $row->id;
						$image = $row->image;
						$thumbnail = $row->thumbnail;
						$year = $row->year;
						$calification = $row->calification;
						$sinopsis = $row->sinopsis;
						$result[$i] = array ('id' => $id, 'title' => $title, 'image' => $image, 'thumbnail' => $thumbnail, 'year' => $year, 'calification' => $calification, 'sinopsis' => $sinopsis);
						$i++;
				}
	        }
		}
		return $result;
	}

	function get_califications($id_movie){
		$id_user = $this->session->userdata('id');

		//recupero amigos
		$this->db->where('id_user',$id_user);
		$query = $this->db->get('friendship');
		$i = 0;
		if($query->num_rows > 0){
			foreach($query->result() as $row){
				if($row->agreement == NULL)
					$friends[$i] = array('agreement' => "5", 'id_friend' => $row->id_friend);
				else 
					$friends[$i] = array('agreement' => $row->agreement, 'id_friend' => $row->id_friend);
				$i++;
			}
		}
		$califications = array();
		$indice = 0;
		if(isset($friends)){
			foreach ($friends as $friend) {
				$this->db->where('id_user',$friend['id_friend']);
				$this->db->where('id_movie',$id_movie);
				$query = $this->db->get('critica_movie');
				if($query->num_rows > 0){
					foreach($query->result() as $row){
						$critica = $row->critica;
						$this->db->where('id_user',$friend['id_friend']);
						$q = $this->db->get('calification_movie');
						if($query->num_rows > 0){
							foreach($q->result() as $r){
								$calification = $r->calification;
								$created_on = $r->created_on;
							}
						}else{
							$calification = 0;
						}
					}
					$this->db->where('id',$friend['id_friend']);
					$q = $this->db->get('user');
					foreach($q->result() as $r){
							$califications[$indice] = array('agreement' => $friend['agreement'], 'critica' => $critica, 'calification' => $calification, 'id_friend' => $friend['id_friend'], 'username' => $r->username, 'photo' => $r->photo, 'created_on' => $created_on);
					}
					$indice++;					
				}else{
					$critica = "";
				}
			}
		}
		//ordeno por acuerdo
		foreach ($califications as $key => $row) {
		    $agreement[$key]  = $row['agreement'];
		    $critica[$key] = $row['critica'];
			$calification[$key] = $row['calification'];
			$id_friend[$key] = $row['id_friend'];
			$username[$key] = $row['username'];
			$photo[$key] = $row['photo'];
			$created_on[$key] = $row['created_on'];
		}
		array_multisort($agreement, SORT_DESC,$califications);
		return $califications;
	}


}

?>