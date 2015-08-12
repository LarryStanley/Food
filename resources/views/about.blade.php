@extends("default")

@section("content")
<div class="container">
	<div class="center" id="search">
		<div id="title">
			<a href="/"><h1  style="display:inline">中大美食</h1> beta (其實沒有)</a>
		</div>
		<div class="well"  style="overflow: auto">
			<h1>關於中大美食</h1>
			<hr>
			<p>
				為了讓大家能在尋找餐廳、美食的時候更加的迅速<br>而有了「中大美食」這個網站。<br>
			</p>
			<p>
				如果找不到你知道的餐廳，歡迎<a href="/add-food" target="_blank">新增餐廳</a><br>
				如果你有發現餐廳資訊錯誤、網站有問題，歡迎<a href="/feedback" target="blank">回報錯誤</a><br>					
			</p>
			<div class="fb-page" data-href="https://www.facebook.com/ncufood"
  data-width="380" data-hide-cover="false" data-show-facepile="false" 
  data-show-posts="false"></div>
		</div>
	</div>
</div>
@stop