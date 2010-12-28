<?php

	class Test extends KK_Controller {
	
		function index() {
			$this->load->library('t_sina');
			
			$f = $this->t_sina->getFriends(10);
			// $weibo = $this->t_sina->getWeibo();
// 			$f = $weibo->friends();
// 			
 			print_r( $f );
			
			//$this->t_sina->reply_last_wb('1215059564', 'test it');
			//echo 'ok';
			
			//print_r( $weibo->user_timeline() );
		}
	}