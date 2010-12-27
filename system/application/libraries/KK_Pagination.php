<?php

	/**
	 *	创建分页的pagination
	 */
	class KK_Pagination {
		
		
		function create_links( $option = array() ) {
			
			$option = $option + array( 
								'get' => 'page',
								'total_rows' => 1000,
								'per_page' => 10,
									);
			
			$pages = ceil( $option['total_rows'] / $option['per_page'] );
			$ci =& get_instance();
			// 读取get[page], 如果没有，page为1
			$current_page = $ci->input->get( $option['get'] );
			if ( ! $current_page ) {
				$current_page = 1;
			}
			
			$return = '<div class="pagination">';
			
			
			// 如果当前页不是在第一页，那么提供“上一页”链接
			if ( $current_page != 1 ) {
				$return .= sprintf( '<a href="%s">上一页</a>', $this->return_url( $option['get'], $current_page-1) );
				//$return .= sprintf( '<a href="?%s=%s">上一页</a>', $option['get'], $current_page-1 );
			}
			foreach ( range(1, $pages) as $page ) {

				
				// 当前页面的页面按钮链接，不可选
				if ( $current_page == $page ) {
					$return .= sprintf('<span>%s</span>&nbsp;', $page);
				} else {
					//$return .= sprintf('<a href="?%s=%s">%s</a>&nbsp;', $option['get'], $page, $page); //'<a href="?page=' . $page .  '">' . $page . '</a>&nbsp;&nbsp;';
					$return .= sprintf('<a href="%s">%s</a>&nbsp;', $this->return_url( $option['get'], $page) , $page);
				}
				
				

			}
			
			// 如果当前页不是到了最后一页，那么提供“下一页”链接
			if ( $page != $current_page ) {
				//$return .= sprintf( '<a href="?%s=%s">下一页</a>', $option['get'], $current_page+1 );
				$return .= sprintf( '<a href="%s">下一页</a>', $this->return_url( $option['get'], $current_page+1 ) );
			}

			$return .= '</div>';
			
			return $return;
		}
		
		
		/**
		 *	根据是否已get， 网址是添加? 还是&
		 
		 	将网址判断做成一个函数
		 */
		private function return_url( $get_string, $page ) {
			$current_url = $_SERVER['REQUEST_URI'];
			if ( $_GET == array() ) {
				// query string为空！那么直接?page=xx
				$current_url .= sprintf('?%s=%s', $get_string, $page );
			} else if ( isset($_GET['page'] ) ) {
				//PHP 字符串处理
				$current_url = str_replace( 'page='.$_GET['page'] , 'page='.$page, $current_url);
				
			} else {
				// query string 不存在&page， 那马加&page=xx
				$current_url .= sprintf('&%s=%s', $get_string, $page );
			}
			
			return $current_url;
		}
	
	}