<?php
	$this->load->view('header');
?>

<div id="content">

	<?php 
		// 显示搜索结果...
		if ( $users != null ):
	?>
			<h2>寻觅结果</h2>
	<?php
			$this->load->view('general/users_list_view', array(
				'users_list' => $users, 
				'more_btn' => false,
			));
	?>
	
	<div class="clearboth"></div>

	<div class="center">
		<?=$pagination;?>
	</div>
	<?php
		endif;
	?>
	
	
	
	<h2>寻觅你的意中人</h2>
	<form class="tooltip_form" method="get" action="<?=site_url('search');?>">
		<input type="hidden" name="q" value="true" />
		<p>
			<label>昵称</label>
			<input type="text" name="nickname" />
		</p>
		<p>
			<label>年龄</label>
			<?php
				// 设置几岁到几岁...
			?>
			<select name="from_age">
				<?php
					foreach ( range(1,100) as $num ):
						if ( isset( $_GET['from_age'] )  ):
				?>
				
					<option <?=($_GET['from_age'] == $num) ? 'selected="selected"' : '';?>><?=$num;?></option>
				
				<?php else: ?>
				
					<option <?= ( $num == 18 ) ? 'selected="selected"' : '';?>><?=$num;?></option>
				<?php
						endif;
					endforeach;
				?>
			</select>
			-
			<select name="to_age">
				<?php
					foreach ( range(1,100) as $num ):
						if ( isset( $_GET['to_age'] ) ) :
				?>
					<option <?=($_GET['to_age'] == $num) ? 'selected="selected"' : '';?>><?=$num;?></option>
				<?php else: ?>
					<option <?= ( $num == 25 ) ? 'selected="selected"' : '';?>><?=$num;?></option>
				<?php
						endif;
					endforeach;
				?>
			</select>岁
			
		</p>
		
		<p>
			<label>星座</label>
			<select name="constellation">
				<option value="">随便</option>
				<?php
					$ci =& get_instance();
					foreach( $ci->config->item('profile_constellation') as $c ) : 
						if ( isset( $_GET['constellation'] ) ):
				?>
					<option <?=($_GET['constellation'] == $c ) ? 'selected="selected"' : '';?>><?=$c;?></option>
						<?php else: ?>
					<option <?=($current_user['profile']['constellation'] == $c ) ? 'selected="selected"' : ''; ?>><?=$c;?></option>
				<?php
						endif;
					endforeach;
				?>
			</select>
		</p>
		<p>
			<label>性别</label>
			<select name="gender">
				<?php if ( isset( $_GET['gender'] ) ): ?>
					<option>男</option>
					<option <?=($_GET['gender'] == '女') ? 'selected="selected"' : '';?>>女</option>
				<?php else: ?>
					<option>男</option>
					<option <?=($current_user['profile']['gender'] !='女' ) ? 'selected="selected"' : '';?>>女</option>
					<?php //登录用户不是女的，默认搜女 ?>

				<?php endif; ?>
			</select>
		</p>
		
		<p>
			<label>所在省份</label>
			<select id="form_province_id" name="province_id">
				<option value="">随便</option>
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
				<option value="">随便</option>
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
			<label>学校/单位</label>
			<input type="text" name="school_unit" />
		</p>
		
		<p>
			<label>恋爱状态</label>
			<select name="love">
				<option value="">随便</option>
				<?php foreach( $ci->config->item('profile_loves') as $love ) : ?>
					<option><?=$love;?></option>
				<?php endforeach; ?>
			</select>
		</p>
		
		<p>
			<label>交友目的</label>
			<select name="target">
				<option value="">随便</option>
				<?php foreach( $ci->config->item('profile_targets') as $target ) : ?>
					<option><?=$target;?></option>
				<?php endforeach; ?>
			</select>
		</p>
		
		<p>
			<label>职业</label>
			<select name="job">
				<option value="">随便</option>
				<?php foreach( $ci->config->item('profile_jobs') as $job ) : ?>
					<option><?=$job;?></option>
				<?php endforeach; ?>
			</select>
		</p>
		
		<p>
			<label>月薪</label>
			<select name="salary">
				<option value="">随便</option>
				<?php foreach( $ci->config->item('profile_salary') as $salary ) : ?>
					<option><?=$salary;?></option>
				<?php endforeach; ?>
			</select>
		</p>
		
		<p>
			<label>身高</label>
			<select name="height">
				<option value="">随便</option>
				<?php foreach( $ci->config->item('profile_heights') as $height ) : ?>
					<option><?=$height;?></option>
				<?php endforeach; ?>
			</select>
		</p>
		
		<p>
			<label>相貌</label>
			<select name="face">
				<option value="">随便</option>
				<?php foreach( $ci->config->item('profile_faces') as $face ) : ?>
					<option><?=$face;?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label>身型</label>
			<select name="figure">
				<option value="">随便</option>
				<?php foreach( $ci->config->item('profile_figure') as $face ) : ?>
					<option><?=$face;?></option>
				<?php endforeach; ?>
			</select>
		</p>
		
		<p>
			<label>学历</label>
			<select name="education">
				<option value="">随便</option>
				<?php foreach( $ci->config->item('profile_education') as $education ) : ?>
					<option><?=$education;?></option>
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