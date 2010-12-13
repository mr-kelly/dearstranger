
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	
	<meta name="author" content="Mrkelly 陈霈霖,http://mrkelly.cc,chepy.v@gmail.com" />
	<meta name="robots" content="all" />
    <meta name="description" content="" /> 
    <meta name="keywords" content="教科书,二手书,同学,大学生" /> 
	
	
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />  
	
	<script type="text/javascript">
		var $home_page = "<?=site_url('/');?>";
	</script>
	<script type="text/javascript" src="<?=site_url('static/js/lib.js');?>"></script>
	
	
	<!--j UI -->
	<script type="text/javascript" src="<?=site_url('static/js/ui/js/jquery-ui-1.8.4.min.js');?>"></script>
	<link href="<?=site_url('static/js/ui/css/pepper-grinder/jquery-ui-1.8.6.custom.css');?>" type="text/css" rel="stylesheet" />
	

	<!--tipsy-->
	<script type="text/javascript" src="<?=site_url('static/js/tipsy/jquery.tipsy.js');?>"></script>
	<link href="<?=site_url('static/js/tipsy/tipsy.css');?>" type="text/css" rel="stylesheet" />
	
	<!--input tips-->
	<script type="text/javascript" src="<?=site_url('static/js/jquery.input_tips.js');?>"></script>
	
	<script type="text/javascript" src="<?=site_url('static/js/global.js');?>"></script>
	
	<link href="<?=site_url('static/css/style.css');?>" type="text/css" rel="stylesheet" />
	<link href="<?=site_url('static/css/decorator.css');?>" type="text/css" rel="stylesheet" />
	
		<link rel="stylesheet" type="text/css" media="all" href="<?=site_url('static/');?>/js/jquery.imgareaselect/css/imgareaselect-animated.css" /> 
		<script type="text/javascript" src="<?=site_url('static/js/jquery.imgareaselect/scripts/jquery.imgareaselect.min.js');?>"></script>
		


	<title><?= ( isset( $page_title ) ) ? $page_title : '亲爱陌生人 - 微博交友、恋爱，寻找你心仪的恋爱对象'; ?></title>
</head>
<body>

<div id="loading"></div>

<div id="header">
	
	
	<ul id="menu">
		<li><a title="回到Single Club的首页" class="tooltip" href="<?=site_url('/');?>">首页</a></li>
		<li><a title="查看有feel指数排行榜" class="tooltip" href="<?=site_url('ranking');?>">排行</a></li>
		<li><a title="筛选城市、资料、身高、样貌，寻觅意中的她" class="tooltip" href="<?=site_url('search');?>">寻觅</a></li>
	</ul>
	<h2>蛋壳</h2>
	
	
</div>

<div id="wrapper">
	<?php if ( isset( $feedback ) ): ?>
	<div id="feedback">
		<span class="kk_icon kk_icon_info"></span>
		<?php
			echo $feedback;
			
		?>
	</div>
	<?php endif; ?>
	<div id="container">
	