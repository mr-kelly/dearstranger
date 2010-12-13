<?php
	$this->load->view('header');
?>

<div id="content">
	<h2>有feel指数排行榜</h2>
	
	<table class="center" width="100%">
			<tr>
				<th colspan="2">名称</th>
				<th>有feel指数</th>
			</tr>
			<?php foreach( $feel_index_ranking_users as $user ): ?>
			<tr>
				<td>
					<img src="<?=$user['profile']['image_url'];?>" width="80" />
				</td>
				<td>
					<a href="<?=site_url('user/'.$user['id']);?>">
						<?=$user['profile']['nickname'];?>
					</a>
				</td>
				<td>
					<?=$user['profile']['feel_index'];?>
				</td>
			</tr>
			<?php endforeach; ?>
	</table>
	<?php print_r( $feel_index_ranking_users );?>
	<div>
		<ul>
			<?php foreach( $feel_index_ranking_users as $user ): ?>
			<li><?=$user['profile']['nickname'];?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>


<?php
	$this->load->view('footer');
?>