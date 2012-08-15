

<?php 
	if(count($results)>0){
		foreach ($results as $result):
			echo '<div class="line-divider" style="padding-left:10px;padding-top: 7px; min-height: 75px;">
				<a href="/socialNetwork/index.php/movie/view/'.$result['id_movie'].'" style="cursor:pointer;"><img class="microfotomoviereco" id='.$result['id_movie'].' src="'.$result['thumbnail'].'"></img></a>
				<b><a style="text-decoration:none;" href="/socialNetwork/index.php/user/profile/'.$result["id_friend"].'">'.$result["username"].'</a></b> recommend you <b><a style="text-decoration:none;" href="/socialNetwork/index.php/movie/view/'.$result["id_movie"].'">'.$result["title"].'</a></b>
				<div  class="message_reco"><i><hr><span>'.$result["message"].'</span></i></div>
				<a class="like" title="like" href="/socialNetwork/index.php/user/like_reco/'.$result['id'].'/'.$result['id_movie'].'/'.$result['id_friend'].'"></a>
				<a class="dislike" title="dislike" href="/socialNetwork/index.php/user/dislike_reco/'.$result['id'].'/'.$result['id_movie'].'/'.$result['id_friend'].'"></a>
				<a class="ignore" title="ignore" href="/socialNetwork/index.php/user/ignore_reco/'.$result['id'].'"></a>

			</div>';
		endforeach;		
		echo $links;
	}else{
		echo '<h1 class="line-divid">Not found recommendations</h1>';
	}
?>
