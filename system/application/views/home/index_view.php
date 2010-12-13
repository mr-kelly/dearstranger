<?php
	$this->load->view('header'); 
	$ci =& get_instance();
	$current_user = get_user();
	
?>





	

		<div id="content">
		
			<?php if ( !is_t_sina_logined() ): ?>
			<div class="website_intro">
				<p>
					「亲爱陌生人」是一个特别的恋爱交友网络。他与她三步之遥：
				</p>
				
				<div class="center">
					<img src="<?=site_url('static/images/home_intro.png');?>" style="FILTER: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=<?=site_url('static/images/home_intro.png');?>);" />
				</div>
				<p>
					点击 <img src="<?=site_url('static/images/youfeel.gif');?>" />， 开始寻找心动的他/她吧！
				</p>
				<p>
					名字起源于叮当的歌曲《亲爱陌生人》(<a target="_blank" href="http://box.zhangmen.baidu.com/m?word=wma,,,[%C7%D7%B0%AE%C4%B0%C9%FA%C8%CB]&gate=1&ct=134217728&tn=baidumt,%C7%D7%B0%AE%C4%B0%C9%FA%C8%CB++&si=%C7%D7%B0%AE%C4%B0%C9%FA%C8%CB;;%B6%A1%B5%B1;;0;;0&lm=16777216&mtid=1&d=8&size=3565158&attr=0,0&titlekey=1182284529,1182736805">试听</a>|<a target="_blank" href="http://baike.baidu.com/view/3357498.htm">看歌词</a>)。
				</p>
				<a style="float:right;" href="<?=site_url('about/');?>">=>了解更多</a>
				
				<br class="clearboth" />
			</div>
			<?php endif; ?>
			
			
			<div class="tabs">
				<ul>
					<li>
						<a href="<?=site_url('user/ajax_random_users?ajax=' . rand() );?>">广场</a>
					</li>
					

				<?php if ( is_t_sina_logined() ) : ?>
					<li>
						<a href="<?=site_url('user/ajax_get_users_by_city/' . $current_user['profile']['province_id'] . '/' . $current_user['profile']['city_id'] );?>">同城</a>
					</li>
					<li>
						<a href="<?=site_url('user/ajax_from_feel?ajax=' . rand() );?>">谁对你有feel</a>
					</li>
					<li>
						<a href="<?=site_url('user/ajax_to_feel?ajax=' . rand() );?>">心仪对象</a>
					</li>
				<?php endif; ?>
				
				</ul>
				
				
				
				<br class="clearboth" />
			</div>
			
		</div>
		
		<div id="sidebar">
			
			<?php
				$this->load->library('t_sina');
				$this->load->view('sidebar/user_widget'); 
				$this->load->view('sidebar/ranking_widget');
				$this->load->view('sidebar/feedback_widget');
			?>
			
			
		</div>
		



<?php $this->load->view('footer'); ?>