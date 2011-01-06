<?php

	class Test extends KK_Controller {
	
		function index() {
			$this->load->library('t_sina');
					$weibo = $this->t_sina->getWeibo();
					$me = $weibo->verify_credentials();
					print_r( $me );
// 			$this->load->model('user_model');
// 			$user = $this->user_model->get_random_user( array(
// 				'gender' => '男',
// 			) );
// 			print_r( $user );
// 			$this->load->library('Inner_Index');
// 			echo $this->inner_index->get_inner_index( $user['profile'] );
			
// 			$this->load->library('t_sina');
// 			
// 			$f = $this->t_sina->getFriends(10);
// 			$weibo = $this->t_sina->getWeibo();
// 			$weibo->update(date('H:i:s'));
// 			echo 'ok';
// 			$f = $weibo->friends();
// 			
 			//print_r( $f );
						
			//$this->t_sina->reply_last_wb('1215059564', 'test it');
			//echo 'ok';
			
			//print_r( $weibo->user_timeline() );
		}
		
		
		/**
		 *	用户程序修改后更新数据库～
		 */
		function update() {
			
			// 更新用户的内涵指数
			$this->load->library('Inner_Index');
			$query = $this->db->get('user_profiles');
			$user_ps = $query->result_array();
			
			foreach ( $user_ps as $user_p ) {
				$this->db->where('user_id' , $user_p['user_id'] );
				$this->db->update('user_profiles', array(
					'inner_index' => $this->inner_index->get_inner_index( $user_p ),
				));
			}
			
			echo 'users inner index updated!';
			
		}
		
		function get_users_count() {
			$this->load->model('user_model');
			$count = $this->user_model->get_users_count();
			
			echo $count;
		}
	}