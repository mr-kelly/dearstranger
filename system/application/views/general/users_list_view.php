					<?php
						foreach( $users_list as $user ):
					?>
						<div class="user_show">
							<div class="user_avatar">
								<!--<a href="<?=site_url('user/'. $user['id']);?>">-->
									<img width="100" src="<?=$user['profile']['image_url'];?>" />
								<!--</a>-->
							</div>
							<div class="user_info">
								
								<?php
									// 获取当前用户对应的省份、城市
									$city = get_city_by_id( $user['profile']['city_id'], $user['profile']['province_id'] );
									$province = get_province_by_id ( $user['profile']['province_id'] );
								?>
								<a class="tooltip" title="来自<?=$province['province_name'];?><?=$city['city_name'];?>的<?=$user['profile']['nickname'];?>" href="<?=site_url('user/'. $user['id']);?>">

									<span><?=$province['province_name'];?></span>
									<span><?=$city['city_name'];?></span>
									<br />
									
									
									
									<?=$user['profile']['nickname'];?>
									
								</a>
								
								<?php // 如果设置了手机，显示手机标志 
									if ( isset( $user['profile']['phone'] ) ) :
								?>
								<img width="12" class="tooltip" title="手机绑定用户" src="<?=site_url('static/images/phoneicon.jpg');?>" />
								<?php
									endif;
								?>
								
								
								
								
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
						if ( $users_list == array() ) {
							echo 'nothing yet';
						}
					?>