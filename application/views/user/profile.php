<div id="posts" class="single">
	<?php 
	
	$info = $this->User_model->info_profile($id_profile);
	if($info['photo']==NULL)
		echo '<div  class="photo sample3" style="float:left; height:300px;"><span></span><img max-width="120px" max-height="120px" src="/socialNetwork/img/dummies/avatar.jpg"></img></div>';
	else 
		echo '<div  class="photo sample3" style="float:left; height:300px;"><span></span><img max-width="120px"  max-height="120px"  src="'.$info['photo'].'"></img></div>';
	
	?>
	<div style="float:left;padding-left:20px; display:inline; max-width: 375px; "><h1 style="color:#333333;"><?php echo $info['username']; ?>
		<?php if($this->User_model->is_friend($info['id']))
			echo '<a style="display:inline; padding-left:10px;" href="/socialNetwork/index.php/user/delete_friendship/'.$info['id'].'" title="Delete friendship"><img width="26px" src="/socialNetwork/img/mono-icons/userminus32.png"></img></a>';
		else 
			echo '<a  style="display:inline; padding-left:10px;" href="/socialNetwork/index.php/user/add_friendship/'.$info['id'].'" title="Add friend"><img width="26px" src="/socialNetwork/img/mono-icons/userplus32.png"></img></a>';
		?>
	</h1>
		<?php if($info['from']!=null) echo '<span>lives in: <span style="color:#666666;">'.$info['from'].'</span></span>';?>
		<span style="display:block;">birthday: <span style="color:#666666;"><?php echo $info['month']; ?>/<?php echo $info['day']; ?>/<?php echo $info['year']; ?></span></span>
		<?php if($info['ocupation']!=null) echo '<span style="display:block;">occupation: <span style="color:#666666;">'.$info['ocupation'].'</span></span>';?>
		<?php if($info['language']!=null) echo '<span style="display:block;">languages: <span style="color:#666666;">'.$info['language'].'</span></span>';?>
		<?php if($info['relationship_status']!=null) echo '<span style="display:block;">relationship status: <span style="color:#666666;">'.$info['relationship_status'].'</span></span>';?>
		<?php if($info['about']!=null) echo '<span style="display:block;">about me: <span style="color:#666666;">'.$info['about'].'</span></span>';?>
	</div>
	<div style="float:right;padding-right:20px;padding-top:0px;display:inline; ">
		<img width="20px" src="/socialNetwork/img/mono-icons/clock32.png"></img>
		<span style="display:inline;"> last active: <span style="color:#666666;"><?php echo $info['last_active']; ?></span></span>
		<span style="display:block;"><img width="20px" src="/socialNetwork/img/mono-icons/smile32.png"></img> in the community since: <span style="color:#666666;"><?php echo $info['created_on']; ?></span></span>

	</div>
		<?php if($this->User_model->is_friend($info['id'])){
			echo '<div  class="taste">';
				echo '<div><img width="80x" src="/socialNetwork/img/handshake.png" title="agreement" style="margin-left:50px;"></img></div>';
				echo '<div id="slid"  class="friend_taste" value="'.$this->User_model->get_agreement($info['id']).'"> </div>';
				echo '<div><img width="80x" src="/socialNetwork/img/vomito.png" title="disagreement" style="margin-left:50px;"></img></div>';
			echo '</div>';
			echo '<div style="width:250px;float:left;margin-top:30px;margin-left:25px;display:inline;"><i><hr><span  id="degree">select the degree of agreement with the slide</span></hr></i></div>';
		}
		?>
</div>
<?php 
$list_to_view = $this->User_model->movies_to_view($id_profile);	?>

<!-- TABS -->
<!-- the tabs -->
<ul class="tabs" style="margin-top: 370px!important;">
	<li><a href="#">Movies to view</a></li>
	<li><a href="#">Top movies</a></li>
