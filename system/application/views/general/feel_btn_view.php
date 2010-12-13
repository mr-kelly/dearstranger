<?php
	/**
	 *	有feel 按钮的复用视图~
	 
	 		其最终结果，就是只生成一个
	 		<a href=....></a>
	 */
?>


			<?php
				// 这里注意， 不是使用!=， 复杂的逻辑关系.....
				//echo is_feel( $user_id );  用来测试
				if ( is_feel( $user_id ) == 'mutual' || is_feel(  $user_id ) == 'from'  ) :
			?>
			<a title="对他/她的没feel了？" onclick="return feel_btn_fn(this);" class="tooltip feel_it unfeel_btn vtip" href="<?=site_url('user/ajax_feel/' .  $user_id );?>">
				<!--unfeel-->
			</a>
			<?php
				elseif ( is_feel(  $user_id ) == 'same' ):
					// 当前用户显示自己， 不显示"有feel"按钮
					
					//////////////////////////
			?>
				
			<?php
				else:
			?>
			
			<a title="对他/她的有feel？果断按下。" onclick="return feel_btn_fn(this);" class="tooltip feel_it feel_btn vtip" href="<?=site_url('user/ajax_feel/' .  $user_id );?>">
				<!--feel it-->
			</a>
			
			<?php
				endif;
			?>
			
			
					
