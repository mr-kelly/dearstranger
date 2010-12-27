<?php

	class Search extends KK_Controller {
		
		/**
		 *	搜索， 提供GET 关键词
		 */
		function index() {
			
			$page = $this->input->get('page');
			if ( $page == '' ) $page = 1;
			
			$per_page = $this->config->item('per_page'); // 每页显示数量
			
			
			$data = array(
				'current_user' => get_user(),
			);
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
			
						
			if ( isset( $_GET['q'] ) ) {
				$this->load->model('user_model');
				
				//搜索的字段
				$search_query = array(
							'age' => array(
								'from_age' => $this->input->get('from_age'),
								'to_age' => $this->input->get('to_age'),
							),
							'search'=> array(
								'nickname' => $this->input->get('nickname'),
								'gender' => $this->input->get('gender'),
								'constellation' => $this->input->get('constellation'),
								'province_id' => $this->input->get('province_id'),
								'city_id' => $this->input->get('city_id'),
								'school_unit' => $this->input->get('school_unit'),
								
								'love' => $this->input->get('love'),
								'target' => $this->input->get('target'),
								'job' => $this->input->get('job'),
								'salary' => $this->input->get('salary'),
								'height' => $this->input->get('height'),
								
								'face' => $this->input->get('face'),
								'figure' => $this->input->get('figure'),
								
								'education' => $this->input->get('education'),
							),
						);
				$users = $this->user_model->search_users( $search_query, $per_page, ($page-1)*$per_page ); // 限制&偏移
				
				$this->load->library('KK_Pagination');
				$pagination = $this->kk_pagination->create_links( array(
					'total_rows' => $this->user_model->search_users_count( $search_query ),
					'per_page' => $per_page,
				));
				//echo $this->user_model->search_users_count( $search_query );
				
				
				$data['pagination'] = $pagination;
				
				//echo $this->user_model->search_users_count( $search_query );
			}
			
			$data['users'] = $users;
			$this->load->view('search/index_view', $data);
		}
		
		
		
	}