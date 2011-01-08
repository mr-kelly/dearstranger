<?php
	$this->load->view('header');
?>

<div id="content">

	<h2>您的心动收藏夹</h2>

	<?php


		foreach( $f_users as $f ) :
		
			// 获取当前用户对应的省份、城市
			$city = get_city_by_id( $f['favorite_user']['profile']['city_id'], $f['favorite_user']['profile']['province_id'] );
			$province = get_province_by_id ( $f['favorite_user']['profile']['province_id'] );

	?>
		<div class="user_show">
			<div class="user_avatar">
				<a target="_blank" href="<?=site_url('user/'. $f['favorite_user']['id']);?>" title="来自<?=$province['province_name'];?><?=$city['city_name'];?>的<?=$f['favorite_user']['profile']['nickname'];?>">
					<img width="100" src="<?=$f['favorite_user']['profile']['image_url'];?>" />
				</a>
			</div>
			
			<div class="user_intro">
				

				<a target="_blank" class="tooltip" title="来自<?=$province['province_name'];?><?=$city['city_name'];?>的<?=$f['favorite_user']['profile']['nickname'];?>" href="<?=site_url('user/'. $f['favorite_user']['id']);?>">

					<span><?=$province['province_name'];?></span>
					<span><?=$city['city_name'];?></span>
					<br />
					
					
					
					<?=$f['favorite_user']['profile']['nickname'];?>
					
				</a>
				
				<?php // 如果设置了手机，显示手机标志 
					if ( isset( $f['favorite_user']['profile']['phone'] ) && $f['favorite_user']['profile']['phone'] != '' ) :
				?>
				<img width="12" class="tooltip" title="手机绑定用户" src="<?=static_url('images/phoneicon.jpg');?>" />
				<?php
					endif;
				?>
				
				
				<br />
				<img style="margin-bottom: -5px;" src="<?=static_url('images/inner_index.gif');?>" />
				<span><?=$f['favorite_user']['profile']['inner_index'];?>%</span>
				
				
				<br />
				<?php
					//$this->load->view('general/feel_btn_view', array( 'user_id' => $f['favorite_user']['id'] )  );
				?>
				<div>
					<a href="<?=site_url('user/ajax_delete_favorite/'.$f['favorite_user']['id']);?>" class="btn delete_favorite_btn">
						<span><span>从收藏夹删除</span></span>
					</a>
				</div>
			</div>
		</div>
	<?php
		endforeach;
	?>
	<?php
		//print_r( $f_users );
	?>
</div>

<div id="sidebar">
	<?php //$this->load->view('sidebar/user_widget'); ?>
</div>


<?php
	$this->load->view('footer');
?>