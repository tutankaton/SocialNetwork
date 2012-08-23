
<!DOCTYPE  html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="<?php echo $discription; ?>" />
		<meta name="keywords" content="<?php echo $keyword; ?>" />
		<meta name="revisit-after" content="7 days" />
		<meta name="ROBOTS" content="all" />
		<title><?php echo $title; ?></title>
		
		<link rel="shortcut icon" href="/socialNetwork/img/favicon.png" type="image/x-icon" /> 
		
		<!-- CSS -->
		<link rel="stylesheet" href="/socialNetwork/css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="/socialNetwork/css/social-icons.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="/socialNetwork/jquery-ui-1.8.21.custom/css/ui-lightness/jquery-ui-1.8.21.custom.css">
				
		<!-- GOOGLE FONTS -->
		<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>		
		<link href='http://fonts.googleapis.com/css?family=Luckiest+Guy:regular' rel='stylesheet' type='text/css'>
		
		<!-- JS -->
		<script type="text/javascript" src="/socialNetwork/js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="/socialNetwork/js/jquery-ui-1.8.13.custom.min.js"></script>
		<script type="text/javascript" src="/socialNetwork/js/easing.js"></script>
		<script type="text/javascript" src="/socialNetwork/js/jquery.scrollTo-1.4.2-min.js"></script>
		<script type="text/javascript" src="/socialNetwork/js/quicksand.js"></script>
		<script type="text/javascript" src="/socialNetwork/js/jquery.cycle.all.js"></script>
		<script type="text/javascript" src="/socialNetwork/js/custom.js"></script>
		<script type="text/javascript" src="/socialNetwork/js/jquery.confirm/jquery.confirm.js"></script>
		<script type="text/javascript" src="/socialNetwork/js/jquery.rating.js"></script>
		
		<link rel="stylesheet" href="/socialNetwork/css/jquery.rating.css" type="text/css" media="screen" />
		
		<!-- Nivo slider -->
		<link rel="stylesheet" href="/socialNetwork/css/nivo-slider.css" type="text/css" media="screen" />
		<script src="/socialNetwork/js/nivo-slider/jquery.nivo.slider.js" type="text/javascript"></script>
		<!-- ENDS Nivo slider -->
		
		<!-- tabs -->
		<link rel="stylesheet" href="/socialNetwork/css/tabs.css" type="text/css" media="screen" />
		<script type="text/javascript" src="/socialNetwork/js/tabs.js"></script>
  		<!-- ENDS tabs -->
  		
  		<!-- prettyPhoto -->
		<script type="text/javascript" src="/socialNetwork/js/prettyPhoto/js/jquery.prettyPhoto.js"></script>
		<link rel="stylesheet" href="/socialNetwork/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen" />
		<!-- ENDS prettyPhoto -->
		
		<!-- superfish -->
		<link rel="stylesheet" media="screen" href="/socialNetwork/css/superfish.css" /> 
		<script type="text/javascript" src="/socialNetwork/js/superfish-1.4.8/js/hoverIntent.js"></script>
		<script type="text/javascript" src="/socialNetwork/js/superfish-1.4.8/js/superfish.js"></script>
		<script type="text/javascript" src="/socialNetwork/js/superfish-1.4.8/js/supersubs.js"></script>
		<!-- ENDS superfish -->
		
		<!-- poshytip -->
		<link rel="stylesheet" href="/socialNetwork/js/poshytip-1.0/src/tip-twitter/tip-twitter.css" type="text/css" />
		<link rel="stylesheet" href="/socialNetwork/js/poshytip-1.0/src/tip-yellowsimple/tip-yellowsimple.css" type="text/css" />
		<script type="text/javascript" src="/socialNetwork/js/poshytip-1.0/src/jquery.poshytip.min.js"></script>
		<!-- ENDS poshytip -->
		
		<!-- Fancybox -->
		<link rel="stylesheet" href="/socialNetwork/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
		<script type="text/javascript" src="/socialNetwork/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
		<!-- ENDS Fancybox -->
		
		<!-- SKIN -->
		<link rel="stylesheet" href="/socialNetwork/skins/plastic/style.css" type="text/css" media="screen" />
		
		<link href='http://fonts.googleapis.com/css?family=Cuprum&subset=latin' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="/socialNetwork/css/jquery.confirm/jquery.confirm.css" />
			

	</head>
	
	<body class="home">
	
	
		<!-- WRAPPER -->
		<div id="wrapper">
			
			<!-- HEADER -->
			<div id="header">
				<a href="index.html"><img id="logo" src="/socialNetwork/img/logo.png" alt="Nova" /></a>

				<div id="social-holder">
					<ul class="social">
						<?php 
						$this->load->model('User_model');
						if(get_cookie('cinefilos') && !$this->User_model->is_logged_in()){
							$this->User_model->get_sess_from_cookie();
						}elseif(!$this->User_model->is_logged_in() || $this->User_model->is_logged_in() != TRUE){
							$this->load->view('user/login');
						}
						if($this->User_model->is_logged_in()){
								$this->User_model->update_online_status();
								echo 'Welcome <div style="color:green; display:inline; font-size:16px;">'.$this->session->userdata('username').'</div>, ';
								echo anchor('logout', 'Logout', array('class' => 'loginoptions'));
								if($this->User_model->get_photo()==NULL)
									echo '<div style="padding-left:60%"><img width="60px" src="/socialNetwork/img/dummies/avatar.jpg"></img></div>';
								else 
									echo '<div style="padding-left:60%"><img width="60px" src="'.$this->User_model->get_photo().'"></img></div>';
						}
						  ?>
					</ul>
				</div>
				<!-- ENDS Social -->
				
				<!-- Navigation -->
				<ul id="nav" class="sf-menu">
					<li class="current-menu-item"><a href="/socialNetwork/">HOME</a></li>
					<?php 
						$this->load->model('User_model');
						if(get_cookie('cinefilos') && !$this->User_model->is_logged_in()){
							$this->User_model->get_sess_from_cookie();
						}
						if($this->User_model->is_logged_in()){

								echo '<li><a href="/socialNetwork/index.php/user/friends">MY FRIENDS</a></li>';
								echo '<li><a href="/socialNetwork/index.php/user/account">MY ACCOUNT</a></li>';
								echo '<li><a href="/socialNetwork/index.php/user/recommendations">RECOMMENDATIONS'.nbs(3).'<li class="current-menu-item" style="left:-20px;">('.$this->User_model->search_new_recommendations_count().')</a></li></li>';

						}
						  ?>
				</ul>
				<!-- Navigation -->	
				
				
				<!-- search movies-->
				<div class="top-search">
					<form  method="get" id="searchform" action="/socialNetwork/index.php/movie/search_movies">
						<div>
							<input type="text" value="Search movies..." name="s" id="s" onfocus="defaultInputm(this)" onblur="clearInputm(this)" />
							<input type="submit" id="searchsubmit" value=" " />
						</div>
					</form>
				</div>
				<!-- ENDS search movies-->
				<!-- search friends-->
				<?php 
					$this->load->model('User_model');
					if(get_cookie('cinefilos') && !$this->User_model->is_logged_in()){
						$this->User_model->get_sess_from_cookie();
					}
					if($this->User_model->is_logged_in()){

							echo '<div class="search-friends">
									<form  method="get" id="searchformfriends" action="/socialNetwork/index.php/user/search_friends">
										<div>
											<input type="text" value="Search friends..." name="s" id="s" onfocus="defaultInput(this)" onblur="clearInput(this)" />
											<input type="submit" id="searchsubmit" value=" " />
										</div>
									</form>
								</div>';

					}
				?>
				
			</div>
			<!-- ENDS HEADER -->
			
			<!-- MAIN -->
			<div id="main">
				
				<!-- content -->
				<div id="content">
						<!-- title -->
						<div id="page-title">
							<span class="title"><?php echo $title; ?></span>
						</div>
						<!-- ENDS title -->
					<?php $this->load->view($main_content); ?>	
	
				</div>
				<!-- ENDS content -->
	
			</div>
			<!-- ENDS MAIN -->
			
			<!-- FOOTER -->
			<div id="footer">
				
				<!-- Bottom -->
				<div id="bottom">
					developed by <a href="#">Enzo Pecorari</a> for <a href="http://cs.uns.edu.ar/~dcm/iaw/"> IAW 2012</a> 
					
					<div id="to-top" class="poshytip" title="To top"></div>
					
				</div>
				<!-- ENDS Bottom -->
			</div>
			<!-- ENDS FOOTER -->
		
		</div>
		<!-- ENDS WRAPPER -->
	
	</body>
	
</html>