<?php list ($title, $sinopsis, $year, $calification, $image, $thumbnail) = $this->Movie_model->get_movie_info($id);	?>

<h1 style="color:#333333; margin-left: 30px;display:inline;"><?php echo $title?> (<?php echo $year?>)</h1>	


<div class="photo sample66" style="float:right; height:300px; padding-right: 50px;">
	<span></span><img width="214px"  height="317px"  src="<?php echo $thumbnail?>"></img>
</div>
<?php if(!$this->User_model->is_already_saw($id))
			echo '<a  style="display:inline; float:right; text-decoration:none;" href="/socialNetwork/index.php/user/already_saw/'.$id.'" title="Already Saw">Have you seen it? <img width="26px" src="/socialNetwork/img/mono-icons/check32.png"></img></a>';
?>
	<h5 style="font-size: 16px; margin-top:30px;margin-left:30px;"><?php echo $sinopsis?></h5>	
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
							  <li> <strong>Posted on :</strong>'.$califications[$indice]['created_on'].'</li>
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