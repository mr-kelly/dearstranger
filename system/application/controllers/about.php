<?php

	class About extends KK_Controller {
		function index() {
			$data = array(
				'page_title' => '关于「心动」, 起源与介绍'
			);
			
			kk_show_view('about/index_view', $data );
		}
		
		function join_us() {
			$data = array();
			$feedback = '';
			
			if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				login_redirect();
				
				$this->form_validation->set_rules('content', 'content', 'required|xss_clean|trim');
				
				if ( ! $this->form_validation->run() ) {
					// 表单验证失败
					$feedback = '你的加入意求无法提交，请确定你已经填写了内容。';
					
				} else {
					// 创建feedback
					$current_user = get_user();
					$user_id = $current_user['id'];
					
					$content = $this->form_validation->set_value('content');
					
					$this->load->model('feedback_model');
					$this->feedback_model->create_feedback( $user_id, $content, '加入「心动」' );
					
					$feedback = '你的加入意求已提交，谢谢！';
				}
				
			}
			$data['feedback'] = $feedback;
			
			kk_show_view('about/join_us_view', $data );
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
			
			$data = array(
				'page_title' => '邀请好友，加入「心动」',
			);
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