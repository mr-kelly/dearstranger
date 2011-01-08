					<?php
						if( isset($refresh_playground_btn) && $refresh_playground_btn ): 
						// 刷新 广场 选项卡
					?>
						<script>
							function refresh_tab() {
								$('#ui-tabs-1').load("<?=site_url('user/ajax_random_users?ajax=' . rand() );?>");
								return false;
							}
						</script>
						<div>
							<a href="#" id="refresh_tab_btn" class="btn" onclick="return refresh_tab();">
								<span><span>刷新广场</span></span>
							</a>
						</div>
					<?php endif; ?>
					
					
					
					
					<?php
						if ( !isset($more_btn) || $more_btn ): 
						// 寻找\更多 按钮
					?>
					<div>
						<a href="<?=site_url('search');?>" class="btn"><span><span>寻找更多意中人</span></span></a>
					</div>
					<?php endif; ?>
					

					<?php
						foreach( $users_list as $user ):
					?>
					
						<?php
							// 获取当前用户对应的省份、城市
							$city = get_city_by_id( $user['profile']['city_id'], $user['profile']['province_id'] );
							$province = get_province_by_id ( $user['profile']['province_id'] );
						?>
						<div class="user_show">
							<div class="user_avatar">
								<a target="_blank" href="<?=site_url('user/'. $user['id']);?>" title="来自<?=$province['province_name'];?><?=$city['city_name'];?>的<?=$user['profile']['nickname'];?>">
									<img height="100" src="<?=$user['profile']['image_url'];?>" />
								</a>
							</div>
							<div class="user_intro">
								

								<a target="_blank" class="tooltip" title="来自<?=$province['province_name'];?><?=$city['city_name'];?>的<?=$user['profile']['nickname'];?>" href="<?=site_url('user/'. $user['id']);?>">

									<span><?=$province['province_name'];?></span>
									<span><?=$city['city_name'];?></span>
									<br />
									
									
									
									<?=$user['profile']['nickname'];?>
									
								</a>
								

								
								
								<?php // 如果设置了手机，显示手机标志 
									if ( isset( $user['profile']['phone'] ) && $user['profile']['phone'] != '' ) :
								?>
								<img width="12" class="tooltip" title="手机绑定用户" src="<?=static_url('images/phoneicon.jpg');?>" />
								<?php
									endif;
								?>
								
								
								<?php
									// 判断是否花心~  获取心动了多少人
									$ci =& get_instance();
									$ci->load->model('feel_model');
									
									if ( $ci->feel_model->to_feel_count( $user['id'] ) > 5 ):
								?>
									<img src="<?=static_url('images/flowericon.gif');?>" width="12" class="tooltip" title="心动了超过5个人,花心." />
								<?php
									endif;
								?>
								
								
								<br />
								<img style="margin-bottom: -5px;" src="<?=static_url('images/inner_index.gif');?>" />
								<span><?=$user['profile']['inner_index'];?>%</span>
								
								
								<br />
								<?php
									$this->load->view('general/feel_btn_view', array( 'user_id' => $user['id'] )  );
								?>
							</div>
						</div>
					<?php
						endforeach;
					?>
					
					<?php
						// 没找到相应的user...?
						if ( $users_list == null ) {
							echo '还没有！';
						}
					?>