</ul>
<div class="panes">							
	<!-- 1| pestaña  -->
	<div>		
		<div id="columns-full">
		  	<div class="column" style="position:absolute!important; top:570px; left:240px;"><header><?php echo $list_to_view[0]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
										<ul class="meta"><li><strong><?php echo $list_to_view[0]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[0]['year'];?></li> 
											<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[0]['id'];?>">View more</a></li>								</ul>
										<div  class="cover"><img width="120px"  height="178px"src="<?php echo $list_to_view[0]['thumbnail']?>"  alt="Feature image" /></div>
									</div></div></div></div>
			</div>
			<div class="column"style="position:absolute!important; top:600px; left:630px;"><header><?php echo $list_to_view[1]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
										<ul class="meta"><li><strong><?php echo $list_to_view[1]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[1]['year'];?></li> 
											<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[1]['id'];?>">View more</a></li>								</ul>
										<div class="cover"><img width="120px"  height="178px"src="<?php echo $list_to_view[1]['thumbnail']?>"  alt="Feature image" /></div>
									</div></div></div></div>
			</div>
			<div class="column"style="position:absolute!important; top:820px; left:180px;"><header><?php echo $list_to_view[2]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
										<ul class="meta"><li><strong><?php echo $list_to_view[2]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[2]['year'];?></li> 
											<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[2]['id'];?>">View more</a></li>								</ul>
										<div  class="cover"><img width="120px"  height="178px"src="<?php echo $list_to_view[2]['thumbnail']?>"  alt="Feature image" /></div>
									</div></div></div></div>
			</div>
			<div class="column"style="position:absolute!important; top:820px; left:430px;"><header><?php echo $list_to_view[3]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
										<ul class="meta"><li><strong><?php echo $list_to_view[3]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[3]['year'];?></li> 
											<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[3]['id'];?>">View more</a></li>								</ul>
										<div  class="cover"><img width="120px" height="178px"src="<?php echo $list_to_view[3]['thumbnail']?>"  alt="Feature image" /></div>
									</div></div></div></div>
			</div>
			<div class="column"style="position:absolute!important; top:820px; left:680px;"><header><?php echo $list_to_view[4]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
										<ul class="meta"><li><strong><?php echo $list_to_view[4]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[4]['year'];?></li> 
											<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[4]['id'];?>">View more</a></li>								</ul>
										<div  class="cover"><img width="120px" height="178px"src="<?php echo $list_to_view[4]['thumbnail']?>"  alt="Feature image" /></div>
									</div></div></div></div>
			</div> 
		 </div>
		<div class="queue_movies">
			<div class="top_profile">
				<img src="/socialNetwork/img/top.png" width="160px"></img>
			</div>
			<div class="one_profile">
				<img src="/socialNetwork/img/one.png" width="60px"></img>
			</div>
			<div class="two_profile">
				<img src="/socialNetwork/img/two.png" width="100px"></img>
			</div>
			<div class="three_profile">
				<img src="/socialNetwork/img/three.png" width="40px"></img>
			</div>
			<div class="four_profile">
				<img src="/socialNetwork/img/four.png" width="30px"></img>
			</div>
			<div class="five_profile">
				<img src="/socialNetwork/img/five.png" width="30px"></img>
			</div>
			<div class="text-first_profile">
				-> The first movie I want to see
			</div>
			<div class="text-second_profile">
				then I'd like to see ->
			</div>
			<div class="text-others_profile">
				I have also enqueue:
			</div>
		</div>
		
	</div>
	<!-- fin 1| pestaña -->
	
	<!-- 2| pestaña  -->
	<div>		
		<?php $tops = $this->User_model->get_top($id_profile);?>
		<div id="columns-top">
		  	<div class="column" style="position:absolute!important; top:610px; left:362px;"><header>first</header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
										<ul class="meta"><li><strong><?php echo $tops[0]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $tops[0]['year'];?></li> 
											<li><a href="/socialNetwork/index.php/movie/view/<?php echo $tops[0]['id'];?>">View more</a></li>								</ul>
										<div  class="cover"><img width="120px"  height="178px"src="<?php echo $tops[0]['thumbnail']?>"  alt="Feature image" /></div>
									</div></div></div></div>
			</div>
			<div class="column"style="position:absolute!important; top:650px; left:232px;"><header>second</header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
										<ul class="meta"><li><strong><?php echo $tops[1]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $tops[1]['year'];?></li> 
											<li><a href="/socialNetwork/index.php/movie/view/<?php echo $tops[1]['id'];?>">View more</a></li>								</ul>
										<div class="cover"><img width="120px"  height="178px"src="<?php echo $tops[1]['thumbnail']?>"  alt="Feature image" /></div>
									</div></div></div></div>
			</div>
			<div class="column"style="position:absolute!important; top:665px; left:492px;"><header>third</header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
										<ul class="meta"><li><strong><?php echo $tops[2]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $tops[2]['year'];?></li> 
											<li><a href="/socialNetwork/index.php/movie/view/<?php echo $tops[2]['id'];?>">View more</a></li>								</ul>
										<div  class="cover"><img width="120px"  height="178px"src="<?php echo $tops[2]['thumbnail']?>"  alt="Feature image" /></div>
									</div></div></div></div>
			</div>	
		 </div>
		<div class="queue_movies">
			<div class="fav_profile">
				my favorite movies:
			</div>		
			<div class="podio1_profile">
				<img src="/socialNetwork/img/podio1.png"></img>
			</div>
			<div class="podio2_profile">
				<img src="/socialNetwork/img/podio2.png"></img>
			</div>
			<div class="podio3_profile">
				<img src="/socialNetwork/img/podio3.png"></img>
			</div>
			<div class="trofeo1_profile">
				<img src="/socialNetwork/img/trofeo1.png" width="110px"></img>
			</div>
			<div class="trofeo2_profile">
				<img src="/socialNetwork/img/trofeo2.png" width="70px"></img>
			</div>			
			<div class="trofeo3_profile">
				<img src="/socialNetwork/img/trofeo3.png" width="200px"></img>
			</div>
		</div>								
	</div>								
	<!-- fin 2| pestaña -->							
</div>
<!-- ENDS TABS -->

<script>
var degrees = ["select the degree of agreement with the slide","makes me vomit", "not deserve to have an internet connection", "not worthy to be called cinephile", "Chaplin must be rolling in his grave","indifferent", "I think he has good taste", "we have much in common", "we are like brothers", "we are soul mates", "is as if we were the same person"];
$("#degree").text(degrees[$( "#slid" ).attr('value')]);
$( "#slid" ).slider({ orientation: "vertical",
 max: 9 ,
  value: $("#slid").attr("value")-1,
  slide: function (event, ui){
  	$("#degree").text(degrees[ui.value+1]);
  },
  change: function (event, ui){
  	$.ajax({
	  type: "POST",
	  url: "/socialNetwork/index.php/user/set_agreement/"+ui.value+"/"+<?php echo $info['id'];?>,
	}).done(function( msg ) {

	});
  }
  });
</script>

<!--<script type="text/javascript" src="/socialNetwork/js/DnD.js"></script>-->