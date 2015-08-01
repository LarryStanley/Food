@extends("default")

@section("content")
<div class="container">
	<div class="well center" id='search'>
		<h1>感謝您的新增</h1>
		<hr>
		<p><?php echo $message;?></p>
		<p><a href="/add-food" class="btn btn-flat btn-info">新增更多餐廳</a></p>
	</div>
</div>
@stop