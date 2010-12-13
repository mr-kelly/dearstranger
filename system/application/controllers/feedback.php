<?php

	class Feedback extends KK_Controller {
	
		function index() {
			login_redirect();
			
			// 页面反馈信息
			$feedback = '这是处理用户反馈意见的页面，你直接进入了...';
			
			if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				$this->form_validation->set_rules('user_id', 'user_id', 'required|trim|integer|xss_clean');
				$this->form_validation->set_rules('content', 'content', 'required|xss_clean|trim');
				
				if ( ! $this->form_validation->run() ) {
					// 表单验证失败
					$feedback = '你的反馈意见无法提交，请确定你已经填写了内容。';
					
				} else {
					// 创建feedback
					$user_id = $this->form_validation->set_value('user_id');
					$content = $this->form_validation->set_value('content');
					
					$this->load->model('feedback_model');
					$this->feedback_model->create_feedback( $user_id, $content );
					
					$feedback = '你的反馈意见已提交，谢谢！';
				}
				
			}
			
			$data = array(
				'feedback' => $feedback,
			);
			$this->load->view('feedback/index_view', $data);
			
		}
	}