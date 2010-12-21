<?php
	$this->load->view('header');
?>

<div id="content">

	<?php
		print_r( $_GET );
	?>
	<?php 
		// 显示搜索结果...
		if ( $users != null ):
			foreach( $users as $user ) : 
	?>
	
			<?=$user['profile']['nickname'];?>
		
	<?php
			endforeach; 
		endif;
	?>
	
	
	
	<h2>寻觅你的意中人</h2>
	<form class="tooltip_form">
		<p>
			<label>年龄</label>
			<?php
				// 设置几岁到几岁...
			?>
			<select name="from_age">
				<?php
					foreach ( range(1,100) as $num ):
				?>
				
					<option <?= ( $num == 18 ) ? 'selected=selected' : '';?>>
						<?=$num;?>
					</option>
				<?php
					endforeach;
				?>
			</select>
			-
			<select name="to_age">
				<?php
					foreach ( range(1,100) as $num ):
				?>
				
					<option <?= ( $num == 25 ) ? 'selected=selected' : '';?>>
						<?=$num;?>
					</option>
				<?php
					endforeach;
				?>
			</select>岁
			
		</p>
		
		
		<p>
			<label>性别</label>
			<select name="gender">
				<option>男</option>
				<option>女</option>
			</select>
		</p>
		
		<p>
			<label>所在省份</label>
			<select id="form_province_id" name="province_id">
				<?php
					$ci =& get_instance();
					$ci->load->model('location_model');
					$provinces = $ci->location_model->get_provinces();
					
					foreach( $provinces as $prov ):
				?>
					<option <?=( $current_user['profile']['province_id'] == $prov['id'] ) ? 'selected="selected"' : '' ;?> value="<?=$prov['id'];?>"><?=$prov['province_name'];?></option>
				<?php
					endforeach;
				?>
			</select>
		</p>
		
		<p>
			<label>所在城市</label>
			<select id="form_city_id" name="city_id" />
				<?php
					
					// 先判断当前用户设置，是否已经设置省份， 设置了， 根据省份读取 省份所有城市
					if ( isset( $current_user['profile']['province_id'] ) ) {
						$cities = $ci->location_model->get_cities( $current_user['profile']['province_id'] );
					} else {
						$cities = $ci->location_model->get_cities();
					}
					
					foreach ( $cities as $city ):
				?>
					<option <?=( $current_user['profile']['city_id'] == $city['city_id'] ) ? 'selected="selected"' : '' ;?> value="<?=$city['city_id'];?>"><?=$city['city_name'];?></option>
				
				<?php
					endforeach;
				?>
			</select>
		</p>
		<p>
			<label>星座</label>
			<select name="constellation">
				<?php foreach( $ci->config->item('profile_constellation') as $face ) : ?>
					<option><?=$face;?></option>
				<?php endforeach; ?>
			</select>
		</p>
		
		<p>
			<label>相貌</label>
			<select name="face">
				<?php foreach( $ci->config->item('profile_faces') as $face ) : ?>
					<option><?=$face;?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label>身形</label>
			<select name="figure">
				<?php foreach( $ci->config->item('profile_figure') as $face ) : ?>
					<option><?=$face;?></option>
				<?php endforeach; ?>
			</select>
		</p>
		
		<p>
			<label>交友目的</label>
			<select>
				<?php foreach( $ci->config->item('profile_targets') as $face ) : ?>
					<option><?=$face;?></option>
				<?php endforeach; ?>
			</select>
		</p>
		
		<p>
			<button class="btn" type="submit">
				<span><span>搜索</span></span>
			</button>
		</p>
	</form>
	
	
</div>

<div id="sidebar">

</div>


<?php
	$this->load->view('footer');
?>