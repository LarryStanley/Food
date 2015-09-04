<p id="add_food">
	<div class="row">
		<div class="col-md-6 col-sm-6">
			找不到你知道的餐廳？
			<?php
				if (Session::get("facebookId"))
					echo '<a href="/add-food" class="btn btn-default" style="color: white;">立即新增</a>';
				else
					echo '<a href="/add-food" class="btn btn-default" style="color: white;">登入新增</a>';
			?>
		</div>
		<div class="col-md-6 col-sm-6" id="feedbackButtons">
			<a href="/feedback" class="btn btn-default" style="color: white">回報錯誤</a>
			<a href="/about" class="btn btn-default" style="color: white">關於中大美食</a>
		</div>
	</div>
</p>