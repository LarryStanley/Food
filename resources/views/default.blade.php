<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<meta property="og:title" content="<?php if (empty($title)) echo "中大美食"; else echo $title;?>" />
	<meta property="og:site_name" content="<?php if (empty($title)) echo "中大美食"; else echo $title;?>"/>
	<meta property="og:url" content="http://food.fbstats.info/<?php if(!empty($name)) echo $name; ?>"/>
	<meta property="og:description" content="
		<?php
			if (!empty($title)) echo $title;
			if (!empty($name)) echo $name;
			if (!empty($telephone)) echo $telephone;
			if (!empty($type)) echo $type;
			if (!empty($address)) echo $address;
		?>" />
	<meta property="og:image" content=""/>
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
	<link rel="stylesheet" href="/css/main.css">

	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="/js/main.js"></script>

</head>
<body>
	@yield("content")
</body>
</html>