@extends("default")

@section("content")
<div class="top" id="search">
	<h1  style="display:inline">中大美食</h1> beta (其實沒有)
	<div class="form-group-material-grey-400">
		<input type="text" class="form-control" placeholder="立即查詢餐廳 例如：樂活堡" style="color: white" id="searchInput">
		<button class="btn btn-default pull-right" style="color: white" onclick="search()">查詢</button>
	</div>
	<div class="well" id="result">
		<h2><?php echo $name;?></h2>
		<hr>
		<ul>
			<li>電話：<?php echo $telephone;?></li>
			<li>地址：<?php echo $address;?></li>
			<li>類型：<?php echo $type;?></li>
			<li>外送：<?php echo $togo;?></li>
		</ul>
		<h3>菜單</h3>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<td>品項</td>
					<td>價錢</td>
					<td>備註</td>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach ($menu as $index => $item) {
						if ($index < 10)
							echo "<tr>";
						else
							echo "<tr style='display: none;'>";
						echo "<td>".$item['name']."</td>";
						echo "<td>".$item['price']."</td>";
						echo "<td>".$item['note']."</td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
		<button class="btn btn-flat btn-info" onclick="showMore()" id="showMoreButton">顯示更多</button>
	</div>
</div>
@stop