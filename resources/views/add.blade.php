@extends("default")

@section("head")
<link rel="stylesheet" href="/css/main.css">
@stop

@section("content")
<div class="container" ng-controller="MenuController as menu">
	<div class="center" id='search'>
		<div id="title">
			<a href="/"><h1  style="display:inline">中大美食</h1>(其實沒有)</a>
		</div>
		<div class="well" style="overflow: auto" id="addFood">
			<h2>新增餐廳</h2>
			<hr>
			<form action="/add-food" class="form-horizontal" method="POST" enctype="multipart/form-data" id="addFoodForm">
				<div class="form-group-material-orange-500" id="food-name-group">
					<label for="name" class='col-sm-2 control-label'>名稱</label>
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
				<div class="form-group-material-orange-500">
					<label for="name" class='col-sm-2 control-label'>地點</label>
					<div class="col-sm-10">
						<select class="form-control" name="location">
						  <option>後門</option>
						  <option>宵夜街</option>
		  				  <option>七餐</option>
						  <option>松苑</option>
						  <option>九餐</option>
						</select>					
					</div>
				</div>
				<div class="form-group-material-orange-500" id="food-menu-group">
					<label for="name" class='col-sm-2 control-label'>菜單</label>
					<div class="col-sm-10">
						<input type="file" class='form-control' name="menu_file" id="food-menu-value">
						<input type="hidden" 
						<p>
							您可上傳png, jpg, json, csv形式的菜單，呈現方式可參考<a href="/menu-format" target="_blank">菜單格式</a><br>
							或者您也可以線上<a href="#" data-toggle="modal" data-target="#editMenuModal">編輯菜單</a>(Beta)<br>
							上傳或編輯擇一
						</p>
					</div>
				</div>
	      		<input type="hidden" value='<?php echo "{{ menu.menuData }}";?>' id="menuData" name="menuData">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="submit" value='送出' class='btn btn-flat btn-warning pull-right'>
			</form>
		</div>
	</div>
	<div class="modal fade" id="editMenuModal" tabindex="-1" role="dialog" aria-labelledby="editMenuLabel">
		<div class="modal-dialog modal-lg">
	    	<div class="modal-content" id="editMenuModalContent">
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title" id="editMenuLabel">編輯菜單</h4>
	      		</div>
	      		<div class="modal-body">
					<hr>
					<div class="category well" ng-repeat="category in menu.menuData" style="overflow: auto;">
						<input style="color: #00838F" type="text" ng-model="category.category_name" class="form-control" style="height: 40px" placeholder="種類">
						<div class="form-group-material-grey-500">
							<input style="color: black" type="text" ng-model="category.note" class="form-control" style="height: 30px" placeholder="備註(可留空)">							
						</div>
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<td>品項</td>
									<td>價錢</td>
									<td>備註</td>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="item in category.items" class="form-group-material-orange-500">
									<td><input type="text" ng-model="item.name" class="form-control" style="height: 30px"></td>
									<td><input type="text" ng-model="item.price" class="form-control" style="height: 30px"></td>
									<td><input type="text" ng-model="item.note" class="form-control" style="height: 30px"></td>
								</tr>
							</tbody>
						</table>
						<form ng-submit="menu.addItem($index)" id="addFoodForm" class="form-group-material-orange-500">
							<div class="col-md-3 col-sm-3">
								<input type="text" ng-model="menu.name[$index]" class="form-control" placeholder="品項" id="itemNameInput-<?php echo '{{$index}}';?>">							
							</div>
							<div class="col-md-3 col-sm-3">
								<input type="text" ng-model="menu.price[$index]" class="form-control" placeholder="價錢">							
							</div>
							<div class="col-md-3 col-sm-3">
								<input type="text" ng-model="menu.note[$index]" class="form-control" placeholder="備註(可留空)">							
							</div>
							<div class="col-md-3 col-sm-3">
								<input type="submit" value="新增品項" class="btn btn-flat btn-material-orange-500">							
							</div>
						</form>
					</div>
					<br>
					<form ng-submit="menu.addCategory()" class="form-group-material-grey-300" id="addCategoryForm">
						<div class="row">
							<div class="col-md-3 col-sm-3">
								<input type="text" ng-model="menu.category_name" class="form-control" placeholder="新增菜單種類">							
							</div>
							<div class="col-md-3 col-sm-3">
								<input type="text" ng-model="menu.category_note" class="form-control" placeholder="備註(可留空)">							
							</div>
							<div class="col-md-3 col-sm-3">
								<input type="submit" value="新增種類" class="btn btn-default" style="color: white">							
							</div>
						</div>
					</form>
	      		</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" style="color: white" data-dismiss="modal">取消</button>
		        	<button onclick="editMenuEnd()" class="btn btn-default" style="color: white">送出</button>
		      	</div>
			</div>
		</div>
	</div>
</div>
<script>
	window.onbeforeunload = function() {
    	return '您還有資料尚未儲存喔！！';
	}

	function editMenuEnd() {
		$("#editMenuModal").modal("hide");
		$("#errorMessage").remove();
		$(".well").append('<div id="errorMessage">菜單已編輯完成！</div>');
	}

	$("#addFoodForm").submit(function() {

		window.onbeforeunload = null;

		$("#errorMessage").remove();

		var checkId = ['name', 'telephone', 'address'];
		var hasError = false;

		$.each(checkId, function(index, value){
			var inputValue = $.trim($("#food-"+ value +"-value").val());
			if (!inputValue){
				$("#food-"+ value +"-group").attr("class","form-group has-error");
				hasError = true;
			} else 
				$("#food-"+ value +"-group").attr("class","form-group-material-orange-500");
		});

		var menuValue = $("#food-menu-value").val();
		var menuData = JSON.parse($("#menuData").val());
		if (!menuValue && menuData[0].category_name.length === 0){
			$("#food-menu-group").attr("class","form-group has-error");
			hasError = true;
		}else
			$("#food-menu-group").attr("class","form-group-material-orange-500");

		if (hasError){
			$("#addFood").append("<div id='errorMessage'>欄位不可留空!!<br>編輯或上傳菜單擇一</div>");
			event.preventDefault();
			window.onbeforeunload = function() {
		    	return '您還有資料尚未儲存喔！！';
			}
			return false;

		}
	});
</script>
@stop