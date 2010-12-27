<?php

	class User extends KK_Controller {
		
		/**
		 *	缘分天注定！随机到一个用户那里！
		 */
		function random() {
			login_redirect();
			
			
			$this->load->model('user_model');
			$user = $this->user_model->get_random_user();
			redirect( '/user/'. $user['id'] );
		}
		
		function user_lookup( $user_id ) {
			$this->load->model('user_model');
			$user = $this->user_model->get_user_by_id( $user_id );
			
			$data = array( 'user' => $user );
			kk_show_view('user/user_lookup_view', $data );
			
		}
		
		
		/**
		 *	未登录， 提供登录连接， 提示要登录哦！！
		 */
		function login() {
			$data = array();
			kk_show_view('user/login_view', $data);
		}
		
		
		
		/**
		 *	个人头像更换
		 */
		function set_avatar() {
			login_redirect();
			
			$feedback = null;
			$user = get_user(); // 获取当前登录用户
			
			// 确认上传头像~
			if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				// 配置upload库
				$avatar_path = $this->config->item('avatar_path');
				$config['upload_path'] = $avatar_path;
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048';   //可以上传2MB
				$config['max_width']  = '2024';
				$config['max_height']  = '1768';
				$config['overwrite'] = true;  // 覆盖
				//$config['encrypt_name'] = true;
				$config['file_name'] = $user['id'] . '.png' ;
				
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload() ) {
					// 上传失败～ TODO
					$feedback = $this->upload->display_errors();
				} else {
				
					// 上传成功，处理，并转到切图视图
					$upload_data = $this->upload->data();
					$avatar_url = site_url('static/upload/' . $user['id'] . '.png');
					
					// 上传成功，设置用户的头像网址
					$this->load->model('user_model');
					$this->user_model->create_or_update_user_profile( $user['id'], array(
						'image_url' => $avatar_url,
					));
					
					// 图片调整大小
					$img_config = array(
						'image_library' => 'gd2',
						'source_image' => $upload_data['full_path'],
						'maintain_ratio' => true,
						'width' => 640,
						'height' => 480,
					);
					$this->load->library('image_lib', $img_config);
					$this->image_lib->resize();
					
					// 提供一个图片剪切页面~~~ crop picture
					$data = array(
						'upload_data' => $upload_data,
						'avatar_url' => $avatar_url,
					);
					kk_show_view('user/set_avatar_crop_view', $data);

					//print_r( $upload_data );
					//exit();
				}
			}
			
			$data = array(
				'feedback'=> $feedback,
			);
			kk_show_view('user/set_avatar_view', $data );
		}
		
		
		/**
		 *	头像切割~
		 */
		function set_avatar_crop() {
			login_redirect();
			$feedback = null;
			
			$user = get_user();
			$x1 = $this->input->post('x1');
			$y1 = $this->input->post('y1');
			$x2 = $this->input->post('x2');
			$y2 = $this->input->post('y2');
			
			$avatar_file = $this->input->post('avatar_file');
			$avatar_path = $this->config->item('avatar_path');
			
			$width = $x2 - $x1;  // 根据x2, y2确定新图片高度
			$height = $y2 - $y1;
		
			$img_config = array(
				'image_library' => 'gd2',
				'source_image' => $avatar_path .   '/' . $user['id'] .'.png' ,// 用户的头像文件夹所在
				'maintain_ratio' => false,  //要裁剪成正方形～不保持原来比例
				'width' => $width,
				'height' => $height,   
				
				'x_axis'=> $x1,
				'y_axis'=>$y1,
				'create_thumb' => false,
			);
			
			$this->load->library('image_lib', $img_config);
			if ( !$this->image_lib->crop($x1, $y1)) {   // 裁剪！
				$feedback = $this->image_lib->display_errors();
			} else {
				$feedback = '头像设置成功！';
				

			}		
			
			$data = array(
				'feedback' => $feedback,
			);	
			kk_show_view('user/set_avatar_crop_success_view', $data);
		}
		
		
		/**
		 *	将头像设置成微博默认头像
		 */
		function set_avatar_default() {
			login_redirect();
			
			$user = get_user();
			
			$this->load->model('user_model');
			$this->load->library('t_sina');
			$t_sina_profile = $this->t_sina->getSelf();
			$this->user_model->create_or_update_user_profile( $user['id'], array(
				'image_url' => str_replace( '/50/', '/180/', $t_sina_profile['profile_image_url']) ,
			));
			
			
			redirect('/');
		}
		
		
		/**
		 *	个人设置
		 */
		function setting() {
			login_redirect();
			
			$feedback = $this->input->get('feedback');
			
			$current_user = get_user();
			// 提交的数据,进行profile setting处理
			if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				
				$this->form_validation->set_rules('nickname','nickname', 'xss_clean|required');
				
				$this->form_validation->set_rules('province_id','province_id', 'xss_clean|trim|integer');
				$this->form_validation->set_rules('city_id','city_id', 'xss_clean|trim|integer');
				
				$this->form_validation->set_rules('love','love status', 'xss_clean|trim');
				$this->form_validation->set_rules('birth','birth', 'xss_clean|trim');
				$this->form_validation->set_rules('gender','gender', 'xss_clean|trim');
				$this->form_validation->set_rules('height','height', 'xss_clean|trim');
				$this->form_validation->set_rules('face','face', 'xss_clean|trim');
				$this->form_validation->set_rules('phone','phone', 'xss_clean|trim|integer');
				$this->form_validation->set_rules('qq','qq', 'xss_clean|trim|integer');
				$this->form_validation->set_rules('msn', 'msn', 'xss_clean|trim');
				$this->form_validation->set_rules('website','website', 'xss_clean|trim');
				$this->form_validation->set_rules('target','target', 'xss_clean|trim');
				$this->form_validation->set_rules('hobby','hobby', 'xss_clean|trim');
				$this->form_validation->set_rules('description','description', 'xss_clean|trim');
				
				$this->form_validation->set_rules('education', '教育', 'xss_clean|trim');
				$this->form_validation->set_rules('job', '职业', 'xss_clean|trim');
				$this->form_validation->set_rules('salary', '月薪', 'xss_clean|trim');
				$this->form_validation->set_rules('figure', '体型', 'xss_clean|trim');
				$this->form_validation->set_rules('like_books', '喜爱书籍', 'xss_clean|trim');
				$this->form_validation->set_rules('like_music', '喜爱音乐', 'xss_clean|trim');
				$this->form_validation->set_rules('like_sports', '喜爱运动', 'xss_clean|trim');
				$this->form_validation->set_rules('like_movies', '喜爱电影', 'xss_clean|trim');
				$this->form_validation->set_rules('like_personages', '喜爱人物', 'xss_clean|trim');
				$this->form_validation->set_rules('motto', '座右铭', 'xss_clean|trim');
				$this->form_validation->set_rules('school_unit', '学校/单位', 'xss_clean|trim');
				$this->form_validation->set_rules('standard', '择偶标准', 'xss_clean|trim');
				
				
				
				
				if ( !$this->form_validation->run() ) {
					// 表单验证失败~?
					$feedback .= validation_errors();
				} else {
					// 创建 或 修改 user profile
					$this->load->model('user_model');
					$this->load->library('Humanize');
					//判断, 不存在profile, 创建 或 修改 ~
					
					$this->user_model->create_or_update_user_profile( $current_user['id'],  array(

						
						// 学校单位可auto complete~以后
						'school_unit' => $this->form_validation->set_value('school_unit'),
						
						// Profile Conetent ， 所有profile字段为json储存在数据库!
						'content' => json_encode( array(
							'nickname' => $this->form_validation->set_value('nickname'),
							'province_id' => $this->form_validation->set_value('province_id'),
							'city_id' => $this->form_validation->set_value('city_id'),
							'birth' => $this->form_validation->set_value('birth'),
							'love' => $this->form_validation->set_value('love'),  // 恋爱状态
							'gender' => $this->form_validation->set_value('gender'),
							'height' => $this->form_validation->set_value('height'),
							'face' => $this->form_validation->set_value('face'),
							'phone' => $this->form_validation->set_value('phone'),
							'qq' => $this->form_validation->set_value('qq'),
							'msn' => $this->form_validation->set_value('msn'),
							'website' => $this->form_validation->set_value('website'),
							'target' => $this->form_validation->set_value('target'),
							'hobby' => $this->form_validation->set_value('hobby'),
							'description' => $this->form_validation->set_value('description'),
							
							'education' => $this->form_validation->set_value('education'),
							'job' => $this->form_validation->set_value('job'),
							'salary' => $this->form_validation->set_value('salary'),
							'figure' => $this->form_validation->set_value('figure'),
							'like_books' => $this->form_validation->set_value('like_books'),
							'like_music' => $this->form_validation->set_value('like_music'),
							'like_sports' => $this->form_validation->set_value('like_sports'),
							'like_movies' => $this->form_validation->set_value('like_movies'),
							'like_personages' => $this->form_validation->set_value('like_personages'),
							'motto' => $this->form_validation->set_value('motto'),
							'standard' => $this->form_validation->set_value('standard'),
							
							
							
							// 自动生成的
							'constellation' => $this->humanize->constellation( $this->form_validation->set_value('birth') ),
							'age' => $this->humanize->age( $this->form_validation->set_value('birth') ),
						)),
					) );
					
					//添加user_units, 用于autocomplete
					$this->load->model('unit_model');
					$this->unit_model->add(array(
						'name' => $this->form_validation->set_value('school_unit'),
					));
					$feedback .= '<p>用户资料已成功修改!</p>';

					
				}
				
			}
			$current_user = get_user();
			// 传入current_user资料, 用于在表单上默认值显示
			$data = array( 'current_user' => $current_user, 'feedback' => $feedback );
			kk_show_view('user/setting_view', $data);
			
		}
		
		
		/**
		 *	随机获取用户~ 返回ajax页
		 */
		function ajax_random_users() {
			$this->load->model('user_model');
			$random_users = $this->user_model->get_random_users();
			
			
			kk_show_view('general/users_list_view', array( 'users_list'=>$random_users,)) ;
		}
		
		/**
		 *	获得同城的用户
		 */
		function ajax_get_users_by_city( $province_id, $city_id ) {
			$this->load->model('user_model');
			$city_users = $this->user_model->get_users_by_city( $province_id, $city_id );
			
			kk_show_view('general/users_list_view', array( 'users_list'=>$city_users)) ;
		}
		/**
		 *	获取当前登录用户，  谁对他有feel的 ajax显示页
		 			$more_btn ～  是否显示“寻找更多”按钮
		 */
		 function ajax_from_feel() {
		 	login_redirect();
		 	
		 	$current_user = get_user();
		 	
		 	$this->load->model('feel_model');
		 	$from_feel_user = $this->feel_model->from_feel_people( $current_user['id'] );
		 	
		 	kk_show_view('general/users_list_view', array( 'users_list' => $from_feel_user,'more_btn'=>false, ) );
		 	
		 	
		 }
		 
		 /**
		  *	当前登录用户，对谁有feel～
		  */
		 function ajax_to_feel() {
		 	login_redirect();
		 	$current_user = get_user();
		 	
		 	$this->load->model('feel_model');
		 	$to_feel_user = $this->feel_model->to_feel_people( $current_user['id'] );
		 	
		 	kk_show_view('general/users_list_view', array( 'users_list' => $to_feel_user, 'more_btn'=>false, ) );
		 	
		 }
		 
		 
		/**
		 *	添加、删除，有feel状态， 评论通知对方
		 			当双方mutual有feel，评论双方有feel
		 			
		 				添加有feel时，评论对方最后1，2条微博，以提醒对方被人feel了～
		 */
		function ajax_feel( $user_id ) {
			// 未登录，返回失败ajax
			if ( !is_t_sina_logined() ) {
				ajaxReturn( null, '你尚未授权你的微博帐号', 0 );
			}
			$this->load->model('feel_model');
			$this->load->model('user_model');
			
			$current_user = get_user();
			$target_user = $this->user_model->get_user_by_id( $user_id );
			
			//echo $this->feel_model->add_feel( $current_user['id'], $user_id );
			
			if ( $this->feel_model->add_feel( $current_user['id'], $user_id ) ) {
				
				/**
				 *  对被feel的对方发一条微博评论提醒  *******!!!
				 */
				$this->load->library('t_sina');
				
				// 微博提醒文字
				$reply_text = sprintf( $this->config->item('comment_when_feel') , $current_user['profile']['nickname'], site_url('user/' . $current_user['id']) );
				$this->t_sina->reply_last_wb( $target_user['t_sina_id'], $reply_text );
				
				
				
				
				// 当发现双方双爱..TODO
				
				// 添加有feel
				ajaxReturn(array('status'=>'add'), 's成功有feel对方！', 1);
				
			} else {
				// 有feel过？取消feel！
				$this->feel_model->delete_feel( $current_user['id'], $user_id ) ;
				
				ajaxReturn( array('status'=>'delete'), 'd删除有feel对方！', 1);
			}
			
		}
		
		
		
		function ajax_get_cities( $province_id ) {
			$this->load->model('location_model');
			$cities = $this->location_model->get_cities( $province_id );
			
			
			$return = '';
			
			foreach ( $cities as $city ) {
				//$add_txt = sprintf( '<option value="%s">%s</option>' ,  $city['city_id'],  $city['city_name'] );
				
				$return .= sprintf('<option value="%s">%s</option>', $city['city_id'], $city['city_name'] );
			}
			
			
			echo $return;
		}
		
		
		
		
		/**
		 *	返回一个文本+回车 集， 用于jquery autocomplete
		 */
		function ajax_get_units() {
			$this->load->model('unit_model');
			$units = $this->unit_model->get();
			
			$q = strtolower($_GET["q"]);
			if (!$q) return;
			
			
			$result = array();
			
			foreach( $units as $key=>$unit ) {
				//array_push( $result, $unit['name'] );
				$unit_name = $unit['name'];
				if ( strpos( strtolower($unit_name), $q ) !== false ) {
					echo "$unit_name\n";
				}
			}
			
			//echo json_encode( $result );
		}
	}