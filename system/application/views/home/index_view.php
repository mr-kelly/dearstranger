<?php
	$this->load->view('header'); 
	$ci =& get_instance();
	$current_user = get_user();
	
?>





	

		<div id="content">
		
			<?php if ( !is_t_sina_logined() ): ?>
			
			<div class="website_intro">
				<a href="<?=site_url('about');?>">
					<img src="<?=static_url('images/home_intro.jpg');?>" />
				</a>
				
				
				<a href="<?=site_url('oauth/authorize_link');?>">
					<img src="<?=static_url('images/home_login_button.jpg');?>" />
				</a>
				
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
						<a href="<?=site_url('user/ajax_to_feel?ajax=' . rand() );?>">心动对象</a>
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