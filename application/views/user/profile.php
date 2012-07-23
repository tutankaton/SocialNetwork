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
		<?php $list_to_view = $this->User_model->movies_to_view($id_profile);	?>
		<?php if($this->User_model->is_friend($info['id'])){
			echo '<div  class="taste">';
				echo '<div><img width="80x" src="/socialNetwork/img/handshake.png" title="agreement" style="margin-left:50px;"></img></div>';
				echo '<div id="slid"  class="friend_taste" value="'.$this->User_model->get_agreement($info['id']).'"> </div>';
				echo '<div><img width="80x" src="/socialNetwork/img/vomito.png" title="disagreement" style="margin-left:50px;"></img></div>';
			echo '</div>';
			echo '<div style="width:250px;float:left;margin-top:30px;margin-left:25px;display:inline;"><i><hr><span  id="degree">select the degree of agreement with the slide</span></hr></i></div>';
		}
		?>




  <div id="columns-full">
  	<div class="column" style="position:absolute!important; top:500px; left:40px;"><header><?php echo $list_to_view[0]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
								<ul class="meta"><li><strong><?php echo $list_to_view[0]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[0]['year'];?></li> 
									<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[0]['id'];?>">View more</a></li>								</ul>
								<div  class="cover"><img width="120px"  height="178px"src="<?php echo $list_to_view[0]['thumbnail']?>"  alt="Feature image" /></div>
							</div></div></div></div>
	</div>
	<div class="column"style="position:absolute!important; top:530px; left:430px;"><header><?php echo $list_to_view[1]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
								<ul class="meta"><li><strong><?php echo $list_to_view[1]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[1]['year'];?></li> 
									<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[1]['id'];?>">View more</a></li>								</ul>
								<div class="cover"><img width="120px"  height="178px"src="<?php echo $list_to_view[1]['thumbnail']?>"  alt="Feature image" /></div>
							</div></div></div></div>
	</div>
	<div class="column"style="position:absolute!important; top:750px; left:130px;"><header><?php echo $list_to_view[2]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
								<ul class="meta"><li><strong><?php echo $list_to_view[2]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[2]['year'];?></li> 
									<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[2]['id'];?>">View more</a></li>								</ul>
								<div  class="cover"><img width="120px"  height="178px"src="<?php echo $list_to_view[2]['thumbnail']?>"  alt="Feature image" /></div>
							</div></div></div></div>
	</div>
	<div class="column"style="position:absolute!important; top:750px; left:330px;"><header><?php echo $list_to_view[3]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
								<ul class="meta"><li><strong><?php echo $list_to_view[3]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[3]['year'];?></li> 
									<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[3]['id'];?>">View more</a></li>								</ul>
								<div  class="cover"><img width="120px" height="178px"src="<?php echo $list_to_view[3]['thumbnail']?>"  alt="Feature image" /></div>
							</div></div></div></div>
	</div>
	<div class="column"style="position:absolute!important; top:750px; left:530px;"><header><?php echo $list_to_view[4]['id'];?></header><div id="projects-list"><div class="project"><div class="project-shadow"><div class="project-thumbnail">
								<ul class="meta"><li><strong><?php echo $list_to_view[4]['title'];?></strong></li><li><strong>Year: </strong> <?php echo $list_to_view[4]['year'];?></li> 
									<li><a href="/socialNetwork/index.php/movie/view/<?php echo $list_to_view[4]['id'];?>">View more</a></li>								</ul>
								<div  class="cover"><img width="120px" height="178px"src="<?php echo $list_to_view[4]['thumbnail']?>"  alt="Feature image" /></div>
							</div></div></div></div>
	</div> 
	 <div class="column" style="position:absolute!important; top:820px; left:770px;height: 150px; width: 150px;  border: 0px solid #666666;  -webkit-border-radius: 0px;  -ms-border-radius: 0px;  -moz-border-radius:0px;  border-radius: 0px;  -webkit-box-shadow: inset 0 0 0px #000;  -ms-box-shadow: inset 0 0 0px #000;  box-shadow: inset 0 0 0px #000;cursor:default;"><header>trash</header><img width="150" src="/socialNetwork/img/trash.png"  alt="Drop here to delete" />
	</div> 	
	 <div class="column" style="position:absolute!important; top:540px; left:750px;height: 150px; width: 150px;  border: 0px solid #666666;  -webkit-border-radius: 0px;  -ms-border-radius: 0px;  -moz-border-radius:0px;  border-radius: 0px;  -webkit-box-shadow: inset 0 0 0px #000;  -ms-box-shadow: inset 0 0 0px #000;  box-shadow: inset 0 0 0px #000;cursor:default;"><header>file</header><img width="150" src="/socialNetwork/img/vhs.png"  alt="Drop here if you saw it " />
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