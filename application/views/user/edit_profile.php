<?php
$info = $this->User_model->info_profile($this->session->userdata('id'));
echo form_fieldset('',array('id' => 'contactForm'));
echo '<br>';
echo form_open('user/edit_account');

echo form_label('Username :', 'username');

echo form_input('username', $info['username']);

echo form_label('From :','from');

echo form_input('from', $info['from']);

echo form_label('Ocupation :','ocupation');

echo form_input('ocupation', $info['ocupation']);

echo form_label('Language :','language');

echo form_input('language', $info['language']);

echo form_label('Relationship status :','relationship_status');

echo form_input('relationship_status', $info['relationship_status']);

echo form_label('About you :','about');

echo form_textarea('about', $info['about'], array('type' => 'text-area'));

echo '<br><br>';
echo form_submit('submit', 'Save');
echo form_close();
echo form_fieldset_close();
echo '<br><br>';
?>
