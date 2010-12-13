
			<div class="sidebar_widget">
				<h2>
					<?php 
						if ( is_t_sina_logined() ) : 
							$me = get_user();
					?>
						Hi, @<?= $me['t_sina_profile']['screen_name'];?>
						
					<?php else: ?>
						连接你的微博
					<?php endif;?>
				</h2>
				
				<div class="sidebar_widget_content">
					<?php
						if ( ! is_t_sina_logined() ):			
							//未登录，提供OAuth 链接
							$ci =& get_instance();
							$this->load->library('t_sina');
						
					?>
					<p>
						无需注册「亲爱陌生人」，连接你的新浪微博就可使用。
					</p>
					<div class="center">
						<a href="<?=$ci->t_sina->getAuthorizeURL( oauth_callback() );?>">
							<img src="<?=site_url('static/images/t_sina_login_btn.png');?>" />
						</a>
					</div>
					
					<?php
						else:
							// oAuth 微博登录过了!
							
							//显示用户微博信息吧!
							$me = get_user();
							
							
					?>
						<div class="user_widget_avatar center">
							<img class="avatar" src="<?=$me['profile']['image_url'];?>" width="50" />
							<br />
							<a href="<?=site_url('user/'. $me['id']);?>">
								<?=$me['profile']['nickname'];?>
							</a>
							<br />
							<img style="margin-bottom:-5px;" height="18" src="/xxmm/static/images/youfeel_index.gif" />
							<?=$me['profile']['feel_index'];?>
						</div>
						
						<div class="user_widget_control">
							<ul>
								<li>
									<a class="tooltip icon icon_back" title="返回你的新浪微博页面" href="http://t.sina.com.cn/<?=$me['t_sina_id'];?>">
										回到微博
									</a>
								</li>

								<li>
									<a class="tooltip icon icon_setting" title="设置你在「亲爱陌生人」的个人资料"  href="<?=site_url('user/setting');?>">资料设置</a>
								</li>
								<li>
									<a class="tooltip icon icon_face" title="更换你的个人头像"  href="<?=site_url('user/set_avatar');?>">更换照片</a>
								</li>
								
								<li>
									<a class="tooltip icon icon_exit" title="退出登录"  href="<?=site_url('oauth/logout');?>">登出</a>
								</li>
							</ul>
						</div>
						
						
						<br class="clearboth" />
					<?
						endif;
					?>
				
				</div>

			</div>