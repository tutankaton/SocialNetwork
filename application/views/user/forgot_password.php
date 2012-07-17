<?php
echo '<br><br>';
echo form_fieldset('',array('id' => 'contactForm'));
$this->form_validation->set_error_delimiters('<div>','</div>');
echo validation_errors();
echo form_open('user/password_recovery');
echo '<div>';
echo '<h3>Please enter your email address <br>to reset your password</div><br></h3>';
echo form_label('Email Address ');
echo form_input('email_address', set_value('email_address'));
echo '<br><br>';
echo '<div class="center">';
echo form_submit('submit', 'Reset Password');
echo '</div>';
echo form_close();
echo form_fieldset_close();
echo '<br><br>';
?>