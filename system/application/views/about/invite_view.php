<?php
	$this->load->view("header");
?>

<div id="content">

	<h2>指定通知</h2>
	<p>
		输入你心仪对象的微博名字（如 公的Kelly  , 没有符号@), 我们官方微博帐号将会通知他来到「心动」注册。
	</p>
	<p>
		<form method="post" action="<?=site_url('about/invite_specify');?>">		
			<label>对方微博名称</label>
			<input type="text" name="screen_name" />
			<button type="submit" class="btn">
				<span><span>邀请他</span></span>
			</button>
		</form>
	</p>
	
	<br />
	
	
	
<!-- 
	<h2>通知微博好友</h2>
	<p>
		告诉你的新浪微博好友加入「心动」。
	</p>

	<p>
		<a href="<?=site_url('about/invite_somebody');?>" class="btn">
			<span><span>告知微博好友</span></span>
		</a>
	</p>

	<br />
 -->
	
	
	
	
	<h2>发到新浪微博</h2>
	
	<form method="post" action="<?=site_url('about/invite_weibo');?>">
		
		<textarea rows="3" cols="50" name="content"><?php
				$ci =& get_instance(); 
				$ci->load->library('t_sina');
				
				$invite_message = $ci->config->item('invite_weibo');
				// 信息里@十个好友～
				$friends = $ci->t_sina->getFriends(10);
				
				foreach( $friends as $f ) {
					$invite_message .= ' @' . $f['screen_name'] . ' ';
				}
				
				echo $invite_message;
			?></textarea>
		
		<button type="submit" class="btn">
			<span><span>发送</span></span>
		</button>
	</form>
	
	
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
	$this->load->view("footer");
?>