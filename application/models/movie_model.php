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
				$id_genre = $row->id_genre;
			}
		}else{
			redirect('user');
		}
		return array ($title, $sinopsis, $year, $calification, $image, $thumbnail, $id_genre);
	}
	
	function search_movies_count($query){
		$this->db->like('title',$query);
		$query = $this->db->get('movie');
		return $query->num_rows;		
	}
	
	function search_movies($query, $limit, $start){
		$this->db->limit($limit, $start);	
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
	
	function get_cast($id_movie){
		$result = array();
		$i = 0;
		$this->db->where('id_movie',$id_movie);
		$query = $this->db->get('movie_actor');
		if($query->num_rows > 0){
			foreach($query->result() as $row){
				$this->db->where('id',$row->id_actor);
				$q= $this->db->get('actor');
				foreach($q->result() as $r){
					$result[$i] = array('id_actor' => $row->id_actor, 'name' => $r->name);
				}
				$i++;
			}
        }
		return $result;		
	}
	
	function get_directors($id_movie){
		$result = array();
		$i = 0;
		$this->db->where('id_movie',$id_movie);
		$query = $this->db->get('movie_director');
		if($query->num_rows > 0){
			foreach($query->result() as $row){
				$this->db->where('id',$row->id_director);
				$q= $this->db->get('director');
				foreach($q->result() as $r){
					$result[$i] = array('id_director' => $row->id_director, 'name' => $r->name);
				}
				$i++;
			}
        }
		return $result;		
	}
	
	function get_genre_name($id_genre){
		$this->db->where('id',$id_genre);
		$query = $this->db->get('genre');
		if($query->num_rows > 0){
			foreach($query->result() as $row){
				return $row->name;
			}
        }
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
		$already_view = array();
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
		
		$i = 0;
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

	function search_actor($query, $limit, $start){
		$this->db->where('id_actor',$query);
		$result = array();
		$i = 0;
		$qu = $this->db->get('movie_actor');
		
		if($qu->num_rows > 0){
			foreach($qu->result() as $row){						
				$this->db->where('id',$row->id_movie);
				$q = $this->db->get('movie');
				foreach($q->result() as $r){					
					$title = $r->title;
					$id = $r->id;
					$image = $r->image;
					$thumbnail = $r->thumbnail;
					$year = $r->year;
					$calification = $r->calification;
					$sinopsis = $r->sinopsis;
					$result[$i] = array ('id' => $id, 'title' => $title, 'image' => $image, 'thumbnail' => $thumbnail, 'year' => $year, 'calification' => $calification, 'sinopsis' => $sinopsis);
					$i++;					
				}
			}
        }
		return $result;		
	}
	
	function search_actor_count($query){
		$this->db->where('id_actor',$query);
		$query = $this->db->get('movie_actor');
		return $query->num_rows;	
	}
	
	function search_genre($query, $limit, $start){
		$this->db->limit($limit, $start);	
		$this->db->where('id_genre',$query);
		$result = array();
		$i = 0;
		$q = $this->db->get('movie');
		
		if($q->num_rows > 0){
			foreach($q->result() as $r){					
				$title = $r->title;
				$id = $r->id;
				$image = $r->image;
				$thumbnail = $r->thumbnail;
				$year = $r->year;
				$calification = $r->calification;
				$sinopsis = $r->sinopsis;
				$result[$i] = array ('id' => $id, 'title' => $title, 'image' => $image, 'thumbnail' => $thumbnail, 'year' => $year, 'calification' => $calification, 'sinopsis' => $sinopsis);
				$i++;					
			}
        }
		return $result;		
	}
	
	function search_genre_count($query){
		$this->db->where('id_genre',$query);
		$query = $this->db->get('movie');
		return $query->num_rows;	
	}
	
	function search_director($query, $limit, $start){
		$this->db->where('id_director',$query);
		$result = array();
		$i = 0;
		$qu = $this->db->get('movie_director');
		
		if($qu->num_rows > 0){
			foreach($qu->result() as $row){						
				$this->db->where('id',$row->id_movie);
				$q = $this->db->get('movie');
				foreach($q->result() as $r){					
					$title = $r->title;
					$id = $r->id;
					$image = $r->image;
					$thumbnail = $r->thumbnail;
					$year = $r->year;
					$calification = $r->calification;
					$sinopsis = $r->sinopsis;
					$result[$i] = array ('id' => $id, 'title' => $title, 'image' => $image, 'thumbnail' => $thumbnail, 'year' => $year, 'calification' => $calification, 'sinopsis' => $sinopsis);
					$i++;					
				}
			}
        }
		return $result;		
	}
	
	function search_director_count($query){
		$this->db->where('id_director',$query);
		$query = $this->db->get('movie_director');
		return $query->num_rows;	
	}
		
}
?>