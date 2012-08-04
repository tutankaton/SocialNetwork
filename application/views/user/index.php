<h1>Lasted reviews:</h1>
<?php $califications = $this->User_model->get_last_califications($this->session->userdata('id'));
//por cada columna
for ($i=0; $i < 3; $i++) { 
	$indice = $i;
	echo '<div class="columna">';
	while ($indice < count($califications)) {
		echo '<div class:"review">
				<div id="posts" class="single" style="float:left;">
					<div class="post">
							
							<div style="float:right; width: 87px;">
							<img class="minifotomovie" src="'.$califications[$indice]['thumbnail'].'"></img>
								<input class="star" type="radio" name="star'.$califications[$indice]['id_friend'].$califications[$indice]['id_movie'].'" value="1" disabled="disabled"/>
								<input class="star" type="radio" name="star'.$califications[$indice]['id_friend'].$califications[$indice]['id_movie'].'" value="2" disabled="disabled"/>
								<input class="star" type="radio" name="star'.$califications[$indice]['id_friend'].$califications[$indice]['id_movie'].'" value="3" disabled="disabled"/>
								<input class="star" type="radio" name="star'.$califications[$indice]['id_friend'].$califications[$indice]['id_movie'].'" value="4" disabled="disabled"/>
								<input class="star" type="radio" name="star'.$califications[$indice]['id_friend'].$califications[$indice]['id_movie'].'" value="5" disabled="disabled"/></br>
							</div>
							<ul class="meta" style="padding: 5px;min-height: 145px;">';
								if($califications[$indice]['calification']>0)
									echo '<script>$("[name=star'.$califications[$indice]['id_friend'].$califications[$indice]['id_movie'].'][value='.$califications[$indice]['calification'].']").attr("checked","checked");</script>';
						echo '<img class="minifoto"  style="margin-top: -3px; float:left" src="'.$califications[$indice]['photo'].'"></img>';
						echo '<li> <strong><a style="font-weight:bold; color:#AAAAAA;" href="/socialNetwork/index.php/user/profile/'.$califications[$indice]['id_friend'].'">'.$califications[$indice]['username'].'</a> said: </strong></li>	
							  <li> '.$califications[$indice]['critica'].'</li>
						  </ul>
					  </div>
				  </div>
			  </div>';
		$indice = $indice + 3;
	}
	echo '</div>';
}