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
	
	function recomends_movies_general($id_user){

		$movies = array();
		$movies_info = array();
		$indice = 1;
		$query = $this->db->get('calification_movie');
		foreach($query->result() as $row){
			$aux = array_search($row->id_movie, $movies); //false si no existe
			if(!$aux){
				$movies[$indice] = $row->id_movie;
				$movies_info[$indice] = array('id_movie' => $row->id_movie, 'calification' => $row->calification,'factor' => 1, 'created_on' => $row->created_on);
				$indice++;
			}else{
				$calification_aux = $movies_info[$aux]['calification'];
				$factor_aux = $movies_info[$aux]['factor'];
				$movies_info[$aux] = array('id_movie' => $row->id_movie, 'calification' => $calification_aux + $row->calification,'factor' => 1+$factor_aux, 'created_on' => $row->created_on);
			}//created_on para valorar las actualmente populares y dar dinámica
		}// esta calificación no depende de las amistades!
		//recupero ya vistas si es que el usuario esta logueado
		
		if($id_user!=NULL){
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
					$definitive_list[$i] = array('rank' => $possible_movie['calification']/$possible_movie['factor'], 'id_movie' => $possible_movie['id_movie'], 'timestamp' => $possible_movie['created_on']);
					$i++;
				}
			}
		}else{
			$i = 0;
			foreach ($movies_info as $possible_movie) {
					$definitive_list[$i] = array('rank' => $possible_movie['calification']/$possible_movie['factor'], 'id_movie' => $possible_movie['id_movie'], 'timestamp' => $possible_movie['created_on']);
					$i++;
			}
		}
		
		//ordeno por ranking y por timestamp (actual popularidad)
		foreach ($definitive_list as $key => $row) {
		    $rank[$key]  = $row['rank'];
		    $id_movie[$key] = $row['id_movie'];
			$timestamp[$key] = $row['timestamp'];
		}
		array_multisort($rank, SORT_DESC, $timestamp, SORT_DESC, $definitive_list);
		
		return $definitive_list;
	}
		
}
?>