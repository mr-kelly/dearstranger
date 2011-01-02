<?php
	
	class User_Model extends KK_Model {
		
		
		/**
		 *	传入新浪微博ID~  将获得对应数据库的用户资料 和 user_profiles
		 */
		function get_user( $t_sina_id ) {
			$query = $this->db->get_where( 'users', array(
				't_sina_id' => $t_sina_id,
			));
			
			$user = $query->row_array();
			
			// 若存在profile, 赋予profile~
			if ( $this->is_user_profile_existed( array( 'user_id' => $user['id'] )) ) {
				$user['profile'] = $this->get_user_profile( $user['id'] );
				//$profile_content = json_decode( $user['profile']['content'], true );
				//$user['profile'] = array_merge( $user['profile'], (array)$profile_content );
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
			
			$user = $query->row_array();
			
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
				$this->load->library('Inner_Index');
				
				// 先获取现有用户的profile，用于更新“内涵指数”
				$query = $this->db->get_where('user_profiles', array(
					'user_id' => $user_id,
				));
				$profile = $query->row_array();
				
				$this->db->where('user_id', $user_id );
				$this->db->update('user_profiles', $data + array(
					// 更新用户的内涵指数
					'inner_index' => $this->inner_index->get_inner_index( $profile ),
				));
				
				
				
			}

		}
		
		/**
		 *	用户的页面查看量+1！
		 */
		function up_user_page_view( $user_id ) {
			$current_user_page_view = $this->get_user_page_view($user_id);
			$this->db->where('user_id', $user_id );
			return $this->db->update('user_profiles', array(
				'page_view' => ( $current_user_page_view +1 ),
			));
		}
		/**
		 *	获取用户页面查看量~
		 */
		function get_user_page_view( $user_id ) {
			$query = $this->db->get_where('user_profiles', array(
				'user_id' => $user_id,
			));
			$user_p = $query->row_array();
			
			return $user_p['page_view'];
		}
		
		/**
		 *	随机获得user, 并通过用户资料函数，获得资料
		 */
		function get_random_users() {
			$this->db->order_by('id', 'random');
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
		 *	获得一些推荐用户~
		 
				根据性别、城市、其他资料等随机推荐
		 */
		function get_recommend_users( $which ) {
			$this->db->order_by('id', 'random');
			$this->db->like( $which );
			$query = $this->db->get('user_profiles', 10 );
			
			$users = $query->result_array();
			$return_users = array();
			foreach( $users as $user ) {
				array_push( $return_users, $this->get_user_by_id( $user['user_id'] ));
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
		
		
		
		
		
		function get_users_by_city( $province_id, $city_id, $limit=null, $offset=null ) {
			$this->db->limit( $limit, $offset );
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
		
		
		/**
		 *	随机获得一个用户
		 */
		function get_random_user( $data ) {
			$this->db->order_by('id', 'random');
			$this->db->limit( $this->config->item('per_page') );
			$query = $this->db->get_where('user_profiles', $data );
			
			$user = $query->row_array();
			$user = $this->get_user_by_id( $user['user_id'] );
			
			return $user;
		}
		
		
		/**
		 *	搜索用户, 用like，返回数组
		    $data = array(
		    	'age' => array(
		    		'from_age' => '',
		    		'to_age' => '',
		    	),
		    	'search' => array(),
		    );
		 */
		function search_users( $data, $limit=null, $offset=null, $is_count=false ) {
		
			
			// 搜索结果根据心动指数
			$this->db->order_by('feel_index','desc');
			$this->db->where('age > ', $data['age']['from_age'] );
			$this->db->where('age < ', $data['age']['to_age'] );
			$this->db->where( array(
				'age > ' => $data['age']['from_age'],
				'age < ' => $data['age']['to_age'],
			));
			
			// 根据年龄段搜索，如果没有，就返回null，不继续了
			$query = $this->db->get('user_profiles');				
			if ( $query->num_rows() == 0 ) {
				return array();
			}
			
			$this->db->limit($limit, $offset);
			$this->db->like( $data['search'] );
			$query = $this->db->get('user_profiles');
			
				// 如果is_count, 返回影响的数据数~  返回profile数
				if ( $is_count ) {
					return $query->num_rows();
				}
			
			$return = array();
			if ( $query->num_rows() != 0 ) {
				foreach ( $query->result_array() as $user ) {
					array_push( $return, $this->get_user_by_id( $user['user_id'] ) );
				}
			}
			
			return $return;
		}
		
		/**
		 *	返回搜索用户的影响数字~ 返回用户的数量
		 */
		function search_users_count($data ) {
			return $this->search_users( $data, null, null, true );
		}
		

	}