<div class="sidebar_widget">
	<h2>心动推荐</h2>
	
	<div class="sidebar_widget_content">
		<ul class="sidebar_users_list">
			<?php
				$ci =& get_instance();
				$ci->load->model('user_model');
				
				/**
				 *	获取推荐用户，
				 	如果已登录，获取相反的性别, 相同的城市
				 */
				 $gender = '';
				 if ( !is_t_sina_logined() ) {
				 	$gender = '';
				 	$province_id = '';
				 	$city_id = '';
				 } else {
				 	// 已登录，获取当前用户相反性别
				 	$user = get_user();
				 	if ( $user['profile']['gender'] == '男' ) {
				 		$gender = '女';
				 	} else {
				 		$gender = '男';
				 	}
				 	
				 	$province_id = $user['profile']['province_id'];
				 	$city_id = $user['profile']['city_id'];
				 	
				 }
				$recommend_users = $ci->user_model->get_recommend_users( array(
					'gender' => $gender,
					'province_id' => $province_id,
					'city_id' => $city_id,
				));
				
				
				
				foreach ( $recommend_users as $user ):
			?>
			
				<li>
					<div class="sidebar_users_list_avatar">
						<a href="<?=site_url('user/'.$user['id']);?>">
							<img src="<?=$user['profile']['image_url'];?>" width="50" />
						</a>
					</div>
					<div class="sidebar_users_list_profile">
					
						<div class="sidebar_users_list_profile_name">
							<a href="<?=site_url('user/'.$user['id']);?>">
								<?=$user['profile']['nickname'];?>
							</a>
							
						</div>
						
						<div>
							<a href="#">
								<?=$user['profile']['gender'];?>
							</a>
						

							<?php if ( isset( $user['profile']['age'] ) ): ?>
							<a href="#">
								<?=$user['profile']['age'];?>岁
							</a>
							<?php endif; ?>

							<a href="#">
								<?php
									$p = get_province_by_id( $user['profile']['province_id'] );
									echo $p['province_name'];
								?>
							</a>
							<a href="#">
								<?php
									$c = get_city_by_id( $user['profile']['city_id'], $user['profile']['province_id'] );
									echo $c['city_name'];
								?>
							</a>
						</div>
						
						<div>
							<img src="<?=static_url('images/youfeel_index.gif');?>" height="18" style="margin-bottom: -5px;" />
							<?=$user['profile']['feel_index'];?>
						</div>
						
						<div>
							<img height="18" style="margin-bottom: -5px;" src="<?=static_url('images/inner_index.gif');?>" />
							<span><?=$user['profile']['inner_index'];?>%</span>
						</div>
						
					</div>
					
					<div class="clearboth"></div>
					
				</li>
				
			<?php
				endforeach;
			?>
		</ul>
		
		<div class="clearboth"></div>
	</div>
</div>