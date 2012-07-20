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









				







  <div id="columns-full">
  	<div class="column"><header><?php echo $list_to_view[0]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
								<ul class="meta"><li><strong><?php echo $list_to_view[0]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[0]['year'];?></li> 
									<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[0]['id'];?>">View more</a></li>								</ul>
								<div  class="cover"><img width="180px" height="266px"src="<?php echo $list_to_view[0]['thumbnail']?>"  alt="Feature image" /></div>
							</div></div></div></div>
	</div>
	<div class="column"><header><?php echo $list_to_view[1]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
								<ul class="meta"><li><strong><?php echo $list_to_view[1]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[1]['year'];?></li> 
									<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[1]['id'];?>">View more</a></li>								</ul>
								<div class="cover"><img width="180px" height="266px"src="<?php echo $list_to_view[1]['thumbnail']?>"  alt="Feature image" /></div>
							</div></div></div></div>
	</div>
	<div class="column"><header><?php echo $list_to_view[2]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
								<ul class="meta"><li><strong><?php echo $list_to_view[2]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[2]['year'];?></li> 
									<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[2]['id'];?>">View more</a></li>								</ul>
								<div  class="cover"><img width="180px" height="266px"src="<?php echo $list_to_view[2]['thumbnail']?>"  alt="Feature image" /></div>
							</div></div></div></div>
	</div>
	<div class="column"><header><?php echo $list_to_view[3]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
								<ul class="meta"><li><strong><?php echo $list_to_view[3]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[3]['year'];?></li> 
									<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[3]['id'];?>">View more</a></li>								</ul>
								<div  class="cover"><img width="180px" height="266px"src="<?php echo $list_to_view[3]['thumbnail']?>"  alt="Feature image" /></div>
							</div></div></div></div>
	</div>
	<div class="column"><header><?php echo $list_to_view[4]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
								<ul class="meta"><li><strong><?php echo $list_to_view[4]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[4]['year'];?></li> 
									<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[4]['id'];?>">View more</a></li>								</ul>
								<div  class="cover"><img width="180px" height="266px"src="<?php echo $list_to_view[4]['thumbnail']?>"  alt="Feature image" /></div>
							</div></div></div></div>
	</div>  	
   </div>
<script type="text/javascript" src="/socialNetwork/js/DnD.js"></script>