<div id="posts" class="single">
<?php 
if($this->User_model->is_logged_in()){

	if(!$this->User_model->check_user_level()){
		redirect('verify');
	}else{
		$this->User_model->update_online_status();		
		if($this->User_model->get_photo()==NULL)
			echo '<div class="photo sample3" style="float:left; height:300px;"><span></span><img max-width="120px" max-height="120px" src="/socialNetwork/img/dummies/avatar.jpg"></img>';
		else 
			echo '<div class="photo sample3" style="float:left; height:300px;"><span></span><img max-width="120px"  max-height="120px"  src="'.$this->User_model->get_photo().'"></img>';
		
		echo '<a  style="display:block; padding-left:20%;" href="/socialNetwork/index.php/user/change_photo" title="Add friend">change profile image</a>';
		echo '</div>';
		$info = $this->User_model->info_profile($this->session->userdata('id'));?>
			<div style="float:left;padding-left:20px; display:inline; "><h1 style="color:#333333;"><?php echo $info['username']; ?>
			</h1>
					<?php if($info['from']!=null) echo '<span>lives in: <span style="color:#666666;">'.$info['from'].'</span></span>';?>
					<span style="display:block;">birthday: <span style="color:#666666;"><?php echo $info['month']; ?>/<?php echo $info['day']; ?>/<?php echo $info['year']; ?></span></span>
					<?php if($info['ocupation']!=null) echo '<span style="display:block;">occupation: <span style="color:#666666;">'.$info['ocupation'].'</span></span>';?>
					<?php if($info['language']!=null) echo '<span style="display:block;">languages: <span style="color:#666666;">'.$info['language'].'</span></span>';?>
					<?php if($info['relationship_status']!=null) echo '<span style="display:block;">relationship status: <span style="color:#666666;">'.$info['relationship_status'].'</span></span>';?>
					<?php if($info['about']!=null) echo '<span style="display:block;">about me: <span style="color:#666666;">'.$info['about'].'</span></span>';?>
					<div style="float:left; padding-top:15px; padding-left:-5px;"><a style="text-decoration:none;display:inline;" href="/socialNetwork/index.php/user/edit_profile" title="Edit Profile"><img width="15px" src="/socialNetwork/img/mono-icons/pencil32.png"></img><span style="display:inline;">edit profile</span></a></div>
			</div>
			<div style="float:right;padding-right:20px;padding-top:0px;display:inline; ">
				<img width="20px" src="/socialNetwork/img/mono-icons/clock32.png"></img>
				<span style="display:inline;"> last active: <span style="color:#666666;"><?php echo $info['last_active']; ?>
					
				</span></span>
				<span style="display:block;"><img width="20px" src="/socialNetwork/img/mono-icons/smile32.png"></img> in the community since: <span style="color:#666666;"><?php echo $info['created_on']; ?>
					
				</span></span>
		
			</div>
			

		</div>
<?php	}
}
$list_to_view = $this->User_model->movies_to_view($this->session->userdata('id'));	?>
<!-- TABS -->
						<!-- the tabs -->
						<ul class="tabs" style="margin-top: 370px!important;">
							<li><a href="#">Movies to view</a></li>
							<li><a href="#">Top movies</a></li>
						</ul>
						<div class="panes">							
							<!-- 1| pestaña  -->
							<div>
								<div id="busqueda">
									<div class="search-back">
										<div class="search">
											<form  method="get" id="searchform" action="/socialNetwork/index.php/movie/search_recommend_movies">
												<div>
													<input type="text" value="Search movies..." name="s" id="s" onfocus="defaultInputm(this)" onblur="clearInputm(this)" />
													<input type="submit" id="searchsubmit" value=" " />
												</div>
											</form>
										</div>
									</div>
									<div style="width: 30px; float:left; height:50px;"></div>
									<?php 
									$recommends_to_view = $this->User_model->recomends_movies_to_view();
									$j = 0;
									foreach($recommends_to_view as $reco){
										if($j < 7){
											echo '<div class="column"><header>-'.$reco["id"].'</header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">';
											echo '<ul class="meta"><li><strong>'.$reco['title'].'</strong></li><li><strong>Year: </strong> '.$reco['year'].'</li> ';
											echo '<li><a href="/socialNetwork/index.php/movie/view/'.$reco["id"].'">View more</a></li>								</ul>';
											echo '<div  class="cover"><img width="120px"  height="178px"src="'.$reco["thumbnail"].'"  alt="Feature image" /></div>';
											echo '</div></div></div></div>';
											echo '</div>';
											$j++;
										}	
									}?>
								</div>
								<div id="columns-full">
								  	<div class="column" style="position:absolute!important; top:770px; left:40px;"><header><?php echo $list_to_view[0]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
																<ul class="meta"><li><strong><?php echo $list_to_view[0]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[0]['year'];?></li> 
																	<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[0]['id'];?>">View more</a></li>								</ul>
																<div  class="cover"><img width="120px"  height="178px"src="<?php echo $list_to_view[0]['thumbnail']?>"  alt="Feature image" /></div>
															</div></div></div></div>
									</div>
									<div class="column"style="position:absolute!important; top:800px; left:430px;"><header><?php echo $list_to_view[1]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
																<ul class="meta"><li><strong><?php echo $list_to_view[1]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[1]['year'];?></li> 
																	<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[1]['id'];?>">View more</a></li>								</ul>
																<div class="cover"><img width="120px"  height="178px"src="<?php echo $list_to_view[1]['thumbnail']?>"  alt="Feature image" /></div>
															</div></div></div></div>
									</div>
									<div class="column"style="position:absolute!important; top:1020px; left:130px;"><header><?php echo $list_to_view[2]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
																<ul class="meta"><li><strong><?php echo $list_to_view[2]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[2]['year'];?></li> 
																	<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[2]['id'];?>">View more</a></li>								</ul>
																<div  class="cover"><img width="120px"  height="178px"src="<?php echo $list_to_view[2]['thumbnail']?>"  alt="Feature image" /></div>
															</div></div></div></div>
									</div>
									<div class="column"style="position:absolute!important; top:1020px; left:330px;"><header><?php echo $list_to_view[3]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
																<ul class="meta"><li><strong><?php echo $list_to_view[3]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[3]['year'];?></li> 
																	<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[3]['id'];?>">View more</a></li>								</ul>
																<div  class="cover"><img width="120px" height="178px"src="<?php echo $list_to_view[3]['thumbnail']?>"  alt="Feature image" /></div>
															</div></div></div></div>
									</div>
									<div class="column"style="position:absolute!important; top:1020px; left:530px;"><header><?php echo $list_to_view[4]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
																<ul class="meta"><li><strong><?php echo $list_to_view[4]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[4]['year'];?></li> 
																	<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[4]['id'];?>">View more</a></li>								</ul>
																<div  class="cover"><img width="120px" height="178px"src="<?php echo $list_to_view[4]['thumbnail']?>"  alt="Feature image" /></div>
															</div></div></div></div>
									</div> 
									 <div class="column" style="position:absolute!important; top:1090px; left:770px;height: 150px; width: 150px;  border: 0px solid #666666;  -webkit-border-radius: 0px;  -ms-border-radius: 0px;  -moz-border-radius:0px;  border-radius: 0px;  -webkit-box-shadow: inset 0 0 0px #000;  -ms-box-shadow: inset 0 0 0px #000;  box-shadow: inset 0 0 0px #000;cursor:default;"><header>trash</header><img width="150" src="/socialNetwork/img/trash.png"  alt="Drop here to delete" />
									</div> 	
									 <div class="column" style="position:absolute!important; top:810px; left:750px;height: 150px; width: 150px;  border: 0px solid #666666;  -webkit-border-radius: 0px;  -ms-border-radius: 0px;  -moz-border-radius:0px;  border-radius: 0px;  -webkit-box-shadow: inset 0 0 0px #000;  -ms-box-shadow: inset 0 0 0px #000;  box-shadow: inset 0 0 0px #000;cursor:default;"><header>file</header><img width="150" src="/socialNetwork/img/vhs.png"  alt="Drop here if you saw it " />
									</div> 	
								 </div>
								<div class="queue_movies">
									<div class="top">
										<img src="/socialNetwork/img/top.png" width="160px"></img>
									</div>
									<div class="one">
										<img src="/socialNetwork/img/one.png" width="60px"></img>
									</div>
									<div class="two">
										<img src="/socialNetwork/img/two.png" width="100px"></img>
									</div>
									<div class="three">
										<img src="/socialNetwork/img/three.png" width="40px"></img>
									</div>
									<div class="four">
										<img src="/socialNetwork/img/four.png" width="30px"></img>
									</div>
									<div class="five">
										<img src="/socialNetwork/img/five.png" width="30px"></img>
									</div>
									<div class="text-first">
										-> The first movie I want to see
									</div>
									<div class="text-second">
										then I'd like to see ->
									</div>
									<div class="text-others">
										I have also enqueue:
									</div>
									<div class="text-trash">
										drop here if you are no longer interested in a movie ->
									</div>
									<div class="text-file">
										Drop here if you have already seen it ->
									</div>
								</div>
								
							</div>
							<!-- fin 1| pestaña -->
							
							<!-- 2| pestaña  -->
							<div>
								<div id="busqueda">
									<div class="search-back">
										<div class="search">
											<form  method="get" id="searchform" action="/socialNetwork/index.php/movie/search_recommend_movies">
												<div>
													<input type="text" value="Search movies..." name="s" id="s" onfocus="defaultInputm(this)" onblur="clearInputm(this)" />
													<input type="submit" id="searchsubmit" value=" " />
												</div>
											</form>
										</div>
									</div>
									<div style="width: 30px; float:left; height:50px;"></div>
									<?php $recommends_to_top = $this->User_model->recomends_movies_to_top();
									$j = 0;
									foreach($recommends_to_top as $reco){
										if($j < 7){
											echo '<div class="column"><header>-'.$reco["id"].'</header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">';
											echo '<ul class="meta"><li><strong>'.$reco['title'].'</strong></li><li><strong>Year: </strong> '.$reco['year'].'</li> ';
											echo '<li><a href="/socialNetwork/index.php/movie/view/'.$reco["id"].'">View more</a></li>								</ul>';
											echo '<div  class="cover"><img width="120px"  height="178px"src="'.$reco["thumbnail"].'"  alt="Feature image" /></div>';
											echo '</div></div></div></div>';
											echo '</div>';
											$j++;
										}	
									}?>
								</div>
								<?php 
									$tops = $this->User_model->get_top($this->session->userdata('id'));
									?>
								<div id="columns-top">
								  	<div class="column" style="position:absolute!important; top:797px; left:335px;"><header>first</header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
																<ul class="meta"><li><strong><?php echo $tops[0]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $tops[0]['year'];?></li> 
																	<li><a href="/socialNetwork/index.php/movie/view/<?php echo $tops[0]['id'];?>">View more</a></li>								</ul>
																<div  class="cover"><img width="120px"  height="178px"src="<?php echo $tops[0]['thumbnail']?>"  alt="Feature image" /></div>
															</div></div></div></div>
									</div>
									<div class="column"style="position:absolute!important; top:850px; left:190px;"><header>second</header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
																<ul class="meta"><li><strong><?php echo $tops[1]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $tops[1]['year'];?></li> 
																	<li><a href="/socialNetwork/index.php/movie/view/<?php echo $tops[1]['id'];?>">View more</a></li>								</ul>
																<div class="cover"><img width="120px"  height="178px"src="<?php echo $tops[1]['thumbnail']?>"  alt="Feature image" /></div>
															</div></div></div></div>
									</div>
									<div class="column"style="position:absolute!important; top:871px; left:480px;"><header>third</header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
																<ul class="meta"><li><strong><?php echo $tops[2]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $tops[2]['year'];?></li> 
																	<li><a href="/socialNetwork/index.php/movie/view/<?php echo $tops[2]['id'];?>">View more</a></li>								</ul>
																<div  class="cover"><img width="120px"  height="178px"src="<?php echo $tops[2]['thumbnail']?>"  alt="Feature image" /></div>
															</div></div></div></div>
									</div>									
									 <div class="column" style="position:absolute!important; top:1040px; left:770px;height: 150px; width: 150px;  border: 0px solid #666666;  -webkit-border-radius: 0px;  -ms-border-radius: 0px;  -moz-border-radius:0px;  border-radius: 0px;  -webkit-box-shadow: inset 0 0 0px #000;  -ms-box-shadow: inset 0 0 0px #000;  box-shadow: inset 0 0 0px #000;cursor:default;"><header>trash</header><img width="150" src="/socialNetwork/img/trash.png"  alt="Drop here to delete" />
									</div> 	
								 </div>
								<div class="queue_movies">
									<div class="fav">
										my favorite movies:
									</div>		
								</div>								
							</div>								
							<!-- fin 2| pestaña -->							
						</div>
						<!-- ENDS TABS -->

<script type="text/javascript" src="/socialNetwork/js/DnD.js"></script>