<?php
	$this->load->view('header');
?>

<div id="content">

	
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
			<select>
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
			<select>
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
			<select name="province_id">
			
			</select>
		</p>
		
		<p>
			<label>所在城市</label>
			<select name="city_id">
			
			</select>
		</p>
		<p>
			<label>星座</label>
			<select name="constellation">
				
			</select>
		</p>
		
		<p>
			<label>相貌</label>
			<select name="face">
				
			</select>
		</p>
		<p>
			<label>身形</label>
			<select name="figure">
			
			</select>
		</p>
		
		<p>
			<label>交友目的</label>
			<select>
				
			</select>
		</p>
	</form>
	
	
</div>

<div id="sidebar">

</div>


<?php
	$this->load->view('footer');
?>