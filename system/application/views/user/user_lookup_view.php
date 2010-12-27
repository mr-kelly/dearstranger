<?php
	$this->load->view('header');
	$current_user = get_user();
?>


<div id="content">
	<div id="user_lookup">
		<div class="user_avatar">
			<img width="180" src="<?=$user['profile']['image_url'];?>" />
			<br />

			<div>
				<img style="margin-bottom:-5px;" height="22" src="<?=static_url('images/youfeel_index.gif');?>" />
				<span><?=$user['feel_index'];?></span>
			</div>

			<br />
			<?php
				$this->load->view('general/feel_btn_view', array( 'user_id' => $user['id'] ) );
			?>
		</div>
		
		<div class="user_profile">
			<h2><?=$user['profile']['nickname'];?></h2>
			<ul>
				<li>
					<span class="user_label">昵称:</span>
					<span class="user_info"><?=$user['profile']['nickname'];?></span>
				</li>
				
				<li>
					<span class="user_label">性别:</span>
					<span class="user_info"><?=$user['profile']['gender'];?></span>
				</li>
				
				<li>
					<span class="user_label">所在地:</span>
					<span class="user_info">
						<?php
							$province = get_province_by_id( $user['profile']['province_id'] );
							$city = get_city_by_id( $user['profile']['city_id'], $user['profile']['province_id'] );
							
						?>
						<?=$province['province_name'];?>
						<?=$city['city_name'];?>
					</span>
				</li>
				
				<li>
					<span class="user_label">年龄:</span>
					<?php
						$ci =& get_instance();
						$ci->load->library('Humanize');
						
					?>
					<span class="user_info"><?=$ci->humanize->age( $user['profile']['birth'] );?>岁</span>
				</li>
				
				<li>
					<span class="user_label">生日:</span>
					<span class="user_info"><?=$user['profile']['birth'];?></span>
				</li>
				<li>
					<span class="user_label">星座:</span>

					<span class="user_info"><?=$ci->humanize->constellation( $user['profile']['birth']);?></span>
				</li>
				<li>
					<span class="user_label">身高:</span>
					<span class="user_info"><?=$user['profile']['height'];?></span>
				</li>

				<li>
					<span class="user_label">相貌:</span>
					<span class="user_info"><?=$user['profile']['face'];?></span>
				</li>
				
				<li>
					<span class="user_label">恋爱状态:</span>
					<span class="user_info"><?=$user['profile']['love'];?></span>
				</li>
				
				
				<li>
					<span class="user_label">微博:</span>
					<span class="user_info user_secret">
						<?php
							if ( is_feel( $user['id']) == 'mutual'  ):
						?>
							<a target="_blank" href="http://t.sina.com.cn/<?=$user['t_sina_id'];?>">http://t.sina.comm.cn/<?=$user['t_sina_id'];?></a>
						<?php
							else:
						?>
							双方有feel才可以查看
						<?php
							endif;
						?>
					</span>
				</li>
				
				<li>
					<span class="user_label">手机:</span>
					<span class="user_info user_secret">
						<?php
							// 双方有feel才可以看见~QQ
							if ( is_feel ( $user['id'] ) == 'mutual' ) {
								echo $user['profile']['phone'];
							} else {
								echo '双方有feel才可以查看';
							}
						?>
						
					</span>
				</li>
				

				
				<li>
					<span class="user_label">QQ:</span>
					<span class="user_info user_secret">
						<?php
							// 双方有feel才可以看见~QQ
							if ( is_feel ( $user['id'] ) == 'mutual' ) {
								echo $user['profile']['qq'];
							} else {
								echo '双方有feel才可以查看';
							}
						?>
						
					</span>
				</li>
				
				<li>
					<span class="user_label">MSN:</span>
					<span class="user_info user_secret">
						<?php
							// 双方有feel才可以看见~QQ
							if ( is_feel ( $user['id'] ) == 'mutual' ) {
								echo $user['profile']['msn'];
							} else {
								echo '双方有feel才可以查看';
							}
						?>
					</span>
				</li>
				<li>
					<span class="user_label">兴趣爱好:</span>
					<span class="user_info">
						<?=$user['profile']['hobby'];?>
					</span>
				</li>
				<li>
					<span class="user_label">交友目的:</span>
					<span class="user_info"><?=$user['profile']['target'];?></span>
				</li>
				
				
				<li>
					<span class="user_label">自我介绍:</span>
					<div>
						<p>
							<?=$user['profile']['description'];?>
						</p>
					</div>
					
				</li>
				
				<li>
					<span class="user_label">择偶标准:</span>
					<div>
						<p>
							<?=$user['profile']['standard'];?>
						</p>
					</div>
					
				</li>
				
			</ul>
		</div>
		
		
	</div>
	
	<br class="clearboth" />

</div>


<div id="sidebar">
	<?php $this->load->view('sidebar/user_widget'); ?>
</div>



<?php
	$this->load->view('footer');
?>