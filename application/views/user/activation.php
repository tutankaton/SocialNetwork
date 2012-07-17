<?php 
echo '<div class="center">';
	$this->form_validation->set_error_delimiters('<div style="color:red!important;">','</div>');
	echo '<div>'.form_error('username').'</div>';
	echo '<div>'.form_error('password').'</div>';
	if(isset($activation_error) && $activation_error){
		echo '<div style="color:red!important;"><h3>'.$activation_error.'</h3></div>';
	}
echo '</div>';
