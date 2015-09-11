@extends("default")

@section("head")
<link rel="stylesheet" href="/css/main.css">
@stop

@section("content")
<script src="/js/wordfreq.min.js"></script>
<script src="/js/admin.js"></script>
<div class="container" ng-controller="AdminController as admin">
	<h1>中大美食管理介面</h1>
	<div class="row">
		<div class="col-md-3 col-sm-3">
			<div class="panel panel-material-indigo-500">
			    <div class="panel-heading">
			        <h3 class="panel-title">選擇餐廳</h3>
			    </div>
			    <div class="panel-body">
			    	<ul>
					<?php 
						foreach ($foodName as $key => $name) {
							echo "<li><a href='#' ng-click='admin.changeData(".$key.")'>".$name."</a></li>";
						}
					?>
					</ul>
			    </div>
			</div>
		</div>
		<div class="col-md-9 col-sm-9">
			<div class="panel panel-default">
				<div class="panel-body" id="adminDashboard">
					<div id="info" style="overflow: auto">
						<div class="form-horizontal">
							<div class="form-group-material-grey-200">
					            <label class="col-md-2 col-sm-2 control-label">名稱</label>
					            <div class="col-md-9 col-sm-9">
									<input type="text" ng-model="admin.currentData.name" class="form-control" placeholder="名稱">					            
					            </div>
							</div>
							<div class="form-group-material-grey-200">
					            <label class="col-md-2 col-sm-2 control-label">地址</label>
								<div class="col-md-9 col-sm-9">
									<input type="text" ng-model="admin.currentData.address" class="form-control" placeholder="地址">
								</div>								
							</div>
							<div class="form-group-material-grey-200">
								<label class="col-md-2 col-sm-2 control-label">電話</label>
								<div class="col-md-9 col-sm-9">
									<input type="text" ng-model="admin.currentData.telephone" class="form-control" placeholder="電話">								
								</div>
							</div>
							<div class="form-group-material-grey-200">
								<label class="col-md-2 col-sm-2 control-label">類型</label>
								<div class="col-md-9 col-sm-9">
									<input type="text" ng-model="admin.currentData.type" class="form-control" placeholder="類型">						
								</div>
							</div>
							<div class="form-group-material-grey-200">
								<label class="col-md-2 col-sm-2 control-label">外送</label>
								<div class="col-md-9 col-sm-9">
									<input type="text" ng-model="admin.currentData.togo" class="form-control" placeholder="外送">
								</div>
							</div>
							<div class="form-group-material-grey-200">
								<label for="" class="col-md-2 col-sm-2 control-label">備註</label>
								<div class="col-md-9 col-sm-9">
									<input type="text" ng-model="admin.currentData.note" class="form-control" placeholder="備註">
								</div>
							</div>
							<div class="form-group-material-grey-200">
								<label for="" class="col-md-2 control-label">位置</label>
								<div class="col-md-9 col-sm-9">
									<input type="text" ng-model="admin.currentData.location" class="form-control" placeholder="位置">
								</div>
							</div>
							<div class="form-group-material-grey-200">
								<label for="" class="col-md-2 control-label">經緯度</label>
								<div class="col-md-9 col-sm-9">
									<input type="text" ng-model="admin.currentData.coordinate" class="form-control" placeholder="經緯度">
								</div>
							</div>
							<div class="form-group-material-grey-200">
								<label for="" class="col-md-2 control-label">認證</label>
								<div class="col-md-9 col-sm-9">
									<input type="text" ng-model="admin.currentData.prove" class="form-control" placeholder="認證">
								</div>
							</div>
							<div class="form-group-material-grey-200">
								<label for="" class="col-md-2 control-label">價格區間</label>
								<div class="col-md-9 col-sm-9">
									<input type="text" ng-model="admin.currentData.priceInterval" class="form-control" placeholder="價格區間">
								</div>
							</div>
							<div class="form-group-material-grey-200">
								<label for="" class="col-md-2 control-label">Hash Tag</label>
								<div class="col-md-10 col-sm-10">
									<span ng-repeat="hashTag in admin.currentData.hashTags">
										<?php echo "{{hashTag[0]}}";?>
									</span>
								</div>
								<button class="btn btn-default" style="color: white" ng-click="admin.getHashTags()">取得Hash Tags</button>
								<button class="btn btn-default" style="color: white" ng-click="admin.caculatePrice()">計算價格區間</button>
							</div>
						</div>
					</div>
					<div id="editMenuModalContentAdmin">
						<button style="color: white" onclick="showMenu()" class="btn btn-default">編輯菜單</button>
						<div class="category panel" ng-if="admin.currentData.menu[0].category_name" ng-repeat="category in admin.currentData.menu" style="overflow: auto; display: none">
							<div class="panel-body">
								<input style="color: #00838F" type="text" ng-model="category.category_name" class="form-control" style="height: 40px" placeholder="種類">
								<div class="form-group-material-grey-500">
									<input style="color: black" type="text" ng-model="category.note" class="form-control" style="height: 30px" placeholder="備註(可留空)">							
								</div>
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<td style="color: black">品項</td>
											<td style="color: black">價錢</td>
											<td style="color: black">備註</td>
										</tr>
									</thead>
									<tbody>
										<tr ng-repeat="item in category.items" class="form-group-material-orange-500">
											<td><input type="text" ng-model="item.name" class="form-control" style="height: 30px"></td>
											<td><input type="text" ng-model="item.price" class="form-control" style="height: 30px"></td>
											<td><input type="text" ng-model="item.note" class="form-control" style="height: 30px" placeholder="備註(可留空)"></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="category panel" ng-if="!admin.currentData.menu[0].category_name" style="overflow: auto; display: none">
							<div class="panel-body">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<td style="color: black">品項</td>
											<td style="color: black">價錢</td>
											<td style="color: black">備註</td>
										</tr>
									</thead>
									<tbody>
										<tr ng-repeat="item in admin.currentData.menu" class="form-group-material-orange-500">
											<td><input type="text" ng-model="item.name" class="form-control" style="height: 30px"></td>
											<td><input type="text" ng-model="item.price" class="form-control" style="height: 30px"></td>
											<td><input type="text" ng-model="item.note" class="form-control" style="height: 30px" placeholder="備註(可留空)"></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div id="adminSave">
						<form id="saveForm" action="/admin/save" method="POST">
							<input type="hidden" value='<?php echo "{{ admin.currentData }}";?>' name="foodData">	
							<input type="hidden" name="_token" value="{{ csrf_token() }}">						
							變更需要儲存後才會更改
							<input type="submit" class="btn btn-flat btn-material-orange-500" value="儲存">
							<a target='_blank' href="/<?php echo "{{admin.currentData.name}}";?>" class="btn btn-flat btn-info">查看結果</a>
						</form>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$("#saveForm").submit(function() {
		$("#successLabel").remove();
		$.ajax({
	    	url: $('#saveForm').attr('action'),
	    	type: "POST",
	    	data : $('#saveForm').serialize(),
	    	success: function(data){
	    		$("#adminSave").append("<p id='successLabel' class='animated fadeIn'>儲存成功</p>");
	      	}
	    });
	    return false;
	});

	function showMenu() {
		if ($(".category").css('display') !== 'none') {
			$(".category").hide();
		}else{
			$(".category").show();
		}
	}
</script>
@stop