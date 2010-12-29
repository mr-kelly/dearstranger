<?php
	$this->load->view('header');
?>

<div id="content">
	<?php
		if ( isset( $general_text ) && $general_text != '' ):
	?>
		<h2><?=$general_text;?></h2>
	<?php
		endif;
	?>
</div>


<?php
	$this->load->view('footer');
?>