@extends("default")

@section("head")
<link rel="stylesheet" href="/css/main.css">
@stop

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
					if (empty($value['likes']))
						$value['likes'] = array("like_count" => 0, "dislike_count" => 0, "like_people" => array(), "dislike_people" => array());

					$result = '<a class="resultBox" href="/'.$value['name'].'">';
					if ($index > 0)
						$result .= '<div class="well result" id="result" style="margin-top: 20px">';
					else
						$result .= '<div class="well result" id="result">';
					echo $result.'<h2 stlye="display: inline">'.$value['name'].'</h2>
					<div id="likeArea" style="margin-top: 10px">
						<sapn id="like">
							<i class="fa fa-lg fa-thumbs-up"></i> 
							<span class="counter">'.$value['likes']['like_count'].'</span> 					
						</sapn> 
						<span id="dislike">
							<i class="fa fa-lg fa-thumbs-down"></i>		
							<span  class="counter">'.$value['likes']['dislike_count'].'</span>			
						</span>
					</div></div></a>';
				}
			}
		}else
			echo "<h3>真難過，查無有關「".$query."」資料</h3>";
	?>
	<?php echo view("footer");?>
</div>
@stop