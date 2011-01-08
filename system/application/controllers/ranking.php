<?php
	
	/**
	 *	排行榜， 有feel指数排行榜
	 */
	class Ranking extends KK_Controller {
		
		function index() {
			$this->load->model('feel_model');
			
			$data = array( 
				'feel_index_ranking_users' =>  $this->feel_model->feel_index_ranking_users(),
				'inner_index_ranking_users' => $this->feel_model->inner_index_ranking_users(),
			);
			$this->load->view('ranking/index_view', $data);
		}
	}