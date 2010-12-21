<div class="sidebar_widget">
	<h2>大众有feel</h2>
	
	<div class="sidebar_widget_content">
		<ul class="sidebar_users_list">
			<?php
				$ci =& get_instance();
				$ci->load->model('feel_model');
				$feel_index_ranking_users = $ci->feel_model->feel_index_ranking_users();
				
				foreach ( $feel_index_ranking_users as $user ):
			?>
			
				<li>
					<img src="<?=$user['profile']['image_url'];?>" width="50" />
					<a href="<?=site_url('user/'.$user['id']);?>">
						<?=$user['profile']['nickname'];?>
					</a>
					<a href="#">
						<?=$user['profile']['gender'];?>
					</a>
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
					<?php if ( isset( $user['profile']['age'] ) ): ?>
					<a href="#">
						<?=$user['profile']['age'];?>岁
					</a>
					<?php endif; ?>
				</li>
				
			<?php
				endforeach;
			?>
		</ul>
	</div>
</div>