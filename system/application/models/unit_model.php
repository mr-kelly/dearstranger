<?php

	class Unit_Model extends KK_Model {
		
		function get() {
			$query = $this->db->get('user_units');
			
			return $query->result_array();
		}
		
		function add( $data ) {
			// 不重复添加
			$query = $this->db->get_where('user_units', $data);
			
			if ( $query->num_rows() == 0 ) {
				$this->db->insert('user_units', $data + array(
					'created' => date('Y-m-d H:i:s'),
				));
			}
		}
	}