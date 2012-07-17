<br><br>
<div class="center">
	<?php
		echo form_fieldset('New Password');
		echo '<ul class="errors">';
		$this->form_validation->set_error_delimiters('<li>','</li>');
		echo validation_errors();
		echo '</ul>';
		echo form_open('user/new_password');
		echo 'Welcome '.$username;
		echo '<br><br>';
		echo form_hidden('id', $id);
		echo form_hidden('temp_password',$temp_password);
		echo '<table>';
		echo '<tr><td class="right">';
		echo form_label('Password :','password');
		echo '</td><td>';
		echo form_password('password');
		echo '</td></tr>';
		echo '<tr><td class="right">';
		echo form_label('Confirm :<br>Password','password2');
		echo '</td><td>';
		echo form_password('password2');
		echo '</td></tr></table>';
		echo form_submit('submit', 'Reset Password');
		echo form_close();
		echo form_fieldset_close();		
	?>	
</div>
<br><br>