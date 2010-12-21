<?php

	class Search extends KK_Controller {
		
		/**
		 *	搜索， 提供GET 关键词
		 */
		function index() {
			
			$users = null;
			$from_age = $this->input->get('from_age');
			$to_age = $this->input->get('to_age');
			$gender = $this->input->get('gender');
			$province_id = $this->input->get('province_id');
			$city_id = $this->input->get('city_id');
			$constellation = $this->input->get('constellation');
			$face = $this->input->get('face');
			$figure = $this->input->get('figure');
			$target = $this->input->get('target');
			
						
			if ( $city_id != null ) {
				$this->load->model('user_model');
				$users = $this->user_model->get_users( array(
					'city_id' => $city_id,
				) );
			}
			
			
			$data = array(
				'users' => $users,
				'current_user' => get_user(),
			);
			$this->load->view('search/index_view', $data);
		}
		
		
		
	}