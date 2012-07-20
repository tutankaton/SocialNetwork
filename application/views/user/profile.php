<div id="posts" class="single">
	<?php 
	
	$info = $this->User_model->info_profile($id_profile);
	if($info['photo']==NULL)
		echo '<div style="float:left; height:300px;"><img max-width="120px" max-height="120px" style="padding-left:20px;" src="/socialNetwork/img/dummies/avatar.jpg"></img></div>';
	else 
		echo '<div style="float:left; height:300px;"><img max-width="120px"  max-height="120px" style="padding-left:20px;" src="'.$info['photo'].'"></img></div>';
	
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
	
	
</div>
  <div id="columns-full">
    <div class="column"><header><?php echo $list_to_view[0]?></header></div>
    <div class="column"><header><?php echo $list_to_view[1]?></header></div>
    <div class="column"><header><?php echo $list_to_view[2]?></header></div>
    <div class="column"><header><?php echo $list_to_view[3]?></header></div>
    <div class="column"><header><?php echo $list_to_view[4]?></header></div>
  </div>
<!--<script type="text/javascript" src="/socialNetwork/js/DnD.js"></script>-->