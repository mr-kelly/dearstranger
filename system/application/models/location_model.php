<?php

	class Location_Model extends KK_Model {
	
		function get_provinces() {
			$query = $this->db->get('dict_province');
			return $query->result_array();
		}
		
		//function get_cities( $
		
		function get_cities ( $province_id = 11 ) {
			$query = $this->db->get_where('dict_city', array(
				'province_id' => $province_id,
			));
			
			return $query->result_array();
		}
		
		
		
		/**
		 * 获取指定city_id的城市, 根据省份~
		 */	
		function get_city_by_id( $city_id, $province_id ) {
			$query = $this->db->get_where( 'dict_city', array(
				'city_id' => $city_id,
				'province_id' => $province_id,
			));
			
			
			if ( $query->num_rows() != 0 ) {
				$city = $query->result_array();
				return $city[0];
			} else {
				//没设置城市
				return array('city_name'=>'');
			}
		}
		
		function get_province_by_id( $province_id ) {
			$query = $this->db->get_where( 'dict_province', array(
				'id' => $province_id,
			));
			$province = $query->result_array();
			
			return $province[0];
		}
	}
	
	
	
	
	
	
	
	
	