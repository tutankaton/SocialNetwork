<?php 
list ($title, $sinopsis, $year, $calification, $image, $thumbnail) = $this->Movie_model->get_movie_info($id_movie_saw);
?>
<h1 class="titulo">Have you seen the movie "<strong><?php echo $title?></strong>"? </h1><br />
<h2 class="titulo">We want your opinion!!</h2>
<div class="photo sample6" style="float:left; height:300px;">
	<span></span><img width="214px"  height="317px"  src="<?php echo $thumbnail?>"></img>
</div>
<?php 
$review = $this->User_model->get_review($id_movie_saw);
echo form_fieldset('',array('id' => 'contactForm', 'style' => 'margin-left:5%!important;'));
echo '<br>';
echo form_open('user/review/'.$id_movie_saw);
echo form_label('Review :','review');
echo form_textarea('review', $review, array('type' => 'text-area'));
echo '<br><br>';
echo form_submit('submit', 'Send');
echo form_close();
echo form_fieldset_close();
echo '<br><br>';
?>