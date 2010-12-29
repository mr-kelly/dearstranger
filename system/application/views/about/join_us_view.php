<?php
	$this->load->view('header');
?>

<div id="content">
	<h2>加入我们</h2>
	<p>「心动」所代表的不仅仅是一个微博应用、一个网站，它背后更代表着这样的一群人：他们热爱生活、热爱互联网，试图以他们的技术、创意、营销、管理、头脑去创造未来、改变世界、影响人类。</p>
	<p>如果你也是怀抱这样的大志，恭喜你，你在适当的时间用你的浏览器走进了适当的地方。</p>
	
	<h2>创新是我们动力的源泉</h2>
	<p>「创新」是我们对「心动」的工作源泉。我们的生活中缺少了创新，我们会吃不饱，睡不安。</p>

	<h2>需要你，喜欢你</h2>
	<p>
		我们也许需要这样的你:
	</p>
	<ul>
		<li>懂HTML/CSS/JavaScript，前端工程师</li>
		<li>懂PHP/Python，软件工程师</li>
		<li>思维天马行空，想法、点子不断地涌现</li>
		<li>懂管理，让一切井井有条</li>
		<li>懂商业，让微小瞬间在世界绽放</li>
		<li>爱玩爱吃爱生活，他们才知道怎样去创造生活</li>
	</ul>
	<p>
		但无论怎样，我们都喜欢你。
	</p>
	
	<h2>行动成就未来</h2>
	<p>Make It Happen 是多么简单的一句话，它代表着用行动成就未来。</p>
	<p>或许你怀抱激情、胸怀大志，却终日屈屈不得志，没有将行动付诸实践。那么，请让你的梦想起飞、你的理想实现，让一切发生吧。</p>
	
	
	<h2>加入理由、个人信息填写</h2>
	<form method="post" action="<?=site_url('about/join_us');?>">
		<textarea name="content"></textarea>
		<button type="submit" class="btn">
			<span><span>加入心动！</span></span>
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
	$this->load->view('footer');
?>