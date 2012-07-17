<?php


echo form_fieldset('',array('id' => 'contactForm'));
$this->form_validation->set_error_delimiters('<div>','</div>');
echo validation_errors();
echo '<br><br>';
echo form_open('user/create_member');

echo form_label('First Name :', 'first_name');

echo form_input('first_name', set_value('first_name'),array('class' => 'campo'));

echo form_label('Last Name :','last_name');

echo form_input('last_name', set_value('last_name'));

echo form_label('Email Address :','email_address');

echo form_input('email_address', set_value('email_address'));

echo form_label('Username :','username');

echo form_input('username', set_value('username'), 'id="username"');


echo '<br />Sex :<div>';
echo form_label('Male', 'male');
echo form_radio('sex', 'm',TRUE);

echo form_label('Female', 'female');
echo form_radio('sex', 'f',TRUE);



echo form_label('Date of Birth :', 'month');

echo form_dropdown('month',$month,'1');
echo form_dropdown('day',$day,'1');
echo form_dropdown('year',$year);

echo form_label('Password :','password');

echo form_password('password', set_value('password'));

echo form_label('Confirm password:','password2');

echo form_password('password2', set_value('password2'));

//código del captcha
$data = array(
		'captcha_time' => $cap['time'],
		'ip_address' => $this->input->ip_address(),
		'word' => $cap['word']
		);
$query = $this->db->insert_string('captcha', $data);
$this->db->query($query);

echo '<br><br>';
echo '<div style="font-size=25;">'.$cap['image'].'</div>';
echo 'Submit the letters toy see above<br>';
echo form_input('captcha');
echo '<br><br>';
echo form_submit('submit', 'Create Account');
echo form_close();
echo form_fieldset_close();
echo '<br><br>';
?>

