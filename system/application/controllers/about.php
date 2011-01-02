<?php

	class About extends KK_Controller {
		function index() {
			$data = array(
				'page_title' => '关于「心动」, 起源与介绍'
			);
			
			kk_show_view('about/index_view', $data );
		}
		
		
		/**
		 *	我们的团队
		 */
		function we() {
			$data = array();
			
			kk_show_view( 'about/we_view', $data );
			
		}
		
		// 隐私政策页
		function privacy() {
			$data = array(
				'page_title' => '隐私政策',
			);
			kk_show_view('about/privacy_view', $data);
		}
		function thank() {
			$data = array(
				'page_title' => '鸣谢「心动」走过的一些事，一些人...',
			);
			kk_show_view( 'about/thank_view', $data );
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
			
			kk_show_view('about/invite_view', $data );
		}
		
		
		/**
		 *	指定邀请～  
		 	输入微博名称邀请对方，对方收到一条邀请链接，
		 	
		 	进入这个链接并用微博登录后，
		 	
		 	邀请人会收到微博评论， 对方已经被邀请！～可以到指定页面去 心动她！ yo !
		 */
		function invite_specify() {
			login_redirect();
			
			$feedback = null;
			
			if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				
				$this->form_validation->set_rules('screen_name', '微博名字', 'required|xss_clean|trim');
				
				if ( ! $this->form_validation->run() ) {
					// 表单验证失败
					$feedback = '你还没填对方名字吧？';
				} else {
					//$screen_name = $this->form_validation->set_value('screen_name');
					//exit();
					
					$this->load->library('t_sina');
					$current_user = get_user();
					
					// 在指定微博名称发评论~
					$this->t_sina->reply_last_wb( 
										$this->form_validation->set_value('screen_name'), 
										sprintf( $this->config->item('invite_specify'), $this->config->item('formal_url').site_url('oauth/authorize_link'). '?invited_by=' . $current_user['t_sina_id'] )
										// 这个链接: 用户来到心动后， 告诉邀请者，你邀请的人已经接受邀请了！ 
									);
					
					$feedback = '你已经成功邀请对方了哦！';
					
					
					
				}
			}
			$data = array(
				'feedback' => $feedback,
			);
			kk_show_view('general/general_view', $data);
		}
		
		/**
		 *	随机邀请一些朋友~ 在他们那里留言~
		 */
		function invite_somebody() {
			login_redirect();
			$this->load->library('t_sina');
			$friends = $this->t_sina->getFriends(10);
			
			
			$current_user = get_user();
			
			
			foreach( $friends as $f ) {
				$this->t_sina->reply_last_wb( $f['id'], 
											sprintf('你的朋友"%s"邀请你加入「心动」恋爱交友微博应用, 按这里~%s', $current_user['profile']['nickname'], $this->config->item('formal_url') ));
			}
			
			$feedback = '你已经成功邀请了10名关注的朋友！';
			
			$data = array(
				'feedback' => $feedback,
			);
			kk_show_view('general/general_view', $data );
			
			
		}
		
		function invite_weibo() {
			$feedback = null;
			if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
			
				$this->form_validation->set_rules('content', '微博内容', 'required|xss_clean|trim');
				
				if ( ! $this->form_validation->run() ) {
					$feedback .= '你填的微博内容有误！请检查～';		
				} else {
					$this->load->library('t_sina');
					$weibo = $this->t_sina->getWeibo();
					
					$weibo_update = $weibo->update( $this->form_validation->set_value('content') );
					//print_r( $weibo_update );
					//echo $this->form_validation->set_value('content');
					$feedback .= '你的微博已发布成功！谢谢！';
				}
				
				
			}
			
			$data = array(
				'feedback' => $feedback,
			);
			
			kk_show_view('general/general_view', $data );
		}
		
		
		
		
	}