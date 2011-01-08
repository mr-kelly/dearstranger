			<div class="sidebar_widget">
				<!-- JiaThis Button BEGIN -->
				<div id="ckepop">
					<a href="http://www.jiathis.com/share/" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank">分享</a>
					<span class="jiathis_separator">|</span>
					<a class="jiathis_button_icons_1"></a>
					<a class="jiathis_button_icons_2"></a>
					<a class="jiathis_button_icons_3"></a>
					<a class="jiathis_button_icons_4"></a>
				</div>
				<script type="text/javascript" src="http://v2.jiathis.com/code/jia.js" charset="utf-8"></script>
				<!-- JiaThis Button END -->
				
				<div class="clearboth"></div>
			</div>
			
			
			<div class="sidebar_widget">
				<h2>公告栏</h2>
				<p>
					心动正在进行功能整改, 包括添加内涵指数排行,花心(心动超过5人)标志, 互相心动等等新功能. 
				</p>
			</div>
			<div class="sidebar_widget">
				<h2>
					<?php 
						if ( is_t_sina_logined() ) : 
							$me = get_user();
					?>
						Hi, <?= $me['profile']['nickname'];?>
						
					<?php else: ?>
						登录 - 用微博帐号
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
						无需在「心动」注册，直接用微博登录。
					</p>
					
					<div class="center">
						<a href="<?=site_url('oauth/authorize_link');?>">
							<img src="<?=static_url('images/t_sina_login_btn.png');?>" />
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
							<img style="margin-bottom:-5px;" height="18" src="<?=static_url('images/youfeel_index.gif');?>" />
							<?=$me['profile']['feel_index'];?>
							
							<div>
								<img style="margin-bottom:-5px;" height="18" src="<?=static_url('images/inner_index.gif');?>" />
								<span><?=$me['profile']['inner_index'];?>%</span>
							</div>
						</div>
						
						<div class="user_widget_control">
							<ul>
								<li>
									<a href="<?=site_url('user/show_xindong');?>" title="将「心动」介绍给你的朋友，大家齐齐幸福。" class="btn tooltip">
										<span><span>分享到微博</span></span>
									</a>
								</li>
								<li>
									<a class="tooltip icon icon_back" title="返回你的新浪微博页面" href="http://t.sina.com.cn/<?=$me['t_sina_id'];?>">
										回到微博
									</a>
								</li>

								<li>
									<a class="tooltip icon icon_setting" title="设置你的个人资料"  href="<?=site_url('user/setting');?>">资料设置</a>
								</li>
								<li>
									<a class="tooltip icon icon_face" title="更换你的个人头像"  href="<?=site_url('user/set_avatar');?>">更换照片</a>
								</li>
								
								<li>
									<a class="tooltip icon icon_favorite" title="你的心动收藏夹" href="<?=site_url('user/favorites');?>">
										心动收藏
									</a>
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
			
			
			<div class="sidebar_widget">
				<h2>缘分天注定</h2>
				<div class="sidebar_widget_content center">
					<div>
						让上天赐你一位心动对象
					</div>
					<a href="<?=site_url('user/random');?>" class="tooltip btn" title="随机匹配一位对象，看缘分了！">
						<span><span>随缘吧</span></span>
					</a>
				</div>
			</div>
			
			<?php if ( is_t_sina_logined() ): ?>
			<div class="sidebar_widget">
				<h2>邀请朋友</h2>
				
				<div class="sidebar_widget_content">
					<?php
						$ci =& get_instance();
						$ci->load->library('t_sina');
						
						$friends = $ci->t_sina->getFriends(10);
						
						foreach ( $friends as $f ) :
					?>
					<div>
						<img src="<?=$f['profile_image_url'];?>" width="25" />
						<?=$f['screen_name'];?>
						<a target="_blank" class="btn" href="<?=site_url('about/invite_friend/'. $f['id'] );?>">
							<span><span>邀请他</span></span>
						</a>
					</div>
					
					<?php
						endforeach;
					?>
					<!-- 

					<p>
						输入对方的微博名字,你的心动对象会收到邀请哦
					</p>
					<p>
						<form method="post" action="<?=site_url('about/invite_specify');?>">		
							<label>对方微博名称</label>
							<input type="text" name="screen_name" />
							<button type="submit" class="btn">
								<span><span>邀请他</span></span>
							</button>
						</form>
					</p>
 -->
				</div>
				
				
				
			</div>
			<?php endif; ?>