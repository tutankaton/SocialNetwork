<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet href="/css/main.css" type="text/css" media"screen" />
		<link rel="shortcut icon" href="http://cdn3.iconfinder.com/data/icons/humano2/128x128/emblems/emblem-symbolic-link.png" />
		<meta http-equiv="="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="<?php echo $discription;?>" />
		<meta name="keywords" content="<?php echo $keyword; ?>" />
		<meta name="revisit-after" content="7 days" />
		<meta name="ROBOTS" content="all" />
		<title><?php echo $title; ?></title>
	</head>
	<body>
		<div id="container">
			<div id="nav">
				<?php $this->load->view('includes/nav'); ?>
			</div>
			<div id="content">
				<?php $this->load->view($main_content); ?>
			</div>
			<div id="footer">
				<?php $this->load->view('includes/footer'); ?>
			</div>
		</div>	
	</body>	
</html>