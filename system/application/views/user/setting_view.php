<?php
	$this->load->view('header');
	$ci =& get_instance();
?>
	<script>
		$(function(){
		
			/**
			 *	绑定日期设置控件
			 */
			$('.datepicker').datepicker( {
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd',
				yearRange: '1890:2012',
				monthNamesShort:['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月']
			} );
			

		});
	</script>
	<div id="content">
		<h2>个人资料设置</h2>
		
		<div id="user_setting_avatar" class="center">
			<img width="180" src="<?=$current_user['profile']['image_url'];?>" />
			<br />
			<a href="<?=site_url('user/set_avatar');?>">
				更换头像
			</a>
		</div>
		
		<div id="user_setting">
			<form class="tooltip_form" method="post" action="<?=site_url('user/setting');?>">
				
				<fieldset>
					<legend>基本信息</legend>
					<p>
						<label>昵称</label>
						<input title="建议使用真实名字或便于记忆的名字，让别人更好地记住你哦" type="text" name="nickname" value="<?= isset( $current_user['profile']['nickname'] ) ? $current_user['profile']['nickname'] : $ci->input->get('nickname');?>" />
					</p>
					<p>
						<label>性别:</label>
						<select name="gender">
							<?php
								$genders = $ci->config->item('profile_genders');
								foreach( $genders as $gender ):
							?>
								<option <?= ( $current_user['profile']['gender'] == $gender ) ? 'selected="selected"' : ''; ?>><?=$gender;?></option>
							<?php
								endforeach;
							?>
						</select>
					</p>
					<p>
						<label>生日:</label>
						<input title="系统会自动根据出生年月显示你的年龄、星座哦" class="datepicker" type="text" name="birth" value="<?= isset( $current_user['profile']['birth'] ) ? $current_user['profile']['birth'] : $ci->input->get('birth');?>" />
					</p>
					<p>
						<label>省份</label>
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
						<label>城市</label>
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
					
					<script>
						$(function(){
							$('#school_unit').autocomplete( "<?=site_url('user/ajax_get_units');?>", {
									
							});
						});
					</script>
					<p>
						<label>所在学校/单位</label>
						<input title="填入你所在学校、单位的全称，如:北京师范大学珠海分校，中国移动珠海分公司" id="school_unit" type="text" name="school_unit" value="<?= isset( $current_user['profile']['school_unit'] ) ? $current_user['profile']['school_unit'] : $ci->input->post('school_unit');?>" />
					</p>

				</fieldset>
				
				
		
				
				<fieldset>
					<legend>重要联系方式(<span class="underline">必须双方有feel才会被查看</span>)</legend>
					<p>
						<label>手机</label>
						<input type="text" name="phone" value="<?= isset( $current_user['profile']['phone'] ) ? $current_user['profile']['phone'] : '';?>" />
					</p>
					
					<p>
						<label>QQ</label>
						<input type="text" name="qq" value="<?= isset( $current_user['profile']['qq'] ) ? $current_user['profile']['qq'] : '';?>" />
					</p>
					
					<p>
						<label>MSN</label>
						<input type="text" name="msn" value="<?= isset( $current_user['profile']['msn'] ) ? $current_user['profile']['msn'] : '';?>" />
					</p>
				</fieldset>
				
				<fieldset>
					<legend>个人状态</legend>
					
					<p>
						<label>恋爱状态</label>
						<select name="love">
							<?php
								$loves = $ci->config->item('profile_loves');
								foreach ( $loves as $love ):
							?>
							
							<option <?= ( $current_user['profile']['love'] == $love ) ? 'selected="selected"' : ''; ?>><?=$love;?></option>
							
							<?php
								endforeach;
							?>
						</select>
					</p>

					<p>
						<label>交友目的</label>
						<select name="target">
							<?php
								$targets = $ci->config->item('profile_targets');
								
								foreach ( $targets as $target ):
							?>
								<option <?=( $current_user['profile']['target'] == $target ) ? 'selected="selected"' : ''; ?>><?=$target;?></option>
							<?php
								endforeach;
							?>
							
						</select>
					</p>
					
					<p>
						<label class="top">择偶标准</label>
						<textarea name="standard"><?=$current_user['profile']['standard'];?></textarea>
					</p>
					
					<p>
						<label>个人主页</label>
						<input type="text" name="website" value="<?= isset( $current_user['profile']['website'] ) ? $current_user['profile']['website'] : $ci->input->get('website');?>"  />
					</p>
					
					<p>
						<label>行业</label>
						<select name="job">
							<?php
								$jobs = $ci->config->item('profile_jobs');
								
								foreach ( $jobs as $job ):
							?>
								<option <?=( $current_user['profile']['job'] == $job ) ? 'selected="selected"' : ''; ?>><?=$job;?></option>
							<?php
								endforeach;
							?>
							
						</select>
					</p>
					<p>
						<label>月薪</label>
						<select name="salary">
							<?php
								$salarys = $ci->config->item('profile_salary');
								
								foreach ( $salarys as $salary ):
							?>
								<option <?=( $current_user['profile']['salary'] == $salary ) ? 'selected="selected"' : ''; ?>><?=$salary;?></option>
							<?php
								endforeach;
							?>
						</select>
					</p>
					
				</fieldset>
				
				
				
				
				<fieldset>
					<legend>外形</legend>

					

					<p>
						<label>身高</label>
						<select title="你的身高所处的范围" name="height">
							<?php
								$heights = $ci->config->item('profile_heights');
								
								foreach ( $heights as $height ):
							?>
								<?php // 设定可选项， 读取用户设定项， 并显示 ?>
								<option <?= ( $current_user['profile']['height'] == $height ) ? 'selected="selected"' : ''; ?>><?=$height;?></option>
							<?php
								endforeach;
							?>
						</select>
					</p>
					<p>
						<label>相貌</label>
						<select name="face">
							<?php
								$faces = $ci->config->item('profile_faces');
								
								foreach ( $faces as $face ):
							?>
								<option  <?= ( $current_user['profile']['face'] == $face ) ? 'selected="selected"' : ''; ?>><?=$face;?></option>
							<?php
								endforeach;
							?>
							
						</select>
					</p>
					
					<p>
						<label>身型</label>
						<select name="figure">
							<?php
								$figures = $ci->config->item('profile_figure');
								
								foreach ( $figures as $figure ):
							?>
								<option <?=( $current_user['profile']['figure'] == $figure ) ? 'selected="selected"' : ''; ?>><?=$figure;?></option>
							<?php
								endforeach;
							?>
						</select>
					</p>
					
				</fieldset>
				
				<fieldset>
					<legend>内在</legend>
					<p>
						<label>特长爱好:</label>
						<input type="text" name="hobby" value="<?= isset( $current_user['profile']['hobby'] ) ? $current_user['profile']['hobby'] : $ci->input->get('hobby');?>"  />
					</p>
					
					<p>
						<label>学历</label>
						<select name="education">
							<?php
								$educations = $ci->config->item('profile_education');
								
								foreach ( $educations as $education ):
							?>
								<option <?=( $current_user['profile']['education'] == $education ) ? 'selected="selected"' : ''; ?>><?=$education;?></option>
							<?php
								endforeach;
							?>
							
						</select>
					</p>

					

					<p>
						<label>喜爱书籍</label>
						<input type="text" name="like_books" value="<?= isset( $current_user['profile']['like_books'] ) ? $current_user['profile']['like_books'] : $ci->input->post('like_books');?>"  />
					</p>
					<p>
						<label>喜爱音乐</label>
						<input type="text" name="like_music" value="<?= isset( $current_user['profile']['like_music'] ) ? $current_user['profile']['like_music'] : $ci->input->post('like_music');?>" />
					</p>
					<p>
						<label>喜爱运动</label>
						<input type="text" name="like_sports" value="<?= isset( $current_user['profile']['like_sports'] ) ? $current_user['profile']['like_sports'] : $ci->input->post('like_sports');?>" />
					</p>
					<p>
						<label>喜爱电影</label>
						<input type="text" name="like_movies" value="<?= isset( $current_user['profile']['like_movies'] ) ? $current_user['profile']['like_movies'] : $ci->input->post('like_movies');?>" />
					</p>
					<p>
						<label>喜爱人物</label>
						<input type="text" name="like_personages" value="<?= isset( $current_user['profile']['like_personages'] ) ? $current_user['profile']['like_personages'] : $ci->input->post('like_personages');?>" />
					</p>
					<p>
						<label>座右铭</label>
						<input type="text" name="motto" value="<?= isset( $current_user['profile']['motto'] ) ? $current_user['profile']['motto'] : $ci->input->post('motto');?>" />
					</p>
					
					<p>
						<label class="top">自我介绍</label>
						<textarea name="description"><?=$current_user['profile']['description'];?></textarea>
					</p>
					
				</fieldset>
				
				

				

				

				
				
				
				
				<p>
					<button type="submit" class="btn">
						<span><span>确认修改</span></span>
					</button>
				</p>
				
				
				
			</form>
		</div>
		
		
	</div>
	
	<div id="sidebar">
		<?php $this->load->view('sidebar/user_widget'); ?>
		<?php $this->load->view('sidebar/ranking_widget'); ?>
		<?php $this->load->view('sidebar/feedback_widget'); ?>
	</div>




<?php
	$this->load->view('footer');
?>