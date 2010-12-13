<?php

	class Home extends KK_Controller {
		
		function index() {
			
			

			
			
			$data = array(
				//'random_users' => $random_users,
			);
			
			
			kk_show_view('home/index_view', $data);
			
		}
		
	}