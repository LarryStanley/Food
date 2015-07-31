@extends("default")

@section("content")
<div class="container">
	<div class="well center" style="height: 340px" id='search'>
		<h1>新增餐廳</h1>
		<hr>
		<form action="/add-food" class="form-horizontal" method="POST">
			<div class="form-group-material-orange-500">
				<label for="name" class='col-sm-2 control-label'>餐廳名稱</label>
				<div class="col-sm-10">
					<input type="text" placeholder='餐廳名稱' class='form-control' name="name">
				</div>
			</div>
			<div class="form-group-material-orange-500">
				<label for="name" class='col-sm-2 control-label'>地址</label>
				<div class="col-sm-10">
					<input type="text" placeholder='餐廳地址' class='form-control' name="address">
				</div>
			</div>
			<div class="form-group-material-orange-500">
				<label for="name" class='col-sm-2 control-label'>電話</label>
				<div class="col-sm-10">
					<input type="text" placeholder='餐廳電話' class='form-control' name="telephone">
				</div>
			</div>
			<div class="form-group-material-orange-500">
				<label for="name" class='col-sm-2 control-label'>外送</label>
				<div class="col-sm-10">
					<label class="radio-inline">
						<input type="radio" name="togo" value="可"> 可				
					</label>
					<label class="radio-inline">
						<input type="radio" name="togo" value="否"> 否					
					</label>
				</div>
			</div>
			<div class="form-group-material-orange-500">
				<label for="name" class='col-sm-2 control-label'>備註</label>
				<div class="col-sm-10">
					<input type="text" placeholder='可填空' class='form-control' name="note">
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
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="submit" value='送出' class='btn btn-flat btn-warning pull-right'>
		</form>
	</div>
</div>
@stop