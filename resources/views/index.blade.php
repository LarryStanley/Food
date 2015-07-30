@extends("default")

@section("content")
<div class="center" id="search">
	<h1  style="display:inline">中大美食</h1> beta (其實沒有)
	<div class="form-group-material-grey-400">
		<input type="text" class="form-control" placeholder="立即查詢餐廳 例如：樂活堡" style="color: white" id="searchInput">
		<button class="btn btn-default pull-right" style="color: white" onclick="search()">查詢</button>
	</div>
</div>
@stop