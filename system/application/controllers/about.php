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
	}