<?php

	class Feedback_Model extends KK_Model {
		
		/**
		 *	在数据库创建一个反馈信息，并发送一封Email通知kk～
		 */
		function create_feedback( $user_id, $content ) {
			$this->db->insert('feedback', array(
				'user_id' => $user_id,
				'content' => $content,
			));
			
			$ci =& get_instance();
			$ci->load->library('kk_mailer');
			$ci->load->model('user_model');
			$user = $ci->user_model->get_user_by_id( $user_id );
			
			$this->kk_mailer->send_mail( array(
				'to' => array(
					array( 'chepy.v@gmail.com', 'Mrkelly'),
				),
				'from' => 'kiwiguo.net@gmail.com',
				'from_name' => '「奇异果」',
				'subject' => '「Single Club」用户意见反馈 - t_sina_id: ' . $user['t_sina_id'],
				'body' => $content,
				'reply_to' => array(
					//array( 'chepy.v@gmail.com', 'Mr Kelly' ),
				),
			));
			
			return $this->db->insert_id();
		}
		
	}