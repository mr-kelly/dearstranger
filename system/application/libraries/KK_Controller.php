<?php
	class KK_Controller extends Controller {
	
		function __construct() {
			parent::__construct();
			
			parse_str($_SERVER['QUERY_STRING'],$_GET);
		}
	
	}