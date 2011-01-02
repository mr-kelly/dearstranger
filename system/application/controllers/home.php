<?php

	class Home extends KK_Controller {
		
		function index() {
			
			

			
			
			$data = array(
				'page_title' => '心动恋爱网络 :: 微博交友、恋爱，寻找你心动的恋爱对象、心动的他/她',
			);
			
			
			kk_show_view('home/index_view', $data);
			
		}
		
	}