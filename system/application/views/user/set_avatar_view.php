<?php
	$this->load->view('header');
?>
<div id="content">
	<h2>上传个人头像</h2>
	
	
	<form action="<?=site_url('user/set_avatar');?>" method="post" enctype="multipart/form-data">
		<input type="file" name="userfile" size="20" />
		

		
			<button type="submit" class="btn tooltip" title="确认上传头像！">
				<span><span>确认</span></span>
			</button>
		
	</form>
	
	
	<h2>使用微博头像</h2>
	<p>你可以同步你目前在微博使用的头像</p>
	<a class="btn tooltip" title="同步微博的头像" href="<?=site_url('user/set_avatar_default');?>"><span><span>使用微博头像</span></span></a>
</div>

<div id="sidebar">
		<?php $this->load->view('sidebar/user_widget'); ?>
		<?php $this->load->view('sidebar/ranking_widget'); ?>
		<?php $this->load->view('sidebar/feedback_widget'); ?>
</div>

<?php
	$this->load->view('footer');
?>