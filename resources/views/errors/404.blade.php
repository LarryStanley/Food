@extends("default")

@section("content")
<div class="container">
	<div class="center">
		<div id="title">
			<a href="/"><h1  style="display:inline">中大美食</h1> beta (其實沒有)</a>
		</div>
		<div id="search">
			<div class="well" style="overflow: auto;">
				<h1>404 找不到頁面！！</h1>
				<hr>
				<p>真難過，找不到你想要找的頁面</p>
				<?php 
					$myURL = ["beta.ncufood.info", "www.ncufood.info"];
					if (!in_array($_SERVER['SERVER_NAME'], $myURL)) {
						echo "<p>您的URL可能有錯，「中大美食」正確的網址為 <a href='http://www.ncufood.info'>http://www.ncufood.info</a></p>";
					}else
						echo '<p>找不到你知道的餐廳？<a href="/add-food" class="btn btn-flat btn-info" >新增餐廳</a></p>';
				?>
			</div>
		</div>
	</div>
</div>
@stop