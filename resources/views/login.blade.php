@extends("default")

@section("content")
<div class="container">
	<div id="loginView">
		<div id="title">
			<a href="/"><h1  style="display:inline; text-align: left">中大美食</h1>(其實沒有)</a>
		</div>
		<div class="well content"  style="overflow: auto">
			<h2>登入</h2>
			<p>
				你一定懶得註冊，<span class="smallBreak"><br></span>我也懶得寫註冊功能<br>
				那我們就用方便的<span class="smallBreak"><br></span>「facebook一鍵登入」吧！
			</p>
			<hr>
			<a href="/auth/facebook" href="btn btn-default" id="facebookLoginButton">
				<i class="fa fa-facebook"></i> | 用Facebook登入
			</a>
			<hr>
			<p>
				登入即可享有評論、評價、新增餐廳等功能<br>
				我們只會取得您的姓名以及大頭貼照片，<span class="smallBreak"><br>並不會取得其他資料
			</p>
		</div>
	</div>
</div>
@stop