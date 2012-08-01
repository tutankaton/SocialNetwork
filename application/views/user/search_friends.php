<h1 class="line-divid">Results for "<?php echo $query; ?>":</h1>

<?php 

	foreach ($results as $result):
		echo '<div class="line-divider" style="padding-left:10px;">';
		echo '<a style="text-decoration:none!important;" href="/socialNetwork/index.php/user/profile/'.$result['id'].'" title="View profile"><img style="display:inline; margin-top:30px;" width="60px" class="cuadrada" src="'.$result['photo'].'"></img>';
		echo '<h1 style="display:inline;color:#666666;">  '.$result['username'].'</h1></a>';		
		if($this->User_model->is_friend($result['id']))
			echo '<a href="/socialNetwork/index.php/user/delete_friendship/'.$result['id'].'" title="Delete friendship"><div class="del-friend"></div></a>';
		else 
			echo '<a href="/socialNetwork/index.php/user/add_friendship/'.$result['id'].'" title="Add friend"><div class="add-friend"></div></a>';
		echo '<a href="/socialNetwork/index.php/user/profile/'.$result['id'].'" title="View profile"><div class="view-profile"></div></a>';
		echo '</div>';
	endforeach;
	
	 echo $links;
?>