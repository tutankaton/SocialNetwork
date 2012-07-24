<?php
class Movie_model extends CI_Model{
	
	function get_movie_info($id){
		$this->db->where('id',$id);
		$query = $this->db->get('movie');
		if($query->num_rows == 1){
			foreach($query->result() as $row){
				$title = $row->title;
				$sinopsis = $row->sinopsis;
				$year = $row->year;
				$calification = $row->calification;
				$image = $row->image;
				$thumbnail = $row->thumbnail;
				$id = $row->id;
			}
		}else{
			redirect('user');
		}
		return array ($title, $sinopsis, $year, $calification, $image, $thumbnail);
	}
	
	function search_movies($query){
		$this->db->like('title',$query);
		$result = array();
		$i = 0;
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
		return $result;		
	}
	
	function search_recommend_movies($query){
		$this->db->like('title',$query);
		$result = array();
		$i = 0;
		$query = $this->db->get('movie');
		if($query->num_rows > 0){
			foreach($query->result() as $row){
				$title = $row->title;
				$id = $row->id;
				$thumbnail = $row->thumbnail;
				$year = $row->year;
				$calification = $row->calification;
				$result[$i] = array ('id' => $id, 'title' => $title, 'thumbnail' => $thumbnail, 'year' => $year, 'calification' => $calification);
				$i++;
				if ($i==7){
					return $result;
				}
			}
        }
		while ($i<7){
			$result[$i] = array('id' => '-1', 'title' => 'No selected', 'year' => '', 'thumbnail' => '/socialNetwork/img/dummies/nothing.jpg', 'calification' => '');
			$i++;
		}
		return $result;		
	}
	
	function delete_toview($id_movie){
		$this->db->where('id_movie',$id_movie);
		$this->db->where('id_user', $this->session->userdata('id'));
		$this->db->delete('to_view'); 
	}
	
	function already_saw($id_movie){
		$this->db->where('id_movie',$id_movie);
		$this->db->where('id_user',$this->session->userdata('id'));
		$query = $this->db->get('already_view');
		if($query->num_rows == 0){
			$new_already_saw = array (
				'id_user' => $this->session->userdata('id'),
				'id_movie' => $id_movie
			);		
			$this->db->insert('already_view', $new_already_saw);
		}
		$this->delete_toview($id_movie);
		
	}
		
}
?>