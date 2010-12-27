<?php
	$this->load->view('header');
?>


	<div id="content">
		
		<h3>这是什么</h3>
		<p>
			「亲爱陌生人」是一个特别的恋爱交友网络。他与她，三步之遥：		
		</p>
		
		
				<div class="center">
					<img src="<?=static_url('images/home_intro.png');?>" style="FILTER: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=<?=site_url('static/images/home_intro.png');?>);" />
				</div>
		<p>
			在「亲爱陌生人」你可以:
			<ul>
				<li>找到你的心仪对象</li>
				<li>结识你的心仪对象</li>
				<li>结交志同道合的新朋友</li>
			</ul>
		</p>
		
		
		<h3>起源</h3>
		<p>
			2010年11月11日光棍节的这天，无数渴望爱与被爱的人难抑他们心中的呐喊：校园里暴动、网络论坛的各个征友贴、众多各样的派对、联谊活动，寂寞总是永远的主题这些火爆现象，重新体现了歌德的话：“哪个男子不钟情，哪个少女不怀春”。人们渴望爱与被爱，可为什么总要在迷茫的关系上披上纱？
		</p>
		<p>
			「亲爱陌生人」最初想法就是在这样的一个背景下萌芽的，旨在为渴望爱与被爱、感受朋友的温暖的人提供一个简单而清晰的交友网络。
		</p>
		
		<h3>灵感</h3>
		<p>
			有一天邮箱里收到“有feeling”网站的邀请，进而深深地被“恋爱2.0”的概念吸引。这也是「亲爱陌生人」的灵感来源。
		</p>
		<p>
			这不是一个网站，是寂寞。
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


