<p id="add_food">
	<div class="row" style="margin-bottom: 20px;">
		<div class="col-md-6 col-sm-6">
			找不到你知道的餐廳？
			<?php
				if (Session::get("facebookId"))
					echo '<a href="/add-food" class="btn btn-default" style="color: white;">立即新增</a>';
				else
					echo '<a href="/login/add-food" class="btn btn-default" style="color: white;">登入新增</a>';
			?>
		</div>
		<div class="col-md-6 col-sm-6" id="feedbackButtons">
			<a href="/feedback" class="btn btn-default" style="color: white">回報錯誤</a>
			<a href="/about" class="btn btn-default" style="color: white">關於中大美食</a>
		</div>
		<div class="fb-page" data-href="https://www.facebook.com/ncufood" data-height="100" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/ncufood"><a href="https://www.facebook.com/ncufood">中大美食</a></blockquote></div></div>
	</div>
</p>