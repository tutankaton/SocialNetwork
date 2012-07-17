<br><br><br><br><div class="center">
	You must click on the url supplied in the Email to gain access to this site
	<br>or
<?php
	echo form_open('user/resend_email');
	echo form_submit('submit', 'Click here to resend email');
	echo form_close();
?>	
<br><br><br><br></div>
