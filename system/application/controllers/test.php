<?php

	class Test extends KK_Controller {
	
		function index() {
			$this->load->library('t_sina');
			//$weibo = $this->t_sina->getWeibo();
			
			$this->t_sina->reply_last_wb('1215059564', 'test it');
			echo 'ok';
			
			//print_r( $weibo->user_timeline() );
		}
	}