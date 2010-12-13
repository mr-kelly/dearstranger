<?php

	class Feel_Model extends KK_Model {
		
		
		
		
		
		/**
		 *	有feel指数， 多少人对他、她有feel
		 */
		function feel_index( $user_id ) {
			$query = $this->db->get_where('feel' , array(
				'to_user_id' => $user_id,
			));
			
			return $query->num_rows();
		
		}
		
		
		/**
		 *	有feel指数排行~~  获得有feel指数最高的~
		 */
		function feel_index_ranking_users() {
		
			$this->load->model('user_model');
			$ci =& get_instance();
			
			// 获得profile
			$this->db->order_by('feel_index desc');
			$query = $this->db->get('user_profiles', 10);
			
			$users = $query->result_array();
			
			
			// 分别get_user
			$return_users = array();
			
			foreach( $users as $user ) {
				array_push( $return_users, $ci->user_model->get_user_by_id( $user['user_id'] ) );
			}
			
			return $return_users;
		}
		
		/**
		 *	获得该用户， 有feel 的对象
		 */
		function to_feel_people( $user_id ) {
			$query = $this->db->get_where('feel', array(
				'from_user_id' => $user_id, 
			));
			
			$to_feel = $query->result_array();
			
			// 获取那些用户的信息
			$users = array();
			$this->load->model('user_model');
			foreach ( $to_feel as $to_feel_id ) {
				array_push( $users, $this->user_model->get_user_by_id( $to_feel_id['to_user_id'] ) );
			}
			
			return $users;
		}
		
		/**
		 *	获得对该用户有feel的用户
		 */
		function from_feel_people( $user_id ) {
			$query = $this->db->get_where( 'feel', array(
				'to_user_id' => $user_id, 
			));
			
			$from_feel = $query->result_array();
			
			// 获取那些用户的信息
			$users = array();
			$this->load->model('user_model');
			foreach ( $from_feel as $from_feel_id ) {
				array_push( $users, $this->user_model->get_user_by_id($from_feel_id['from_user_id']) );
			}
			
			return $users;
		}
		
		/**
		 *	添加一个'有feel',]
		 *
		 */
		function add_feel( $from_user_id , $to_user_id ) {
			// 检查是否已经存在关系， 那么不插入
			$query = $this->db->get_where('feel', array(
				'from_user_id' => $from_user_id,
				'to_user_id' => $to_user_id,
			));
			
			if ( $query->num_rows != 0 ) {
				// 已存在
				return false;
			}
			
			
			// 没存在，add吧
			$this->db->insert('feel', array(
				'from_user_id' => $from_user_id,
				'to_user_id' => $to_user_id,
				'created' => date('Y-m-d H:i:s'),
			));
			
			// user_profile 的 feel_index 加1
			$user_profile = $this->db->get_where('user_profiles', array(
				'user_id' => $to_user_id,
			))->result_array();
			$user_profile = $user_profile[0];
			
			$this->db->where('user_id', $to_user_id);
			$this->db->update('user_profiles', array(
				'feel_index' => $user_profile['feel_index']+1,
			));
			
			
			
			
			return true;
		}
		
		
		
		function delete_feel( $from_user_id, $to_user_id ) {
			// 检查是否存在，不存在，不做事
			$query = $this->db->get_where('feel', array(
				'from_user_id' => $from_user_id,
				'to_user_id' => $to_user_id,
			));
			if ( $query->num_rows() == 0 ) {
				// 不存在!
				return false;
			}
			
			// 开始删除~
			$this->db->delete('feel', array(
				'from_user_id' => $from_user_id,
				'to_user_id' => $to_user_id,
			));
			
			// user_profile feel_index -1 !! 人气指数要减！！
			$user_profile = $this->db->get_where('user_profiles', array(
				'user_id' => $to_user_id,
			))->result_array();
			$user_profile = $user_profile[0];
			
			$this->db->where('user_id', $to_user_id);
			$this->db->update('user_profiles', array(
				'feel_index' => $user_profile['feel_index']-1,
			));
			 
			
			return true;
			
			
			
		}
		
		/**
		 *	是否互相设置 有feel ， 分4种状态
		 
		 		 - 0、false  没feel
		 		 - from      from对to有feel
		 		 - to 	     to对from有feel
		 		 - mutual	 互相有feel
		 */
		function is_feel( $from_user_id, $to_user_id ) {
			
			// 如果from_id = to_id,  返回 'same', 代表，同一个人
			if ( $from_user_id == $to_user_id ) {
				return 'same';
			}
			
			// 先看from对to有没feel
			$from_to = $this->db->get_where('feel', array(
				'from_user_id' => $from_user_id,
				'to_user_id' => $to_user_id,
			));
			
			// to 对 from 有没feel 
			$to_from = $this->db->get_where('feel', array(
				'from_user_id' => $to_user_id,
				'to_user_id' => $from_user_id,
			));

			if ( $from_to->num_rows() == 0 ) {
				// from 对 to 没feel, 看看to 对from 有没feel
				if ( $to_from->num_rows() == 0 ) {
					// to 对 from也没feel？ 互相没feel！！返回0 , false
					return false;
				} else {
					// to 对 from 有feel
					return 'to';
				}
				
			} else {
				// from 对 to 有feel， 看看是否双方都有feel
				if ( $to_from->num_rows() == 0 ) {
					// 看来 to对from没feel，  返回from有feel
					return 'from';
				} else {
					// 那么双方都有feel了！！
					return 'mutual';
				}
			}
		}
		
		
		/**
		 *	双方是否存在feel
		 */
// 		function is_from_to_feel( $from_user_id , $to_user_id ) {
// 		
// 			
// 			$query = $this->db->get_where('feel', array(
// 				'from_user_id' => $from_user_id,
// 				'to_user_id' => $to_user_id,
// 			));
// 			
// 			if ( $query->num_rows() != 0 ) {
// 				// 存在有feel
// 				return true;
// 			} else {
// 				// 互相没feel
// 				return false;
// 			}
// 		}
		
		
		
		
	}