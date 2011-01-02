<div class="sidebar_widget">
	<h2>心动流</h2>
	
	<div class="sidebar_widget_content">
		<?php
			$ci =& get_instance();
			$ci->load->model('feel_model');
			$ci->load->library('Humanize');
			
			$feel_stream = $ci->feel_model->feel_stream();
			
			foreach ( $feel_stream as $s ) :
		?>
		
		<div>
			<a href="<?=site_url('user/'.$s['to_user']['id']);?>">
				<?=$s['to_user']['profile']['nickname'];?>
			</a>
			<?=$ci->humanize->datetime( $s['created'] );?>
			被人心动了
		</div>
		
		<?php
			endforeach;
		?>
	</div>
</div>