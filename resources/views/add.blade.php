@extends("default")

@section("content")
<div class="container">
	<div class="center" id='search'>
		<div class="well" style="overflow: auto">
			<h1>新增餐廳</h1>
			<hr>
			<form action="/add-food" class="form-horizontal" method="POST" enctype="multipart/form-data" id="addFoodForm">
				<div class="form-group-material-orange-500" id="food-name-group">
					<label for="name" class='col-sm-2 control-label'>餐廳名稱</label>
					<div class="col-sm-10">
						<input type="text" placeholder='餐廳名稱' class='form-control' name="name" id="food-name-value">
					</div>
				</div>
				<div class="form-group-material-orange-500" id="food-address-group">
					<label for="name" class='col-sm-2 control-label'>地址</label>
					<div class="col-sm-10">
						<input type="text" placeholder='餐廳地址' class='form-control' name="address" id="food-address-value">
					</div>
				</div>
				<div class="form-group-material-orange-500" id="food-telephone-group">
					<label for="name" class='col-sm-2 control-label'>電話</label>
					<div class="col-sm-10">
						<input type="text" placeholder='餐廳電話' class='form-control' name="telephone" id="food-telephone-value">
					</div>
				</div>
				<div class="form-group-material-orange-500">
					<label for="name" class='col-sm-2 control-label'>外送</label>
					<div class="col-sm-10">
						<label class="radio-inline">
							<input type="radio" name="togo" value="可"> 可				
						</label>
						<label class="radio-inline">
							<input type="radio" name="togo" value="否" checked="checked"> 否					
						</label>
					</div>
				</div>
				<div class="form-group-material-orange-500">
					<label for="name" class='col-sm-2 control-label'>備註</label>
					<div class="col-sm-10">
						<input type="text" placeholder='可留空' class='form-control' name="note">
					</div>
				</div>
				<div class="form-group-material-orange-500">
					<label for="name" class='col-sm-2 control-label'>種類</label>
					<div class="col-sm-10">
						<select class="form-control" name="type">
						  <option>早餐</option>
						  <option>午晚餐</option>
		  				  <option>飲料</option>
						  <option>宵夜</option>
						</select>					
					</div>
				</div>
				<div class="form-group-material-orange-500" id="food-menu-group">
					<label for="name" class='col-sm-2 control-label'>菜單</label>
					<div class="col-sm-10">
						<input type="file" class='form-control' name="menu_file" id="food-menu-value">
						<p>您可上傳png, jpg, json, csv形式的菜單<br>呈現方式可參考<a href="/menu-format" target="_blank">菜單格式</a></p>
					</div>
				</div>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="submit" value='送出' class='btn btn-flat btn-warning pull-right'>
			</form>
		</div>
	</div>
</div>
<script>
	$("#addFoodForm").submit(function() {

		$("#errorMessage").remove();

		var checkId = ['name', 'telephone', 'address', 'menu'];
		var hasError = false;

		$.each(checkId, function(index, value){
			var inputValue = $.trim($("#food-"+ value +"-value").val());
			if (!inputValue){
				$("#food-"+ value +"-group").attr("class","form-group has-error");
				hasError = true;
			} else 
				$("#food-"+ value +"-group").attr("class","form-group-material-orange-500");
		});

		if (hasError){
			$(".well form").append("<p id='errorMessage' class='animated fadeIn'>欄位不可留空!!</p>");
			event.preventDefault();
			return false;
		}
	});
</script>
@stop