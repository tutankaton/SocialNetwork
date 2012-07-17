<?php 
echo '<div>';
echo form_fieldset('');/*
echo '<div style="color:red!important;">';
$this->form_validation->set_error_delimiters('<div>','</div>');
echo validation_errors();
if(isset($login_error) && $login_error){
	echo '<div>'.$login_error.'</div>';
}
echo '</div>';*/

$this->form_validation->set_error_delimiters('<div style="color:red!important;">','</div>');
echo '<div>'.form_error('username').'</div>';
echo '<div>'.form_error('password').'</div>';
if(isset($login_error) && $login_error){
	echo '<div style="color:red!important;">'.$login_error.'</div>';
}
echo '</div>';
echo form_open('user/validate_login');

echo '<div style="color: #BDBDBD;">';
echo form_label('Username: ','username');
echo form_input('username');
echo '</div>';

echo '<div style="margin-left:3px; color: #BDBDBD;">';
echo form_label('Password:&nbsp','password');
echo form_password('password');
echo '</div>';

echo anchor('user/forgot_password', 'Forgot your password?', array('class' => 'loginoptions'));
echo anchor('user/registration', 'Sign Up',array('class' => 'loginoptions'));

echo '<div style="margin-top:5px;margin-left:20px;">';
echo form_checkbox('rember_me','accept',False).'Remember Me&nbsp&nbsp&nbsp';

echo form_submit('submit','Login', 'id="botonLogin"');

echo form_close();
echo form_fieldset_close();

echo '</div>';
?>