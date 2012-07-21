
<!DOCTYPE  html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="<?php echo $discription; ?>" />
		<meta name="keywords" content="<?php echo $keyword; ?>" />
		<meta name="revisit-after" content="7 days" />
		<meta name="ROBOTS" content="all" />
		<title><?php echo $title; ?></title>
		
		<!-- CSS -->
		<link rel="stylesheet" href="/socialNetwork/css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="/socialNetwork/css/social-icons.css" type="text/css" media="screen" />
		<!--[if IE 8]>
			<link rel="stylesheet" type="text/css" media="screen" href="/css/ie8-hacks.css" />
		<![endif]-->
		<!-- ENDS CSS -->	
				
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
		<!--[if IE]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		<!--[if IE 6]>
			<script type="text/javascript" src="js/DD_belatedPNG.js"></script>
			<script>
	      		/* EXAMPLE */
	      		//DD_belatedPNG.fix('*');
	    	</script>
		<![endif]-->
		<!-- ENDS JS -->
		
		
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
		
		<!-- Tweet -->
		<script src="/socialNetwork/js/tweet/jquery.tweet.js" type="text/javascript"></script> 
		<!-- ENDS Tweet -->
		
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
				<!-- Social 
				<div id="social-holder">
					<ul class="social">
						<li><a href="http://www.facebook.com" class="poshytip facebook" title="Become a fan"></a></li>
						<li><a href="http://www.twitter.com" class="poshytip twitter" title="Follow our tweets"></a></li>
						<li><a href="http://www.dribbble.com" class="poshytip dribbble" title="View our work"></a></li>
						<li><a href="http://www.addthis.com" class="poshytip addthis" title="Tell everybody"></a></li>
						<li><a href="http://www.vimeo.com" class="poshytip vimeo" title="View our videos"></a></li>
						<li><a href="http://www.youtube.com" class="poshytip youtube" title="View our videos"></a></li>
					</ul>
				</div>-->
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
							if(!$this->User_model->check_user_level()){
								redirect('verify');
							}else{
								$this->User_model->update_online_status();
								echo 'Welcome <div style="color:green; display:inline; font-size:16px;">'.$this->session->userdata('username').'</div>, ';
								echo anchor('logout', 'Logout', array('class' => 'loginoptions'));
								if($this->User_model->get_photo()==NULL)
									echo '<div style="padding-left:60%"><img width="60px" src="/socialNetwork/img/dummies/avatar.jpg"></img></div>';
								else 
									echo '<div style="padding-left:60%"><img width="60px" src="'.$this->User_model->get_photo().'"></img></div>';
							}
						}
						  ?>
					</ul>
				</div>
				<!-- ENDS Social -->
				
				<!-- Navigation -->
				<ul id="nav" class="sf-menu">
					<li class="current-menu-item"><a href="index.html">HOME</a></li>
					<li><a href="features.html">FEATURES</a>
						<ul>
							<li><a href="features-appearance.html"><span> Appearance</span></a></li>
							<li><a href="features-columns.html"><span> Columns layout</span></a></li>
							<li><a href="features-accordion.html"><span> Accordion</span></a></li>
							<li><a href="features-toggle.html"><span> Toggle box</span></a></li>
							<li><a href="features-tabs.html"><span> Tabs</span></a></li>
							<li><a href="features-infobox.html"><span> Text box</span></a></li>
							<li><a href="features-monobox.html"><span> Icons</span></a></li>
						</ul>
					</li>
					<li><a href="blog.html">BLOG</a></li>
					<li><a href="portfolio.html">PORTFOLIO</a></li>
					<li><a href="gallery.html">GALLERY</a>
						<ul>
							<li><a href="gallery.html"><span> Four columns </span></a></li>
							<li><a href="gallery-3.html"><span> Three columns </span></a></li>
							<li><a href="gallery-2.html"><span> Two columns </span></a></li>
							<li><a href="video-gallery.html"><span> Video gallery </span></a></li>
						</ul>
					</li>
					<li><a href="http://luiszuno.com/blog/downloads/shinra-html-template">DOWNLOAD</a></li>
					<?php 
						$this->load->model('User_model');
						if(get_cookie('cinefilos') && !$this->User_model->is_logged_in()){
							$this->User_model->get_sess_from_cookie();
						}
						if($this->User_model->is_logged_in()){
							if(!$this->User_model->check_user_level()){
								redirect('verify');
							}else{
								echo '<li><a href="/socialNetwork/index.php/user/account">MY ACCOUNT</a></li>';
								}
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
						if(!$this->User_model->check_user_level()){
							redirect('verify');
						}else{
							echo '<div class="search-friends">
									<form  method="get" id="searchformfriends" action="/socialNetwork/index.php/user/search_friends">
										<div>
											<input type="text" value="Search friends..." name="s" id="s" onfocus="defaultInput(this)" onblur="clearInput(this)" />
											<input type="submit" id="searchsubmit" value=" " />
										</div>
									</form>
								</div>';
							}
					}
				?>
				<!-- ENDS search friends-->
				<!-- headline 
				<div id="headline">
					Shinra is a free template with more than 5 page layouts, jQuery functionality and its fully documented. <a href="http://luiszuno.com/blog/downloads/shinra-html-template">Download it now</a>
				</div>
				<!-- ENDS headline -->
				
				<!-- Slider 
			<div id="slider-block">
				<div id="slider-holder">
					<div id="slider">
						<a href="http://www.luiszuno.com"><img src="images/01.jpg" title="Visit my web site regularly and get freebies each week!" alt="" /></a>
						<a href="http://themeforest.net/user/Ansimuz/portfolio?ref=ansimuz"><img src="images/02.jpg" title="Support the freebies buying high quality premium themes from my portfolio at themeforest" alt="" /></a>
					</div>
				</div>
			</div>
			<!-- ENDS Slider -->
				
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
						<!-- TABS -->
						<!-- the tabs 
						<ul class="tabs">
							<li><a href="#">Featured Pages</a></li>
							<li><a href="#">Recent posts</a></li>
							<li><a href="#">Information</a></li>
							<li><a href="#">Tab four</a></li>
							<li><a href="#">Last tab</a></li>
						</ul>
						
						<!-- tab "panes" 
						<div class="panes">
						
							<!-- Posts 
							<div>
								<ul class="blocks-thumbs thumbs-rollover">
									<li>
										<a href="#" class="thumb" title="An image"><img src="img/dummies/282x150.gif" alt="Post" /></a>
										<div>
											<a href="#" class="header">Lorem ipsum dolor</a>
											Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. ultricies eget, tempor sit amet, ante. Mauris placerat eleifend leo.
										</div>
										<a href="single.html">Read more &#8594;</a>
									</li>
									<li>
										<a href="#" class="thumb" title="An image"><img src="img/dummies/282x150.gif" alt="Post" /></a>
										<div>
											<a href="#" class="header">Lorem ipsum dolor</a>
											Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. ultricies eget, tempor sit amet, ante. Mauris placerat eleifend leo.
										</div>
										<a href="single.html">Read more &#8594;</a>
									</li>
									<li>
										<a href="#" class="thumb" title="An image"><img src="img/dummies/282x150.gif" alt="Post" /></a>
										<div>
											<a href="#" class="header">Lorem ipsum dolor</a>
											Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. ultricies eget, tempor sit amet, ante. Mauris placerat eleifend leo.
										</div>
										<a href="single.html">Read more &#8594;</a>
									</li>
									<li>
										<a href="#" class="thumb" title="An image"><img src="img/dummies/282x150.gif" alt="Post" /></a>
										<div>
											<a href="#" class="header">Lorem ipsum dolor</a>
											Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. ultricies eget, tempor sit amet, ante. Mauris placerat eleifend leo.
										</div>
										<a href="single.html">Read more &#8594;</a>
									</li>
									<li>
										<a href="#" class="thumb" title="An image"><img src="img/dummies/282x150.gif" alt="Post" /></a>
										<div>
											<a href="#" class="header">Lorem ipsum dolor</a>
											Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. ultricies eget, tempor sit amet, ante. Mauris placerat eleifend leo.
										</div>
										<a href="single.html">Read more &#8594;</a>
									</li>
									<li>
										<a href="#" class="thumb" title="An image"><img src="img/dummies/282x150.gif" alt="Post" /></a>
										<div>
											<a href="#" class="header">Lorem ipsum dolor</a>
											Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. ultricies eget, tempor sit amet, ante. Mauris placerat eleifend leo.
										</div>
										<a href="single.html">Read more &#8594;</a>
									</li>
								</ul>
							</div>
							<!-- ENDS posts -->
							
							<!-- Posts 
							<div>
								<ul class="blocks-thumbs thumbs-rollover">
									<li>
										<a href="#" class="thumb" title="An image"><img src="img/dummies/282x150.gif" alt="Post" /></a>
										<div>
											<a href="#" class="header">Lorem ipsum dolor</a>
											Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. ultricies eget, tempor sit amet, ante. Mauris placerat eleifend leo.
										</div>
										<a href="single.html">Read more &#8594;</a>
									</li>
									<li>
										<a href="#" class="thumb" title="An image"><img src="img/dummies/282x150.gif" alt="Post" /></a>
										<div>
											<a href="#" class="header">Lorem ipsum dolor</a>
											Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. ultricies eget, tempor sit amet, ante. Mauris placerat eleifend leo.
										</div>
										<a href="single.html">Read more &#8594;</a>
									</li>
									<li>
										<a href="#" class="thumb" title="An image"><img src="img/dummies/282x150.gif" alt="Post" /></a>
										<div>
											<a href="#" class="header">Lorem ipsum dolor</a>
											Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. ultricies eget, tempor sit amet, ante. Mauris placerat eleifend leo.
										</div>
										<a href="single.html">Read more &#8594;</a>
									</li>
									<li>
										<a href="#" class="thumb" title="An image"><img src="img/dummies/282x150.gif" alt="Post" /></a>
										<div>
											<a href="#" class="header">Lorem ipsum dolor</a>
											Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. ultricies eget, tempor sit amet, ante. Mauris placerat eleifend leo.
										</div>
										<a href="single.html">Read more &#8594;</a>
									</li>
									<li>
										<a href="#" class="thumb" title="An image"><img src="img/dummies/282x150.gif" alt="Post" /></a>
										<div>
											<a href="#" class="header">Lorem ipsum dolor</a>
											Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. ultricies eget, tempor sit amet, ante. Mauris placerat eleifend leo.
										</div>
										<a href="single.html">Read more &#8594;</a>
									</li>
									<li>
										<a href="#" class="thumb" title="An image"><img src="img/dummies/282x150.gif" alt="Post" /></a>
										<div>
											<a href="#" class="header">Lorem ipsum dolor</a>
											Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. ultricies eget, tempor sit amet, ante. Mauris placerat eleifend leo.
										</div>
										<a href="single.html">Read more &#8594;</a>
									</li>
								</ul>
							</div>
							<!-- ENDS posts -->
							
							<!-- Information  
							<div>
								<div class="plain-text">
									<h6>Pellentesque habitant morbi tristique senectus et netus et malesuada.</h6> 
									<p>Fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus. <a href="#">This is a link</a></p>
									<p>Fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.Fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus. </p>
								</div>
							</div>
							<!-- ENDS Information -->
							
							<!-- Information  
							<div>
								<div class="plain-text">
									<h6>Pellentesque habitant morbi tristique senectus et netus et malesuada.</h6> 
									<p>Fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus. <a href="#">This is a link</a></p>
									<p>Fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.Fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus. </p>
								</div>
							</div>
							<!-- ENDS Information 
							
							<!-- Information 
							<div>
								<div class="plain-text">
									<h6>Pellentesque habitant morbi tristique senectus et netus et malesuada.</h6> 
									<p>Fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus. <a href="#">This is a link</a></p>
									<p>Fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.Fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus. </p>
								</div>
							</div>
							<!-- ENDS Information 
							
						</div>
						<!-- ENDS TABS -->
	
	
	
				</div>
				<!-- ENDS content -->
				
				<!-- Twitter 
				<div id="twitter">
					<a href="#" id="prev-tweet"></a>
					<a href="#" id="next-tweet"></a>
					<div id="tweets">
						<ul class="tweet_list"></ul>
					</div>
				</div>
				<!-- ENDS Twitter -->
	
	
			</div>
			<!-- ENDS MAIN -->
			
			<!-- FOOTER -->
			<div id="footer">
				
				<!-- footer-cols 
				<ul id="footer-cols">
					<li class="col">
						<h6>About the theme</h6>
						Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.
					</li>
					<li class="col">
						<h6>Categories</h6>
						<ul>
							<li><a href="#">Webdesign</a></li>
							<li><a href="#/">Wordpress</a></li>
							<li><a href="#">Photo</a></li>
							<li><a href="#">Code</a></li>
							<li><a href="#">Web design</a></li>
							<li><a href="#/">Marketplace</a></li>
							<li><a href="#">Writting</a></li>
							<li><a href="#">Drawings</a></li>
						</ul>
					</li>
					<li class="col">
						<h6>Categories</h6>
						<ul>
							<li><a href="#">Webdesign</a></li>
							<li><a href="#/">Wordpress</a></li>
							<li><a href="#">Photo</a></li>
							<li><a href="#">Code</a></li>
							<li><a href="#">Web design</a></li>
							<li><a href="#/">Marketplace</a></li>
							<li><a href="#">Writting</a></li>
							<li><a href="#">Drawings</a></li>
						</ul>
					</li>
				</ul>
				<!-- ENDS footer-cols -->
				
				<!-- Bottom -->
				<div id="bottom">
					<a href="http://luiszuno.com/blog/downloads/shinra-html-template" >Shinra</a> is a Free Template by <a href="http://www.luiszuno.com"> Luiszuno</a> 
					
					<div id="to-top" class="poshytip" title="To top"></div>
					
				</div>
				<!-- ENDS Bottom -->
			</div>
			<!-- ENDS FOOTER -->
		
		</div>
		<!-- ENDS WRAPPER -->
	
	</body>
	
</html>