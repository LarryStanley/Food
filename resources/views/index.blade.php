@extends("default")

@section("content")
<div class="center" id="search">
	<div id="title">
		<a href="/"><h1 style="display:inline">中大美食</h1> beta (其實沒有)</a>
	</div>
	<div class="form-group-material-grey-400">
		<input type="text" class="form-control" placeholder="立即查詢餐廳 例如：樂活堡" style="color: white" id="searchInput" name="query">
		<button class="btn btn-default pull-right" style="color: white" onclick="search()">查詢</button>
	</div>
	<div id="category">
		<h2>種類</h2>
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-6 text-center">
				<a href="/breakfast" class="btn btn-flat" style="color:white">
					早餐<br>
					<i class='fa fa-coffee fa-4x'></i>
				</a>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6 text-center">
				<a href="/dine" class="btn btn-flat" style="color:white">
					午晚餐<br>
					<i class="fa fa-cutlery fa-4x"></i>
				</a>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6 text-center">
				<a href="/drink" class="btn btn-flat" style="color:white">
					飲料<br>
					<i class="fa fa-glass fa-4x"></i>
				</a>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6 text-center">
				<a href="/midnight-snack" class="btn btn-flat" style="color:white">
					宵夜<br>
					<i class="fa fa-moon-o fa-4x"></i>
				</a>
			</div>
		</div>
	</div>
	<?php if(!empty($message)) echo $message;?>
</div>
@stop