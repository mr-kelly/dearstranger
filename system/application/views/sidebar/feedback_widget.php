
			<div class="sidebar_widget">
				<h2>
					意见反馈
				</h2>
				
				<div class="sidebar_widget_content">
					<p>
						「心动」是一个属于所有人的网络，在目前初期存在不足，欢迎提出你的宝贵意见。
					</p>
					<form class="tooltip_form" method="post" action="<?=site_url('feedback');?>">
						<?php
							$user = get_user();
						?>
						<input type="hidden" name="user_id" value="<?= ( isset( $user['id'] ) ) ? $user['id'] : 0 ;?>" />
						<textarea title="输入你对「心动」的建议，将会被取纳进来改善网站哦。" style="width:100%;height:80px;" name="content"></textarea>
						
						<div>
							<button type="submit" class="btn"><span><span>提意见</span></span></button>
						</div>
						
					</form>
				
				</div>

			</div>
			
			
			<div class="sidebar_widget">
				<h2>邀请朋友</h2>
				
				<div class="sidebar_widget_content">
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
				</div>
			</div>