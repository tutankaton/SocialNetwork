<h1 class="line-divider">Results for "<?php echo $query; ?>":</h1>

<?php 
	$results = $this->Movie_model->search_movies($query);

	foreach ($results as $result):
		echo '<div class="line-divider" style="padding-left:10px;">';
		echo '<img style="display:inline;" width="80px" class="rectangular" src="'.$result['thumbnail'].'"></img>';
		echo '<h4 style="display:inline;">  '.$result['title'].'</h4>';
		echo '</div>';
	endforeach;
?>