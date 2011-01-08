<?php
	class Favorite_Model extends KK_Model {
		
		/**
		 *	添加到收藏夹~ 添加喜爱人
		 */
		function add_favorite( $user_id , $favorite_user_id ) {
			// 判断是否存在，存在不添加
			$query = $this->db->get_where('favorites', array(
				'user_id' => $user_id,
				'favorite_user_id' => $favorite_user_id,
			));
			
			if ( $query->num_rows() == 0 ) {
						
				$this->db->insert('favorites', array(
					'user_id' => $user_id,
					'favorite_user_id' => $favorite_user_id,
				));
				
				return $this->db->insert_id();
			} else {
				
				// 存在返回失败，无法添加
				return false;
			}
		}
		
		function get_favorites( $user_id ) {
			$ci =& get_instance();
			$ci->load->model('user_model');
			
			
			$query = $this->db->get_where('favorites', array(
				'user_id' => $user_id,
			));
			
			$favorites = $query->result_array();
			//$return = array()
			foreach ( $favorites as $key=>$f ) {
				$favorites[$key]['favorite_user'] = $ci->user_model->get_user_by_id( $f['favorite_user_id'] );

			}
			
			return $favorites;
			
		}
		
		
		/**
		 *	从收藏夹中删除
		 */
		function delete_favorite( $user_id , $favorite_user_id ) {
			$this->db->delete('favorites', array(
				'user_id' => $user_id,
				'favorite_user_id' => $favorite_user_id,
			));
		}
	
	}