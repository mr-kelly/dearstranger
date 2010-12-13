<?php
	// KK AjaxReturn, return json and exit
	if ( !function_exists('ajaxReturn')) {
	
		function ajaxReturn($data, $info, $status) {
			$arr = array(
				'data' => $data, 
				'info' => $info,
				'status' => $status,
			);
			
			echo json_encode($arr);
			exit();
			
		}
	}
	
	
	function oauth_callback() {
		$ci =& get_instance();
		return $ci->config->item('oauth_callback');
	}
	
	function is_t_sina_logined() {
		$ci =& get_instance();
		$ci->load->library('T_sina');
		return $ci->t_sina->is_logined();
	}
	
	
	function login_redirect() {
		if ( ! is_t_sina_logined() ) {
			// 未登录, 转走
			redirect('user/login');
		}
	}
	
	
	/**
	 *	判断当前登录用户是否已经"有feel"过另一用户~
	 */
	function is_feel( $user_id ) {
		$ci =& get_instance();
		$ci->load->model('feel_model');
		
		$current_user = get_user();
		
		return $ci->feel_model->is_feel( $current_user['id'], $user_id );
	}
	
	/**
	 *	是否登录过, 
	 	登录了,  抓取 指定 新浪微博ID用户
	 */
	function get_user( $t_sina_id = '') {
		
		
		// 没填参数, 寻找当前用户
		if ( $t_sina_id == '' ) {
			// 通过登录判断函数,获取新浪微博ID 
			$t_sina_id = is_t_sina_logined();
		}
		
		
		if ( $t_sina_id  ) {
			
			$ci =& get_instance();
			$ci->load->model('user_model');
			$current_user = $ci->user_model->get_user( $t_sina_id );
			
			return $current_user;
		}
		
		return null;
	}
	
	
	function get_city_by_id( $city_id , $province_id) {
		$ci =& get_instance();
		$ci->load->model('location_model');
		return $ci->location_model->get_city_by_id( $city_id, $province_id );
	}
	
	function get_province_by_id ( $province_id ) {
		$ci =& get_instance();
		$ci->load->model('location_model');
		return $ci->location_model->get_province_by_id( $province_id );
	}
	
	
	/**
	 *	KK输出视图函数，压缩了HTML
	 */
	function kk_show_view( $view, $data ) {
		$ci =& get_instance();
		$ci->load->plugin('compress_html');
		//$ci->load->plugin('spaceless');
		
		$html = $ci->load->view($view, $data, true);

		// 输出压缩过的html
		echo compress_html( $html );
		//echo $html;
		
		exit();
	}