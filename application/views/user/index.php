<?php $califications = $this->User_model->get_last_califications_recomendations($this->session->userdata('id'));
//por cada columna
for ($i=0; $i < 3; $i++) { 
	$indice = $i;
	echo '<div class="columna">';
	while ($indice < count($califications)) {
		echo '<div class:"review">
				<div id="posts" class="single" style="float:left;">';
					if($califications[$indice]['type']=='crit'){
						echo '<div class="post">
								
								<div style="float:right; width: 87px;">
								<a href="/socialNetwork/index.php/movie/view/'.$califications[$indice]['id_movie'].'" style="cursor:pointer;"><img class="minifotomovie" id='.$califications[$indice]['id_movie'].' src="'.$califications[$indice]['thumbnail'].'"></img></a>';
									/*echo '<input class="star" type="radio" name="star'.$califications[$indice]['id_friend'].$califications[$indice]['id_movie'].'" value="1" disabled="disabled"/>
									<input class="star" type="radio" name="star'.$califications[$indice]['id_friend'].$califications[$indice]['id_movie'].'" value="2" disabled="disabled"/>
									<input class="star" type="radio" name="star'.$califications[$indice]['id_friend'].$califications[$indice]['id_movie'].'" value="3" disabled="disabled"/>
									<input class="star" type="radio" name="star'.$califications[$indice]['id_friend'].$califications[$indice]['id_movie'].'" value="4" disabled="disabled"/>
									<input class="star" type="radio" name="star'.$califications[$indice]['id_friend'].$califications[$indice]['id_movie'].'" value="5" disabled="disabled"/></br>';*/
								echo '</div>
								<ul class="meta" style="padding: 5px;min-height: 85px;">';
									//if($califications[$indice]['calification']>0)
									//	echo '<script>$("[name=star'.$califications[$indice]['id_friend'].$califications[$indice]['id_movie'].'][value='.$califications[$indice]['calification'].']").attr("checked","checked");</script>';
							echo '<img class="minifotoindex" id='.$califications[$indice]['id_friend'].' style="margin-top: -3px; float:left" src="'.$califications[$indice]['photo'].'"></img>';
							echo '<li> <strong><a style="font-weight:bold; color:#666666;" href="/socialNetwork/index.php/user/profile/'.$califications[$indice]['id_friend'].'">'.$califications[$indice]['username'].'</a> said: </strong></li>	
								  <li style="font-size:12px;"> '.$califications[$indice]['critica'].'</li>
							  </ul>
						  </div>';
					}
					else if($califications[$indice]['type']=='reco'){
						echo '<div class="post">
								
								<div style="float:right; width: 87px;">
									<a href="/socialNetwork/index.php/movie/view/'.$califications[$indice]['id_movie'].'" style="cursor:pointer;"><img class="minifotomovie" id='.$califications[$indice]['id_movie'].' src="'.$califications[$indice]['thumbnail'].'"></img></a>
								</div>
								<ul class="meta2" style="padding: 5px;min-height: 85px;">';
							echo '<img class="minifotoreco" id='.$califications[$indice]['from'].' style="margin-top: -3px; float:left" src="'.$califications[$indice]['photo'].'"></img>';
							echo '<li> <strong><a style="font-weight:bold; color:#666666;" href="/socialNetwork/index.php/user/profile/'.$califications[$indice]['id_from'].'">'.$califications[$indice]['from'].'</a></strong> said to <a style="font-weight:bold; color:#888888;" href="/socialNetwork/index.php/user/profile/'.$califications[$indice]['id_to'].'">'.$califications[$indice]['to'].'</a>:</li>	
								  <li style="font-size:12px;"> '.$califications[$indice]['msg'].'</li>
							  </ul>
						  </div>';
					}
				  echo '</div>
			  </div>';
		$indice = $indice + 3;
	}
	echo '</div>';
}?>
<div id="blob" class="blob r" style="display: none;">
	<b><div class="name"></div></b>
	<div class="friends"></div>
	<div class="sep"></div>
	<div class="info">
		<b>Last viewed: </b>
		<div class="saw"></div>
	</div>
	<div class="sep"></div>
	<div class="info2">
		<b>To see soon: </b>
		<div class="to_view"></div>
	</div>
</div>

<div id="blobmovie" class="blob r movie" style="display: none;">
	<div class="tit"></div>
	<div <span class="cantidad"></span></div>
	<div class="txt"></div>
	<div class="sep"></div>

	<b>Stars:</b> 
	<div class="info">
		<div class="reparto"></div>
	</div>
	<b>Director:</b> 
	<div class="info2">
		<div class="director"></div>
	</div>
	<div class="sep"></div>
	<div class="info2">
		<ul class="box">
			<li>
				<span class="genero num"></span>
				<span class="labl">Genre</span>
			</li>
			<li>
				<span class="calification num"></span>
				<span class="labl">Calification</span>
			</li>
			<li>
				<span class="ano num"></span>
				<span class="labl">Year</span>
			</li>
		</ul>
	</div>
</div>