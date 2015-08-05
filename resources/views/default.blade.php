<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta charset="UTF-8">
	<meta name="_token" content="{!! csrf_token() !!}"/>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta property="og:title" content="<?php if (empty($title)) echo "中大美食"; else echo $title;?>" />
	<meta property="og:site_name" content="<?php if (empty($title)) echo "中大美食"; else echo $title;?>"/>
	<meta property="og:url" content="<?php echo Request::url(); ?>"/>
	<meta property="og:description" content="
		<?php
			if (!empty($name)) echo $name;
			else echo "立即查詢中大附近美食（不用找了，其實沒有）";
			if (!empty($telephone)) echo $telephone;
			if (!empty($type)) echo $type;
			if (!empty($address)) echo $address;
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

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/material-fullpalette.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="/css/animate.css">
	<link rel="stylesheet" href="/css/main.css">

	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="/js/jquery.autocomplete.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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