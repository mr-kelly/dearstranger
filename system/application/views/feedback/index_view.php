<?php
	$this->load->view('header');
?>

<div id="content" class="center">
	
	<img src="<?=static_url('images/thankyou.gif');?>" style="margin-top:50px;" />
	<br />
	<br />
	<br />
	<a href="<?=site_url('');?>">返回首页</a>
</div>


<div id="sidebar">
	<?php
		$this->load->view('sidebar/feedback_widget');
	?>
</div>
<?php
	$this->load->view('footer');
?>