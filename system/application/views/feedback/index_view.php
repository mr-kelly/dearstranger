<?php
	$this->load->view('header');
?>

<div id="content" class="center">
	
	<img src="<?=site_url('static/images/thankyou.gif');?>" style="margin-top:50px;" />
	
</div>


<div id="sidebar">
	<?php
		$this->load->view('sidebar/feedback_widget');
	?>
</div>
<?php
	$this->load->view('footer');
?>