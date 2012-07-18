<div id="posts" class="single">
<?php 
if($this->User_model->is_logged_in()){

	if(!$this->User_model->check_user_level()){
		redirect('verify');
	}else{
		$this->User_model->update_online_status();		
		if($this->User_model->get_photo()==NULL)
			echo '<div><img max-width="120px" max-height="120px" src="/socialNetwork/img/dummies/avatar.jpg"></img></div>';
		else 
			echo '<div><img max-width="120px"  max-height="120px" src="'.$this->User_model->get_photo().'"></img></div>';
		
		echo anchor('user/change_photo', 'Change photo');
	}
}?>
</div>
<!-- sidebar -->
<ul id="sidebar">
	<!-- init sidebar -->
	<li>
		<h6>Categories</h6>		
		<ul>
			<li class="cat-item"><a href="#" title="View all posts">Pellentesque habitant morbi</a></li>
			<li class="cat-item"><a href="#" title="View all posts">Pellentesque habitant morbi</a></li>
			<li class="cat-item"><a href="#" title="View all posts">Pellentesque habitant morbi</a></li>
			<li class="cat-item"><a href="#" title="View all posts">Pellentesque habitant morbi</a></li>
		</ul>
	</li>	
	
	<li>
		<h6>Archives</h6>		
		<ul>
			<li class="cat-item"><a href="#" title="View all posts">Pellentesque habitant morbi</a></li>
			<li class="cat-item"><a href="#" title="View all posts">Pellentesque habitant morbi</a></li>
			<li class="cat-item"><a href="#" title="View all posts">Pellentesque habitant morbi</a></li>
			<li class="cat-item"><a href="#" title="View all posts">Pellentesque habitant morbi</a></li>
		</ul>
	</li>
	<!-- ENDS init sidebar -->
</ul>
<!-- ENDS sidebar -->