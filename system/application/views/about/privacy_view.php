<?php
	$this->load->view('header');
?>

<div id="content">
	<h2>「心动」隐私政策</h2>
	<p>
		在「心动」里面，你的一切资料都是受到保护的。在两个人互相心动之前，你们没有办法获得对方的任何联系方式，包括微博地址。
		请你填写你的一些基本的个人资料，这样，别人才能够发现你的美丽。
	</p>
	
	
	<h2>免责条款</h2>
	<p>
		在如下情况下，本站将不对您的隐私泄露承担责任：<br />
		您同意让第三方共享资料；<br />
		您同意公开你的个人资料，享受为您提供的产品和服务；<br />
		本站需要听从法庭传票、法律命令或遵循法律程序；<br />
		因黑客行为或用户的保管疏忽导致帐号、密码遭他人非法使用<br />
	</p>
</div>



	<div id="sidebar">
		<?php
			$this->load->view('sidebar/about_widget');
		?>		
		<?php
			$this->load->view('sidebar/feedback_widget');
		?>
	</div>

<?php
	$this->load->view('footer');
?>