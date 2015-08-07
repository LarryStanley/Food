<!DOCTYPE html>
<html lang="zh-Hant-TW" <?php if(!empty($ng_app)) echo "ng-app='".$ng_app."'";?>>
<head>
	<meta charset="UTF-8">
	<meta name="_token" content="{!! csrf_token() !!}"/>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta property="og:title" content="<?php if (empty($title)) echo "中大美食"; else echo $title;?>" />
	<meta property="og:site_name" content="<?php if (empty($title)) echo "中大美食"; else echo $title;?>"/>
	<meta property="og:url" content="<?php echo Request::url(); ?>"/>
	<meta name="description" content="立即查詢中大附近美食">
	<meta name="keywords" content="中央大學 中大 美食 中央 食物 菜單 國立中央大學 宵夜街 後門 早餐 宵夜 晚餐 飲料 <?php if (!empty($name)) echo $name;?>">
	<meta property="og:description" content="
		<?php
			if (!empty($name)) echo $name." ";
			else echo "立即查詢中大附近美食（不用找了，其實沒有）";
			if (!empty($telephone)) echo $telephone." ";
			if (!empty($type)) echo $type." ";
			if (!empty($address)) echo $address." ";
		?>" />
	<meta property="og:image" content="<?php if(empty($metaImage)) echo "http://www.ncufood.info/image/indexMetaImage.png"; else echo $metaImage;?>"/>
	<meta property="og:type" content="article" />

	<title>
		<?php
			if (empty($title))
				echo "中大美食";
			else
				echo $title;
		?>
	</title>

	<link rel="apple-touch-icon" sizes="57x57" href="/favicon.ico/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/favicon.ico/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/favicon.ico/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/favicon.ico/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/favicon.ico/favicon.ico/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/favicon.ico/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/favicon.ico/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/favicon.ico/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/favicon.ico/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/favicon.ico/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon.ico/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/favicon.ico/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon.ico/favicon-16x16.png">
	<link rel="manifest" href="/favicon.ico/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/favicon.ico/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/material-fullpalette.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="/css/animate.min.css">
	<link rel="stylesheet" href="/css/main.min.css">

	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="/js/jquery.autocomplete.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.3/angular.min.js"></script>
	<script src="/js/menu.js"></script>
	<script src="/js/main.min.js"></script>

</head>
<body>
	@yield("content")
	<?php 
		if ($_SERVER['SERVER_NAME'] == "www.ncufood.info"){
			echo "<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			  ga('create', 'UA-65836197-1', 'auto');
			  ga('send', 'pageview');

			</script>";
	}
	?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.4&appId=647423881978026";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>