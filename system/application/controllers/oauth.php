<?php

	class OAuth extends KK_Controller {
		
		
		/**
		 *	OAuth Callback返回
		 
		 		检查用户ID是否存在数据库, 不存在, redirect到第一次登录页
		 								存在,   提示成功!
		 		
		 		$invited_by 被谁邀请~ 邀请后通知已经被邀请
		 */
		function index( $invited_by = null ) {
			
			$this->load->library('T_sina');
			$this->load->model('user_model');
			
			$last_key = $this->t_sina->getAccessToken();
			
			if ( $last_key ) {
				// oauth 登录成功~
				$this->session->set_userdata('last_key', $last_key );
				
				// 获取登录帐户的个人资料
				$weibo = $this->t_sina->getWeibo();
				$me = $weibo->verify_credentials();
				
				// 首先要验证 $me 是否登录了的～～
				if ( isset( $me['error_code'] ) ) {
					// 未登录~，session可能滞留了。清空它
					$this->session->unset_userdata('last_key');
					
					//print_r( $me );
					exit('failed! have logined');
					
					// 清空登录数据之后，重新获取一次
					$weibo = $this->t_sina->getWeibo();
					$me = $weibo->verify_credentials();
				}
				
				/** 
				 * 判断微博用户是否已登录过, 未登录过, 创建用户~
				 */
				if ( !$this->user_model->is_user_existed( array( 't_sina_id'=>$me['id'] ) ) ) {
					
					
					$user_id = $this->user_model->create_user( $me['id'] );
					
					// 创建用户后, 填写创建profile
					
					// 微博提供的头像图片太小了， 改成180的
					$image_url = str_replace( '/50/', '/180/', $me['profile_image_url']);
					$this->user_model->create_or_update_user_profile( $user_id, array(
						'image_url' => $image_url,
						'feel_index' => 0,
						//'content' => json_encode( array(
							'nickname' => $me['screen_name'],
							'province_id' => $me['province'],
							'city_id' => $me['city'],
							'description' => $me['description'],
							'gender' => ( $me['gender'] == 'm' ) ? '男' : '女',
							
							'website' => $me['url'],
							'birth' => '',
							'love' => '', // 恋爱状态
							'gender' => '',
							'height' => '',
							'face' => '',
							'phone' => '',
							'qq' => '',
							'msn' => '',
							'target' => '',
							'hobby' => '',

							'education' => '',
							'job' => '',
							'salary' => '',
							'figure' => '',
							'like_books' => '',
							'like_music' => '',
							'like_sports' => '',
							'like_movies' => '',
							'like_personages' => '',
							'motto' => '',
							'standard' => '',
							
						//)),
						
						'school_unit' => '', // 学校,单位要独立开
						
					) );
					
					// 是被邀请的！ 那么告诉邀请人，被邀请人已加入，和被邀人在心动的主页
					if ( $invited_by ) {
						$this->load->library('t_sina');
						$this->t_sina->reply_last_wb( $invited_by , sprintf( $this->config->item('invite_success'), $me['screen_name'], $this->config->item('formal_url').site_url('user/'.$user_id) ) );
					}
					
					// 首次登录！强制宣传吗？
					if ( $this->config->item('force_publicize') ) {
						$this->load->library('t_sina');
						$weibo = $this->t_sina->getWeibo();
						$weib->update( $this->config->item('invite_weibo') );
					}
					
					
					
					// 用户授权成功，首次登录，转到设置页
					redirect('user/setting?feedback=' . '欢迎来到「心动」，为了寻找心动的他/她，请把你的资料填完整哦。');
					echo( 'user not existed, creating <br />');
					
				} else {
					/**
					 *	用户存在了, 转到测试页
					 			但为创建user_profile~ 提供资料填写~
					 */
					 
					 
					 
					redirect( '/' );
					
				}
				
			} else {
				exit( ' oauth failed!?' );
			}
			
			//echo 'success, go test? <a href="oauth/test">Test!</a>';

		}
		
		
		/**
		 *	新浪轉接到新浪授權頁面～
		 
		 		因為oauth_token授權頁面是有時間限制的，所以頁面不刷新後一段時間，用戶按“連接微博”，會出錯，
		 		
		 		所以專門獨設一個action來處理轉接~
		 */
		function authorize_link() {
			$this->load->library('t_sina');
			$authorize_url = $this->t_sina->getAuthorizeURL( 'http://' . $_SERVER["HTTP_HOST"] . site_url('oauth/index') );
			
			
			if ( isset($_GET['invited_by']) ) {
				$authorize_url .= '/' . $_GET['invited_by'] ;
			}
			
			redirect( $authorize_url );
		}
		
		
		function test() {
			$this->load->library('T_sina');
			// $weibo = $this->t_sina->getWeibo();
// 			$timeline = $weibo->user_timeline(); //$weibo->reply('test api weibo');
// 			print_r( $timeline );
// 			$first_wb = $timeline[0];

			$this->t_sina->reply_last_wb('that~ma ' );
			
			
// 			$this->load->library('T_sina');
// 			$weibo = $this->t_sina->getWeibo();
// 			$ms  = $weibo->home_timeline(); // done
// 			
// 			$me = $weibo->verify_credentials(); // 获取自己的信息
// 			if ( isset( $me['error_code'] ) ) {
// 				
// 				echo sprintf('<a href="%s">授权</a>', $this->t_sina->getAuthorizeURL( oauth_callback() ) );
// 			}
// 			print_r( $me );
		}
		
		
		function logout() {
			$this->session->unset_userdata('last_key');
			// 返回首页
			redirect('/');
			echo 'logout!';
		}		
	}