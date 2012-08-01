<h1 class="line-divid">Results for "<?php echo $query; ?>":</h1>

<?php 
	foreach ($results as $result):
		echo '<div class="line-divider" style="padding-left:10px;">';
		echo '<a style="text-decoration:none!important;" href="/socialNetwork/index.php/movie/view/'.$result['id'].'" title="View"><img style="display:inline; margin-bottom:-20px;padding-top:10px;" width="80px" class="rectangular" src="'.$result['thumbnail'].'"></img>';
		echo '<h4 style="display:inline;color:#666666;">  '.$result['title'].'</h4></a>';
		if($this->User_model->is_enqueue($result['id']))
			echo '<a href="/socialNetwork/index.php/user/dequeue_movie/'.$result['id'].'" title="Dequeue to view"><div class="dequeue"></div></a>';
		else 
			echo '<a href="/socialNetwork/index.php/user/enqueue_movie/'.$result['id'].'" title="Enqueue to view"><div class="enqueue"></div></a>';	
		echo '</div>';
	endforeach;
	echo $links;
?>