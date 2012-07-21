<?php 
list ($title, $sinopsis, $year, $calification, $image, $thumbnail) = $this->Movie_model->get_movie_info($id_movie_saw);
?>
<h1 class="titulo">Have you seen the movie "<strong><?php echo $title?></strong>"? </h1><br />
<h2 class="titulo">We want your opinion!!</h2>
<?php 
$review = $this->User_model->get_review($id_movie_saw);
echo form_fieldset('',array('id' => 'contactForm', 'style' => 'margin-left:5%!important;float:left;'));
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

<div class="photo sample6" style="float:left; height:300px;">
	<span></span><img width="214px"  height="317px"  src="<?php echo $thumbnail?>"></img>
</div>

<div class="calificacion">
	<p id="msg_rate"></p>	              
	<input type="hidden" name="hidden_design_id" id="hidden_design_id" value="<?php echo $id_movie_saw?>"/>	
	  <?php if (!$this->User_model->is_logged_in()) //Check if user logged in
			{$radio_level = "disabled";}
			else
			{$radio_level = " ";}
			for($i = 1;$i <= 5;$i++){
				if ($i == round($this->User_model->get_rating($id_movie_saw)))
				{?>
					<input class="auto-submit-star" type="radio" name="rating" <?php echo "$radio_level";?> value="<?php echo $i;?>" checked="checked"/>
		 <?php	}
				else
				{   ?>
				   <input class="auto-submit-star" type="radio" name="rating" <?php echo "$radio_level";?> value="<?php echo $i;?>"/>
		<?php	}
			} //end of for
	?>
</div>

