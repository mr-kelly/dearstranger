
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	
	<meta name="author" content="Mrkelly 陈霈霖,http://mrkelly.cc,chepy.v@gmail.com" />
	<meta name="robots" content="all" />
    <meta name="description" content="" /> 
    <meta name="keywords" content="恋爱,交友,单身,心动" /> 
	
	
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />  
	
	<script type="text/javascript">
		var $home_page = "<?=site_url('/');?>";
		var $ajax_get_cities = "<?=site_url('user/ajax_get_cities/');?>";
	</script>
	<script type="text/javascript" src="<?=static_url('js/lib.js');?>"></script>
	
	
	<!--j UI -->
	<script type="text/javascript" src="<?=static_url('js/ui/js/jquery-ui-1.8.4.min.js');?>"></script>
	<link href="<?=static_url('js/ui/css/pepper-grinder/jquery-ui-1.8.6.custom.css');?>" type="text/css" rel="stylesheet" />
	

	<!--tipsy-->
	<script type="text/javascript" src="<?=static_url('js/tipsy/jquery.tipsy.js');?>"></script>
	<link href="<?=static_url('js/tipsy/tipsy.css');?>" type="text/css" rel="stylesheet" />
	
	<!--input tips-->
	<script type="text/javascript" src="<?=static_url('js/jquery.input_tips.js');?>"></script>
	

	<!--bgiFrame-->
	<script type='text/javascript' src="<?=static_url('js/jquery.bgiframe.min.js');?>"></script> 
	
	<!--ajaxQueue-->
	<script type='text/javascript' src="<?=static_url('js/jquery.ajaxQueue.js');?>"></script> 
	
	<!--thickbox-compressed.js-->
	<script type='text/javascript' src="<?=static_url('js/thickbox-compressed.js');?>"></script> 
	<link href="<?=static_url('js/thickbox.css');?>" type="text/css" rel="stylesheet" />
	
	
	<!--jQuery AutoComplete-->
	<script type="text/javascript" src="<?=static_url('js/jquery.autocomplete/jquery.autocomplete.min.js');?>"></script>
	<link href="<?=static_url('js/jquery.autocomplete/jquery.autocomplete.css');?>" type="text/css" rel="stylesheet" />
	
	
	
	<script type="text/javascript" src="<?=static_url('js/global.js');?>"></script>
	
	<link href="<?=static_url('css/style.css');?>" type="text/css" rel="stylesheet" />
	<link href="<?=static_url('css/decorator.css');?>" type="text/css" rel="stylesheet" />
	
		<link rel="stylesheet" type="text/css" media="all" href="<?=static_url('');?>/js/jquery.imgareaselect/css/imgareaselect-animated.css" /> 
		<script type="text/javascript" src="<?=static_url('js/jquery.imgareaselect/scripts/jquery.imgareaselect.min.js');?>"></script>
		

	<title><?= ( isset( $page_title ) ) ? $page_title : '心动恋爱网络:: 微博交友、恋爱，寻找你心动的恋爱对象、心动的他/她'; ?></title>
	
	<script type="text/javascript">
	
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-2467823-10']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
</head>
<body>

<div id="loading">
	请稍候...<img src="<?=static_url('images/loading.gif');?>" />
</div>

<div id="header">
	
	
	<ul id="menu">
		<li><a title="回到「心动」的首页" class="tooltip" href="<?=site_url('/');?>">首页</a></li>
		<li><a title="查看心动指数排行榜" class="tooltip" href="<?=site_url('ranking');?>">排行</a></li>
		<li><a title="筛选城市、资料、身高、样貌，寻觅意中的她" class="tooltip" href="<?=site_url('search');?>">寻觅</a></li>
		<li><a title="邀请你的死党、心仪对象来到心动网络！" class="tooltip" href="<?=site_url('about/invite');?>">邀请朋友</a></li>
	</ul>
	<h2><a href="<?=site_url('/');?>">心动网 - 微博单身交友，恋爱2.0，</a></h2>
	
	
</div>

<div id="wrapper">
	<?php if ( isset( $feedback ) && $feedback != '' ): ?>
	<div id="feedback">
		<span class="kk_icon kk_icon_info"></span>
		<?php
			echo $feedback;
			
		?>
	</div>
	<?php endif; ?>
	<div id="container">
	
