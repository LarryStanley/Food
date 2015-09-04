@extends("default")

@section("content")
<div class="top" id="search">
	<div id="title">
		<a href="/"><h1  style="display:inline">中大美食</h1>(其實沒有)</a>
	</div>
	<div class="form-group-material-grey-400">
		<input type="text" class="form-control" placeholder="立即查詢餐廳或想吃的食物 例如：樂活堡、義大利麵、綠茶" style="color: white" id="searchInput">
		<button class="btn btn-default pull-right" style="color: white" onclick="search()">查詢</button>
	</div>
	@include("categoryBox")
	<?php 
		if ($results) {
			foreach ($results as $index => $value) {
				if (empty($value['prove']))
					$value['prove'] = 'true';
				if ($value['prove'] == 'true') {
					$result = '<a class="resultBox" href="/'.$value['name'].'">';
					if ($index > 0)
						$result .= '<div class="well result" id="result" style="margin-top: 20px">';
					else
						$result .= '<div class="well result" id="result">';
					echo $result.'<h2 stlye="display: inline">'.$value['name'].'</h2></div></a>';
				}
			}
		}else
			echo "<h3>真難過，查無有關「".$query."」資料</h3>";
	?>
	<?php echo view("footer");?>
</div>
@stop