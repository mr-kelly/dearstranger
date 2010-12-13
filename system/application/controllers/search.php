<?php

	class Search extends KK_Controller {
		
		/**
		 *	搜索， 提供GET 关键词
		 */
		function index() {
			$users = null;
			$city_id = $this->input->get('city_id');
						
			if ( $city_id != null ) {
				$this->load->model('user_model');
				$users = $this->user_model->get_users( array(
					'city_id' => $city_id,
				) );
			}
			
			
			$data = array(
				'users' => $users,
			);
			$this->load->view('search/index_view', $data);
		}
		
		
		
	}