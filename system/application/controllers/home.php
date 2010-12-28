<?php

	class Home extends KK_Controller {
		
		function index() {
			
			

			
			
			$data = array(
				'page_title' => '心动 :: 微博交友、恋爱，寻找你心仪的恋爱对象、寻找心动的他/她',
			);
			
			
			kk_show_view('home/index_view', $data);
			
		}
		
	}