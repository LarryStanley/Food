@extends("default")

@section("content")
<div class="container">
	<div class="top" id='search' >
		<div class="well" style="overflow: auto">
			<h1>菜單格式說明</h1>
			<hr>
			<h2>以CSV形式</h2>
			<hr>
			<p>
				您可使用Excel編輯菜單，菜單格式如下：
				<table class="table table-bordered">
					<tr>
						<td>品項</td>
						<td>價格</td>
						<td>備註</td>
					</tr>
				</table>
				例如：
				<table class="table table-bordered">
					<thead>
						<tr>
							<td>品項</td>
							<td>價格</td>
							<td>備註</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>茄汁牛肉義大利麵</td>
							<td>單點 160 套餐 210</td>
							<td></td>
						</tr>
						<tr>
							<td>奶油白酒蛤蜊義大利麵</td>
							<td>單點 160 套餐 210</td>
							<td>週一無供應</td>
						</tr>
						<tr>
							<td>卡布奇諾</td>
							<td>50</td>
							<td>熱/冰</td>
						</tr>
					</tbody>
				</table>
				若您的菜單有分類，您可用下面的格式：
				<table class="table table-bordered">
					<tr>
						<td>冰淇淋</td>
					</tr>
					<tr>
						<td>品項</td>
						<td>價格</td>
						<td>備註</td>
					</tr>
					<tr>
						<td>冰戀吐司寶</td>
						<td>100</td>
						<td></td>
					</tr>
					<tr>
						<td>杯裝單球</td>
						<td>30</td>
						<td></td>
					</tr>
					<tr>
						<td>飯</td>
					</tr>
					<tr>
						<td>品項</td>
						<td>價格</td>
						<td>備註</td>
					</tr>
					<tr>
						<td>日式咖喱烤雞腿飯</td>
						<td>單點 160 套餐 210</td>
						<td></td>
					</tr>
					<tr>
						<td>奶油杏子菇培根燉飯</td>
						<td>單點 160 套餐 210</td>
						<td>含肉桂</td>
					</tr>
				</table>
				<br>
				存檔時請選擇存檔類型為「CSV(逗號分格)(*.csv)」，之後再上傳給我們就可以囉！
			</p>
			
			<h2>以照片形式（JPG PNG形式）</h2>
			<hr>
			<p>如果您不想打字......</p>
			<p>
				請提供正面、清晰照片，以不影響閱讀為主，盡量避免因為菜單本身的反光<br>例如：<br>
				<a href="/image/17.jpg" target="_blank">
					<img src="/image/17.jpg" alt="範例菜單" width="80%" style="margin: 10px 10px 10px 10px">
				</a>
				<a href="/image/一品.jpg" target="_blank">
					<img src="/image/一品.jpg" alt="範例菜單2" width="80%" style="margin: 10px 10px 10px 10px">
				</a>
			</p>
		</div>
	</div>
</div>
@stop