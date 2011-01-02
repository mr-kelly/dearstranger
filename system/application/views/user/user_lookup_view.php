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
			<div>
				<img style="margin-bottom:-5px;" height="22" src="<?=static_url('images/inner_index.gif');?>" />
				<span><?=$user['profile']['inner_index'];?>%</span>
			</div>
			<div>
				<a class="btn" href="<?=site_url('user/show_inner_index');?>">
					<span><span>告诉大家你的内涵指数</span></span>
				</a>
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
				
				<?php if ( isset( $user['profile']['birth'] ) && $user['profile']['birth'] != '' ): ?>
				<li>
					<span class="user_label">年龄:</span>
					<?php
						$ci =& get_instance();
						$ci->load->library('Humanize');
						
					?>
					<span class="user_info"><?=$ci->humanize->age( $user['profile']['birth'] );?>岁</span>
				</li>
				<?php endif; ?>
				
				
				<?php if ( isset( $user['profile']['birth'] ) && $user['profile']['birth'] != '' ): ?>
				<li>
					<span class="user_label">生日:</span>
					<span class="user_info"><?=$user['profile']['birth'];?></span>
				</li>
				<?php endif; ?>
				
				<?php if ( isset( $user['profile']['birth'] ) && $user['profile']['birth'] != '' ): ?>
				<li>
					<span class="user_label">星座:</span>

					<span class="user_info"><?=$ci->humanize->constellation( $user['profile']['birth']);?></span>
				</li>
				<?php endif; ?>
				
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
					<span class="user_label">学校/单位</span>
					<span class="user_info">
						<?=$user['profile']['school_unit'];?>
					</span>
				</li>



				<!-- 联系方式 -->
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
							双方“心动”才可以查看
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
								echo '双方“心动”才可以查看';
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
								echo '双方“心动”才可以查看';
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
								echo '双方“心动”才可以查看';
							}
						?>
					</span>
				</li>
				
				
				<!-- 个人状态 -->
				<?php if ( isset( $user['profile']['love']) && $user['profile']['love'] != '' ) :?>
				<li>
					<span class="user_label">恋爱状态:</span>
					<span class="user_info"><?=$user['profile']['love'];?></span>
				</li>
				<?php endif; ?>
				
				
				<?php if ( isset( $user['profile']['target']) && $user['profile']['target'] != '' ) :?>
				<li>
					<span class="user_label">交友目的:</span>
					<span class="user_info"><?=$user['profile']['target'];?></span>
				</li>
				<?php endif; ?>
				
				<?php if ( isset( $user['profile']['standard']) && $user['profile']['standard'] != '' ) :?>
				<li>
					<span class="user_label">择偶标准:</span>
					<span class="user_info">
							<?=$user['profile']['standard'];?>
					</span>
					
				</li>
				<?php endif; ?>
				
				
				<?php if ( isset( $user['profile']['website'] ) && $user['profile']['website'] != '' ) :?>
				<li>
					<span class="user_label">个人主页</span>
					<span class="user_info">
						<a href="<?=$user['profile']['website'];?>">
							<?=$user['profile']['website'];?>
						</a>
					</span>
				</li>
				<?php endif; ?>
				
				
				<?php if ( isset( $user['profile']['job']) && $user['profile']['job'] != '' ) :?>
				<li>
					<span class="user_label">职业</span>
					<span class="user_info">
						<?=$user['profile']['job'];?>
					</span>
				</li>
				<?php endif; ?>
				
				<?php if ( isset( $user['profile']['salary']) && $user['profile']['salary'] != '' ) :?>
				<li>
					<span class="user_label">月薪</span>
					<span class="user_info">
						<?=$user['profile']['salary'];?>
					</span>
				</li>
				<?php endif; ?>
				
				
				
				<!-- 外形 -->
				<?php if ( isset( $user['profile']['height']) && $user['profile']['height'] != '' ) :?>
				<li>
					<span class="user_label">身高:</span>
					<span class="user_info"><?=$user['profile']['height'];?></span>
				</li>
				<?php endif; ?>
				
				<?php if ( isset( $user['profile']['face'] ) && $user['profile']['face'] != '' ) :?>
				<li>
					<span class="user_label">相貌:</span>
					<span class="user_info"><?=$user['profile']['face'];?></span>
				</li>
				<?php endif; ?>
				
				<?php if ( isset( $user['profile']['figure'] ) && $user['profile']['figure'] != '' ) :?>
				<li>
					<span class="user_label">身型:</span>
					<span class="user_info"><?=$user['profile']['figure'];?></span>
				</li>
				<?php endif; ?>
				
				
				<!-- 内在 -->
				<?php if ( isset( $user['profile']['hobby'] ) && $user['profile']['hobby'] != '' ) :?>
				<li>
					<span class="user_label">兴趣爱好:</span>
					<span class="user_info">
						<?=$user['profile']['hobby'];?>
					</span>
				</li>
				<?php endif; ?>
				
				
				<?php if ( isset( $user['profile']['education'] ) && $user['profile']['education'] != '' ) :?>
				<li>
					<span class="user_label">学历:</span>
					<span class="user_info">
						<?=$user['profile']['education'];?>
					</span>
				</li>
				<?php endif; ?>
				
				
				<?php if ( isset( $user['profile']['like_books'] ) && $user['profile']['like_books'] != '' ) :?>
				<li>
					<span class="user_label">喜爱书籍:</span>
					<span class="user_info">
						<?=$user['profile']['like_books'];?>
					</span>
				</li>
				<?php endif; ?>
				
				<?php if ( isset( $user['profile']['like_music'] ) && $user['profile']['like_music'] != '' ) :?>
				<li>
					<span class="user_label">喜爱音乐:</span>
					<span class="user_info">
						<?=$user['profile']['like_music'];?>
					</span>
				</li>
				<?php endif; ?>
				
				<?php if ( isset( $user['profile']['like_sports'] ) && $user['profile']['like_sports'] != '' ) :?>
				<li>
					<span class="user_label">喜爱运动:</span>
					<span class="user_info">
						<?=$user['profile']['like_sports'];?>
					</span>
				</li>
				<?php endif; ?>
				
				
				<?php if ( isset( $user['profile']['like_movies']) && $user['profile']['like_movies'] != '' ) :?>
				<li>
					<span class="user_label">喜爱电影:</span>
					<span class="user_info">
						<?=$user['profile']['like_movies'];?>
					</span>
				</li>
				<?php endif; ?>
				
				
				<?php if ( isset( $user['profile']['like_personages'] ) && $user['profile']['like_personages'] != '' ) :?>
				<li>
					<span class="user_label">喜爱人物:</span>
					<span class="user_info">
						<?=$user['profile']['like_personages'];?>
					</span>
				</li>
				<?php endif; ?>
				
				<?php if ( isset( $user['profile']['motto'] ) && $user['profile']['motto'] != '' ) :?>
				<li>
					<span class="user_label">座右铭:</span>
					<span class="user_info">
						<?=$user['profile']['motto'];?>
					</span>
				</li>
				<?php endif; ?>
				
				
				<?php if ( isset( $user['profile']['description'] ) && $user['profile']['description'] != '' ) :?>
				<li>
					<span class="user_label">自我介绍:</span>
					<span class="user_info">
						
							<?=$user['profile']['description'];?>
						
					</span>
					
				</li>
				<?php endif; ?>
				

				
			</ul>
		</div>
		
		
	</div>
	
	<br class="clearboth" />

</div>


<div id="sidebar">
	<?php $this->load->view('sidebar/user_widget'); ?>
	<?php $this->load->view('sidebar/recommend_widget'); ?>
	<?php $this->load->view('sidebar/feedback_widget'); ?>
</div>



<?php
	$this->load->view('footer');
?>