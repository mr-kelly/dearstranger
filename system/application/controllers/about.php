<?php

	class About extends KK_Controller {
		function index() {
			$data = array();
			
			kk_show_view('about/index_view', $data );
		}
		
		
		function contact() {
			$data = array();
			
			kk_show_view('about/contact_view', $data );
		}
		
		
		/**
		 *	邀请好友!~
		 */
		function invite() {
			login_redirect();
			
			$data = array();
// 			$this->load->library('t_sina');
// 			$weibo = $this->t_sina->getWeibo();
// 			$friends = $weibo->friends();
// 			// 打散数组
// 			shuffle( $friends );
// 			// 将数组割成只有10个元素
// 			$friends = array_chunk( $friends , 10 );
// 			$friends = $friends[0];
// 			
// 			foreach ( $friends as $f ) {
// 				echo sprintf('@%s ', $f['screen_name'] );
// 			}
			
			kk_show_view('about/invite_view', $data );
		}
	}