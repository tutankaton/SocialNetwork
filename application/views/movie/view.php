<div id="posts" class="single">

	<!-- post -->
	<div class="post">
		<?php 
		list ($title, $sinopsis, $year, $calification, $image, $thumbnail) = $this->Movie_model->get_movie_info($id);
		?>
		<h1><?php echo $title?> (<?php echo $year?>)</h1>
		
		<!-- shadow -->
		<div class="thumb-shadow">
		
			<!-- post-thumb -->
			<div class="post-thumbnail">
				<img src="<?php echo $image?>"  alt="Feature image" height='600' width='400' />
			</div>
			<!-- ENDS post-thumb -->
			<div>
				<p><?php echo $sinopsis?></p>

			</div>
		</div>
		<!-- ENDS shadow -->
							
		<!-- meta -->
		<ul class="meta">
			<li><strong>Posted on</strong> Dec 27th 2011 </li>
			<li><strong>By</strong> <a href="#">Ansimuz</a></li> 
			<li> <strong>Posted in</strong> 
				<div class="meta-tags">
					<a href="#">Webdesign</a>
					<a href="#">Code</a>
					<a href="#">Photo</a>
					<a href="#">Blue</a>
					<a href="#">Computers</a>
					<a href="#">Sites</a>
				</div>
			</li>
		</ul>
		<!-- ENDS meta -->	
		
	</div>
	<!-- ENDS post -->
	
	<!-- Comments-Block -->
	<div id="comments-block">
		<div class="n-comments">165</div> <div class="n-comments-text">comments</div>

		<!-- comments list -->
		<ul class="commentlist">
			<li class="comment" id="comment-18">
				<div id="div-comment-18" class="comment-body">
					<div class="comment-author vcard">
						<img alt='' src='/socialNetwork/img/dummies/avatar.jpg' class='avatar avatar-60 photo' height='60' width='60' />
						<cite class="fn">admin</cite><span class="says"> says:</span>
					</div>
	
					<div class="comment-meta commentmetadata">
						<a href="#">February 9, 2011 at 6:28 pm</a>
					</div>
	
					<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget.</p>
	
					<div class="reply">
						<a class='comment-reply-link' href='/archives/196?replytocom=18#respond' onclick='return addComment.moveForm("div-comment-18", "18", "respond", "196")'>Reply</a>
					</div>
				</div>
			</li>
			<li class="comment" id="comment-18">
				<div id="div-comment-18" class="comment-body">
					<div class="comment-author vcard">
						<img alt='' src='/socialNetwork/img/dummies/avatar.jpg' class='avatar avatar-60 photo' height='60' width='60' />
						<cite class="fn">admin</cite><span class="says"> says:</span>
					</div>
	
					<div class="comment-meta commentmetadata">
						<a href="#">February 9, 2011 at 6:28 pm</a>
					</div>
	
					<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget.</p>
	
					<div class="reply">
						<a class='comment-reply-link' href='/archives/196?replytocom=18#respond' onclick='return addComment.moveForm("div-comment-18", "18", "respond", "196")'>Reply</a>
					</div>
				</div>
			</li>
			<li class="comment" id="comment-18">
				<div id="div-comment-18" class="comment-body">
					<div class="comment-author vcard">
						<img alt='' src='/socialNetwork/img/dummies/avatar.jpg' class='avatar avatar-60 photo' height='60' width='60' />
						<cite class="fn">admin</cite><span class="says"> says:</span>
					</div>
	
					<div class="comment-meta commentmetadata">
						<a href="#">February 9, 2011 at 6:28 pm</a>
					</div>
	
					<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget.</p>
	
					<div class="reply">
						<a class='comment-reply-link' href='/archives/196?replytocom=18#respond' onclick='return addComment.moveForm("div-comment-18", "18", "respond", "196")'>Reply</a>
					</div>
				</div>
			</li>
		</ul>
		<!-- ENDS comments list -->


		<!-- Navi -->
		<div class="comments-pagination">
		<a class='prev page-numbers' href='http://localhost:8888/archives/586/comment-page-1#comments'>&laquo; Previous</a>
		<a class='page-numbers' href='http://localhost:8888/archives/586/comment-page-1#comments'>1</a>
		<span class='page-numbers current'>2</span>	</div>
		<!-- ENDS Navi -->

		<!-- comments form -->
		<div id="respond">
			<div class="leave-comment">
				<h2>Leave a Reply</h2>	
				<!-- form -->
				<form action="#" method="post" id="commentform">
					<fieldset>
						<div><label >NAME </label>
						<input type="text" name="author" id="author" value="" tabindex="1" /></div>
						<div><label >EMAIL (Will not be published) </label>
						<input type="text" name="email" id="email" value="" tabindex="2" /></div>
						<div><label >WEBSITE</label><input type="text" name="url" id="url" value="" tabindex="3" /></div>
						<div class="admin-form">
							<div>
								<label >COMMENTS</label>
								<textarea  name="comment" id="comment" rows="10" tabindex="4"></textarea>
							</div>
							<div><input type="submit" name="submit" id="submit" tabindex="5" value="SEND" /></div>
							<div><input type="hidden" name="comment_post_ID" value="586" /></div>
						</div>
						<input type='hidden' name='comment_post_ID' value='586' id='comment_post_ID' />
						<input type='hidden' name='comment_parent' id='comment_parent' value='0' />
					</fieldset>
				</form>
				<!-- ENDS form -->
			</div>
		</div>
		<!-- ENDS comments form -->	
	</div>
	<!-- ENDS Comments-block -->		
	
</div>
<!-- ENDS Posts -->	


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