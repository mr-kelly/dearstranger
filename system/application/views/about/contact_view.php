<?php
	$this->load->view('header');
?>

<div id="content">
	<h2>联系我们</h2>
	<p>
		邮箱: <a href="mailto:chepy.v@gmail.com?subject=Hi,「Single Club」">chepy.v@gmail.com</a>
	</p>
	<p>
		微博:<a href="http://t.sina.com.cn/wbsingleclub">@SingleClub</a>
	</p>
</div>


	<div id="sidebar">
		<?php
			$this->load->view('sidebar/about_widget');
		?>		
		<?php
			$this->load->view('sidebar/feedback_widget');
		?>
	</div>
<?php
	$this->load->view('footer');
?>