<h1 class="line-divider">Results for "<?php echo $query; ?>":</h1>

<?php 
	$results = $this->User_model->search_friends($query);

	foreach ($results as $result):
		echo '<div class="line-divider" style="padding-left:10px;">';
		echo '<img style="display:inline; margin-top:30px;" width="60px" class="cuadrada" src="'.$result['photo'].'"></img>';
		echo '<h4 style="display:inline;">  '.$result['username'].'</h4>';		
		if($this->User_model->is_friend($result['id']))
			echo '<a href="/socialNetwork/index.php/user/delete_friendship/'.$result['id'].'" title="Delete friendship"><div class="del-friend"></div></a>';
		else 
			echo '<a href="/socialNetwork/index.php/user/add_friendship/'.$result['id'].'" title="Add friend"><div class="add-friend"></div></a>';
		echo '<a href="/socialNetwork/index.php/user/profile/'.$result['id'].'" title="View profile"><div class="view-profile"></div></a>';
		echo '</div>';
	endforeach;
?>