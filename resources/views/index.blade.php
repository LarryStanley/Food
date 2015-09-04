@extends("default")

@section("content")
<div class="center" id="search">
	<div id="title">
		<a href="/"><h1 style="display:inline">中大美食</h1>(其實沒有)</a>
	</div>
	<div class="form-group-material-grey-400">
		<input type="text" class="form-control" placeholder="立即查詢餐廳或想吃的食物 例如：樂活堡、義大利麵、綠茶" style="color: white" id="searchInput" name="query">
		<button class="btn btn-default pull-right" style="color: white" onclick="search()">查詢</button>
	</div>
	@include("categoryBox")
	<?php if(!empty($message)) echo $message;?>
	<?php echo view("footer"); ?>
</div>
@stop