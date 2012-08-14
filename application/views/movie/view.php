<?php list ($title, $sinopsis, $year, $calification, $image, $thumbnail, $id_genre) = $this->Movie_model->get_movie_info($id);	?>
<div style="min-height: 400px;margin-left:30px;">
		<div class="photo sample66" style="float:right; height:300px; padding-right: 50px;">
		<span></span><img width="214px"  height="317px"  src="<?php echo $thumbnail?>"></img>
	</div>
	<h1 style="color:#333333; display:inline;"><?php echo $title?> (<?php echo $year?>)</h1>	
	
	

	<?php if(!$this->User_model->is_already_saw($id))
				echo '<a  style="display:inline; float:right; text-decoration:none;" href="/socialNetwork/index.php/user/already_saw/'.$id.'" title="Already Saw">Have you seen it? <img width="26px" src="/socialNetwork/img/mono-icons/check32.png"></img></a>';
		else {
			echo '<a  style="padding-right:70px; display:inline; float:right; text-decoration:none;" href="/socialNetwork/index.php/user/recommend_to_a_friend/'.$id.'" title="Already Saw">Recommend to a friend <img width="26px" src="/socialNetwork/img/mono-icons/comment32.png"></img></a>';
		}
	?>
		<h5 style="font-size: 16px; margin-top:30px;"><?php echo $sinopsis?></h5>
		<div class="cast_director">
					
			<strong>Genre: </strong> 
			<?php	
			$genre_name = $this->Movie_model->get_genre_name($id_genre);
			echo '<a style="text-decoration:none;" href="/socialNetwork/index.php/movie/search_genre/'.$id_genre.'">'.$genre_name.'</a> ';
			?><br/><br/>
			<strong>Cast: </strong> 
			<?php $cast =  $this->Movie_model->get_cast($id);
				foreach ($cast as $actor) {
					echo '<a style="text-decoration:none;" href="/socialNetwork/index.php/movie/search_actor/'.$actor['id_actor'].'">'.$actor['name'].'</a>, ';
				}
			?>
			<br/><br/>
			<strong>Director: </strong> 
			<?php $directors =  $this->Movie_model->get_directors($id);
				foreach ($directors as $director) {
					echo '<a style="text-decoration:none;" href="/socialNetwork/index.php/movie/search_director/'.$director['id_director'].'">'.$director['name'].'</a> ';
				}
			?>
		</div>	
</div>
<!--
<div id="posts" class="single" style="float:left; width:650px; padding-top: 100px; ">
	<div class="post">
		<ul class="meta">
			<li> <strong>Tags:</strong> 
				<div class="meta-tags">
					<a href="#">Acción</a>
					<a href="#">Película</a>
					<a href="#">Lechuga</a>
				</div>
			</li>
		</ul>		
	</div>
</div>
-->
<?php $califications = $this->User_model->get_califications($id);
//por cada columna
for ($i=0; $i < 3; $i++) { 
	$indice = $i;
	echo '<div class="columna">';
	while ($indice < count($califications)) {
		echo '<div class:"review">
				<div id="posts" class="single" style="float:left;">
					<div class="post">
						<img class="minifoto"  src="'.$califications[$indice]['photo'].'"></img>
							<ul class="meta">
								<input class="star" type="radio" name="star'.$califications[$indice]['id_friend'].'" value="1" disabled="disabled"/>
								<input class="star" type="radio" name="star'.$califications[$indice]['id_friend'].'" value="2" disabled="disabled"/>
								<input class="star" type="radio" name="star'.$califications[$indice]['id_friend'].'" value="3" disabled="disabled"/>
								<input class="star" type="radio" name="star'.$califications[$indice]['id_friend'].'" value="4" disabled="disabled"/>
								<input class="star" type="radio" name="star'.$califications[$indice]['id_friend'].'" value="5" disabled="disabled"/></br>';
								if($califications[$indice]['calification']>0)
									echo '<script>$("[name=star'.$califications[$indice]['id_friend'].'][value='.$califications[$indice]['calification'].']").attr("checked","checked");</script>';
						echo '<li> <strong>By: </strong><a style="font-weight:bold; color:#AAAAAA;" href="/socialNetwork/index.php/user/profile/'.$califications[$indice]['id_friend'].'">'.$califications[$indice]['username'].'</a></li>	
							  <li> <strong>Posted on: </strong>'.$califications[$indice]['created_on'].'</li>
							  <li> <strong>Review: </strong>'.$califications[$indice]['critica'].'</li>
						  </ul>
					  </div>
				  </div>
			  </div>';
		$indice = $indice + 3;
	}
	echo '</div>';
}

?>