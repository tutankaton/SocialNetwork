<?php 


	foreach ($results as $result):
		echo '<div class="line-divider" style="padding-left:10px;">';
		echo '<a style="text-decoration:none!important;" href="/socialNetwork/index.php/user/profile/'.$result['id_friend'].'" title="View profile"><img style="display:inline; margin-top:30px;" width="60px" class="cuadrada" src="'.$result['photo'].'"></img>';
		echo '<h1 style="display:inline;color:#666666;">  '.$result['username'].'</h1></a>';	
		echo '<a href="/socialNetwork/index.php/user/delete_friendship/'.$result['id_friend'].'" title="Delete friendship"><div class="del-friend"></div></a>';	
		echo '<a href="/socialNetwork/index.php/user/profile/'.$result['id_friend'].'" title="View profile"><div  class="view-profile"></div></a>';
		echo '</div>';
	endforeach;
	
 echo $links;
	
?>