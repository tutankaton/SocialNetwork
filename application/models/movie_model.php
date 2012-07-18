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
		
}
?>