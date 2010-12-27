/**
 *	Ajax Loading
 */
$(function(){
	$('#loading').ajaxStart( function(){
		$(this).show();
	}).ajaxSuccess( function() {
		$(this).hide();
	});
	
});



$(function(){
	// 标签自动生成
	$('.tabs').tabs();
	
	// Tipsy生成
	$('.tooltip').tipsy( {  gravity: $.fn.tipsy.autoNS , fade: true, live:true});
	
	// Tipsy Form表单提示～
	$('.tooltip_form [title]').tipsy( { trigger: 'focus', gravity: $.fn.tipsy.autoWE , fade: true } );
	

	// 设置省份时，城市会读取省份所有城市	
	$('#form_province_id').change(function(){
		$('#form_city_id').load( $ajax_get_cities + '/' + $(this).val() );
	});
});







function rand() {
	return Math.random()
}


/**
 *	JS形式的登录转移~
 */
function login_redirect() {
	window.location = $home_page + 'user/login';
}

// feel按钮的js处理
function feel_btn_fn( $which ) {
	// jQuery DOM转换
	$which = $($which);
   var tt = $which;
   
   $.getJSON( 
	   $which.attr('href') + '?ajax=' + rand(), 
	   
	   function(data) {
	   		// 是否登录， 未登录会转到提示登录，返回失败的
	   		if ( data.status == 0 ) {
	   			login_redirect();
	   			return false;
	   		}
	   		
		   // 状态，是删除，还是添加
		   $status =  data.data.status ;
		   
		   // 判断状态，显示按钮~
		   if ( $status == 'add') {
			   // 图形背景变化
			   tt.addClass('unfeel_btn').removeClass('feel_btn');
		   } else if ( $status =='delete' ) {
			   // 图形背景变化
			   tt.addClass('feel_btn').removeClass('unfeel_btn');
		   }
	   
   });
   
   return false;
   
}
						
// 
// 					   $(function(){
// 
// 						   $('.feel_it').click(function(){
// 							   feel_btn( $(this) );
// 
// 						   });
// 					   });