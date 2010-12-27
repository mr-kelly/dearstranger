<?php
	$this->load->view('header');
	$this->load->library('t_sina');
	$ci =& get_instance();
	
?>

<div id="content">
	<h2>你尚未登录。</h2>
	
	<div>
		<p>
			无需注册、输入密码，按下面按钮就可以用你的新浪微博登录「亲爱陌生人」哦。
		</p>
		
		<div style="margin-left:30px;">
			<a class="tooltip" title="用你的新浪微博帐号登录，无需输入帐号密码" href="<?=$ci->t_sina->getAuthorizeURL( 'http://' . $_SERVER["HTTP_HOST"] . site_url('oauth')  );?>">
				<img src="<?=static_url('images/t_sina_login_btn.png');?>" />
			</a>
		</div>
		
	</div>
</div>

<div id="sidebar">
	
</div>

<?php
	$this->load->view('footer');
?>