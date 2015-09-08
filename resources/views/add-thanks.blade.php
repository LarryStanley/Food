@extends("default")

@section("head")
<link rel="stylesheet" href="/css/main.css">
@stop

@section("content")
<div class="container">
	<div class="center">
		<div id="title">
			<a href="/"><h1  style="display:inline">中大美食</h1>(其實沒有)</a>
		</div>
		<div id="search">
			<div class="well" style="overflow: auto">
				<h1>感謝您的新增</h1>
				<hr>
				<p><?php echo $message;?></p>
				<p><a href="/add-food" class="btn btn-flat btn-info">新增更多餐廳</a></p>
			</div>
		</div>
	</div>
</div>
@stop