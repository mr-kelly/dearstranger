<?php
	$this->load->view('header');
?>

<div id="content">
	<h2>「心动恋爱网络」团队</h2>
	<p>
		目前「心动」团队有2个人:
	</p>
	
	<ul>
		<li>
			<a href="http://t.sina.com.cn/mrkelly">
				@公的Kelly
			</a>
			: 创始人, 负责技术开发、产品设计。
		</li>
		
		<li>
			<a href="http://t.sina.com.cn/t959">
				@无造型
			</a>
			: 负责网络营销，外部推广，商业事务。
		</li>
	</ul>
	
	<p>
		如果你对「心动」感兴趣，你也可以～
		<a class="tooltip" title="「心动」自由、平等、开放，欢迎广大的开发者、创业者加入我们的团队。" href="<?=site_url('about/join_us');?>">
			加入我们
		</a>
	</p>
</div>


<div id="sidebar">
	<?php $this->load->view('sidebar/about_widget');?>
	<?php $this->load->view('sidebar/user_widget');?>
</div>


<?php
	$this->load->view('footer');
?>