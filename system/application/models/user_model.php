<?php
	
	class User_Model extends KK_Model {
		
		
		/**
		 *	传入新浪微博ID~  将获得对应数据库的用户资料 和 user_profiles
		 */
		function get_user( $t_sina_id ) {
			$query = $this->db->get_where( 'users', array(
				't_sina_id' => $t_sina_id,
			));
			
			$user = $query->result_array();
			$user = $user[0];
			
			// 若存在profile, 赋予profile~
			if ( $this->is_user_profile_existed( array( 'user_id' => $user['id'] )) ) {
				$user['profile'] = $this->get_user_profile( $user['id'] );
			}
			
			// 赋予t_sina api原来的用户信息数组
			// 性能地下，取消这个功能..
			
			//$this->load->library('t_sina');
			//$user['t_sina_profile'] = $this->t_sina->getSelf(); // 知识获得自己
			
			// 赋予有feel指数
			$this->load->model('feel_model');
			$ci =& get_instance();
			$user['feel_index'] = $ci->feel_model->feel_index( $user['id'] );
			
			return $user;
		}
		
		
		
		/**
		 *	根据用户ID,获取数据库中的用户 ( 借助get_user(t_sina_id) )
		 */
		function get_user_by_id( $id ) {
			$query = $this->db->get_where( 'users', array(
				'id' => $id,
			));
			
			$user = $query->result_array();
			$user = $user[0];
			
			return $this->get_user( $user['t_sina_id'] );
		}
		
		function get_user_profile( $user_id ) {
			$query = $this->db->get_where( 'user_profiles', array(
				'user_id' => $user_id,
			));
			
			if ( $query->num_rows() != 0 ) {
				// 有profile
				$user_profile = $query->result_array();
				return $user_profile[0];
			} else {
				// 不存在profile
				return null;
			}
		}
		
		
		/**
		 *	通过城市筛选用户
		 */
		function get_user_by_city( $province_id, $city_id ) {
		
		}
		
		/**
		 *	新浪微博ID号码
		 	Last Key -   OAuth登录成功后的ID
		 */
		function create_user( $t_sina_id, $last_key = '' ) {
			$this->db->insert( 'users', array(
				't_sina_id' => $t_sina_id,
				'last_key' => $last_key,
				'created' => date('Y-m-d H:i:s'),
			));
			
			return $this->db->insert_id();
		}
		
		
		

		
		/**
		 *	用户是否存在, 返回存在数目
		 */
		function is_user_existed( $data ) {
			$query = $this->db->get_where( 'users', $data );
			
			return $query->num_rows();
		}
		
		
		/**
		 *	用户资料是否存在, 返回存在数目
		 */
		function is_user_profile_existed( $data ) {
			$query = $this->db->get_where('user_profiles' , $data ) ;
			
			return $query->num_rows();
		}
		
		/**
		 *	创建user_profile
		 		若已存在过, 则修改
		 */
		function create_or_update_user_profile( $user_id , $data ) {
			// 不存在? 创建
			if ( ! $this->is_user_profile_existed( array( 'user_id'=>$user_id ) ) ) {
				$this->db->insert('user_profiles', array(
					'user_id' => $user_id,
					'created' => date('Y-m-d H:i:s'),
				) + $data );
			} else {
				// 已存在, 修改
				$this->db->where('user_id', $user_id);
				$this->db->update('user_profiles', $data);
				
			}

		}
		
		
		/**
		 *	随机获得user, 并通过用户资料函数，获得资料
		 */
		function get_random_users() {
			$query = $this->db->get('users', 20 );
			$users = $query->result_array();
			
			$return_users = array();
			foreach ( $users as $user ) {
				array_push( $return_users, $this->get_user_by_id( $user['id'] ));
			}
			
			shuffle( $return_users );
			
			return $return_users;
		}
		
		
		
		/**
		 *	搜索引擎，筛选用户
		 * 
		 
		    根据传入的数据，获得指定的用户~  ( $data is Array )
		 */
		function get_users( $data ) {
			$users = $this->db->get_where('user_profiles', $data);
			
			if ( $users->num_rows() != 0 ) {
				$users = $users->result_array();
				
				
				$return_users = array();
				foreach ( $users as $user ) {
					array_push( $return_users, $this->get_user_by_id( $user['user_id'] ) );
				}
				
				return $return_users;
			}
			
			
		}
		
		
		
		
		
		function get_users_by_city( $province_id, $city_id ) {
			$query = $this->db->get_where('user_profiles', array(
				'province_id' => $province_id,
				'city_id' => $city_id,
			));
			$users = $query->result_array();
			
			$return_users = array();
			foreach ( $users as $user ) {
				array_push( $return_users, $this->get_user_by_id( $user['user_id'] ));
			}
			
			shuffle( $return_users );
			return $return_users;
		}
	}