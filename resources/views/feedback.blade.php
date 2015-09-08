@extends("default")

@section("head")
<link rel="stylesheet" href="/css/main.css">
@stop

@section("content")
<div class="container">
	<div class="center" id='search'>
		<div id="title">
			<a href="/"><h1  style="display:inline">中大美食</h1></a>
		</div>
		<div class="well" style="overflow: auto">
			<h2>回報錯誤</h2>
			<hr>
			<form action="/feedback" class="form-horizontal" method="POST" enctype="multipart/form-data" id="errorForm">
				<div class="form-group-material-orange-500">
					<label for="name" class='col-sm-2 control-label'>問題餐廳名稱</label>
					<div class="col-sm-10">
						<p>若非餐廳資訊錯誤，可選「無」</p>
						<select class="form-control" name="name">
							<option value="無">無</option>
							<?php
								foreach ($foods as $key => $value) {
									echo "<option>".$value."</option>";
								}
							?>
						</select>					
					</div>
				</div>
				<div class="form-group-material-orange-500" id="error">
					<label for="name" class='col-sm-2 control-label'>錯誤描述</label>
					<div class="col-sm-10">
						<textarea class="form-control" rows="6" name="error" id="error-value"></textarea>
					</div>
				</div>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="submit" value='送出' class='btn btn-flat btn-warning pull-right'>
			</form>
		</div>
	</div>
</div>
<script>
	$("#errorForm").submit(function() {

		$("#errorMessage").remove();

		var checkId = ['error'];
		var hasError = false;

		$.each(checkId, function(index, value){
			var inputValue = $.trim($("#"+ value +"-value").val());
			if (!inputValue){
				$("#" + value).attr("class","form-group has-error");
				hasError = true;
			} else 
				$("#"+ value).attr("class","form-group-material-orange-500");
		});

		if (hasError){
			$(".well form").append("<p id='errorMessage' class='animated fadeIn'>欄位不可留空!!</p>");
			event.preventDefault();
			return false;
		}
	});
</script>
@stop