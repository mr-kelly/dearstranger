<?php
	$this->load->view("header");
?>

<div id="content">
	<h2>通知微博好友</h2>
	<p>
		告诉你的新浪微博好友加入「心动」。
	</p>
	<p>
		<button class="btn">
			<span><span>告知微博好友</span></span>
		</button>
	</p>
	
	<h2>发到新浪微博</h2>
	<textarea></textarea>
	
	
</div>

<div id="sidebar">
	<?php
		$this->load->view('sidebar/user_widget');
	?>
</div>

<?php
	$this->load->view("footer");
?>