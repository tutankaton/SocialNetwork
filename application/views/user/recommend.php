<script type="text/javascript">
$(document).ready(function(){
	$.ajax({         type: "post",
                     url: "/socialNetwork/index.php/user/autocomplete_friends",
                     dataType: "json",
                     data: {} ,
              success: function(data) {
                   $('#tags').autocomplete({
                   	source:data,
                   	});
              }
              });
});
</script>
<?php 
list ($title, $sinopsis, $year, $calification, $image, $thumbnail) = $this->Movie_model->get_movie_info($id_movie);?>
<h1 class="titulo">Have you seen the movie "<strong><?php echo $title?></strong>"? </h1><br />
<h2 class="titulo">Recommend to a friend!!</h2>
<?php 
echo form_fieldset('',array('id' => 'contactForm', 'style' => 'margin-left:5%!important;float:left;'));
echo '<br>';
echo form_open('user/recommendation/'.$id_movie);
echo '<div class="autocomp"><div class="ui-widget">';
echo '<label for="tags">Recommend to: </label>';
echo '<input name="to" id="tags">';
echo '</div></div>';
echo form_label('Message :','message');
echo form_textarea('message', '', array('type' => 'text-area'));
echo '<br><br>';
echo '<input style="display:none" id="oculto"></input>';
echo form_submit('submit', 'Recommend');
echo form_close();
echo form_fieldset_close();
echo '<br><br>';
?>

<div class="photo sample6" style="float:left; height:300px;">
	<span></span><img width="214px"  height="317px"  src="<?php echo $thumbnail?>"></img>
</div>