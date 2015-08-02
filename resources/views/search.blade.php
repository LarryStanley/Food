@extends("default")

@section("content")
<div class="top" id="search">
	<div id="title">
		<a href="/"><h1  style="display:inline">中大美食</h1> beta (其實沒有)</a>
	</div>
	<div class="form-group-material-grey-400">
		<input type="text" class="form-control" placeholder="立即查詢餐廳 例如：樂活堡" style="color: white" id="searchInput">
		<button class="btn btn-default pull-right" style="color: white" onclick="search()">查詢</button>
	</div>
	<div class="well" id="detailResult">
		<div id="info">
			<h2><?php echo $name;?></h2>
			<hr>
			<ul>
				<li>電話：<?php echo $telephone;?></li>
				<li>地址：<?php echo $address;?></li>
				<li>類型：<?php echo $type;?></li>
				<li>外送：<?php echo $togo;?></li>
				<li>備註：<?php echo $note;?></li>
			</ul>
		</div>
			<div id="menu">
				<h3>菜單</h3>
					<?php
						if (empty($menu[0]['category_name'])) {
							echo '<table class="table table-striped table-hover">
									<thead>
										<tr>
											<td>品項</td>
											<td>價錢</td>
											<td>備註</td>
										</tr>
									</thead>
									<tbody>'; 
							foreach ($menu as $index => $item) {
								if ($index < 10)
									echo "<tr>";
								else
									echo "<tr style='display:none'>";
								echo "<td>".$item['name']."</td>";
								echo "<td>".$item['price']."</td>";
								if (!empty($item['note']))
									echo "<td>".$item['note']."</td>";
								else
									echo "<td></td>";
								echo "</tr>";
							}	
							echo '</tbody>
								</table>
								<button class="btn btn-flat btn-info" onclick="showMore()" id="showMoreButton">顯示更多</button>';
						} else {
							foreach ($menu as $index => $category) {
								echo '<div id="'.$index.'"><a href="#" onclick="showMoreTable('.$index.')"><h4>'.$category['category_name'].'</h4></a>';
								if (!empty($category['note']))
									echo '<p style="display: none;">'.$category['note'].'</p>';
								echo '<table class="table table-striped table-hover" style="display: none;">
									<thead>
										<tr>
											<td>品項</td>
											<td>價錢</td>
											<td>備註</td>
										</tr>
									</thead>
									<tbody>'; 
								foreach ($category['items'] as $key => $item) {
									echo "<tr>";
									echo "<td>".$item['name']."</td>";
									echo "<td>".$item['price']."</td>";
									if (!empty($item['note']))
										echo "<td>".$item['note']."</td>";
									else
										echo "<td></td>";
									echo "</tr>";
								}	
								echo '</tbody>
									</table></div>';
							}
							echo '<script>$("#0").show();</script>';
						}
					?>
		</div>
		<div id="comments">
			<h3>評論</h3>
			<hr>
			<?php 
				if (count($comments)) {
					echo "<div id='commnet' class='container'>";
					foreach ($comments as $index => $comment) {
						$result = '';
						if ($index < 1)
							$result = "<div class='row'>";
						else
							$result = "<div style='display: none' class='row'>";
						$result .= "<div class='col-sm-1'><a href='".$comment['user']['link']."' target='_blank'><img src='http://graph.facebook.com/".$comment['user']['id']."/picture?type=square' class='img-circle' style='margin-top: 5px'></a></div>";
						$result .= "<div class='col-sm-8'><h4>".$comment['user']['name']."</h4>";
						$result .= "<p>".$comment['comment']."</p></div></div>";

						echo $result;				
					}
					echo "</div>";
					if (count($comments) > 1)
						echo "<button class='btn btn-flat btn-default' style='color: white' id='showMoreCommentButton' onclick='showMoreComment()'>更多評論</button>";
					echo $newCommentButton;
				}else
					echo "<p>目前暫無評論".$newCommentButton."</p>";
			?>
		</div>
	</div>
	<p id="add_food">找不到你知道的餐廳？<a href="/add-food" class="btn btn-default" style="color: white;">立即新增</a></p>
</div>
<div class="modal fade" id="addCommentModal" tabindex="-1" role="dialog" aria-labelledby="addCommentModalLabel">
	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="addCommentModalLabel">新增關於 <?php echo $name ;?> 的評論</h4>
      		</div>
			<form  id="addCommentForm" action="/add-comment" class="form-group-material-orange-500" method="POST">
	      		<div class="modal-body">
						<textarea class="form-control" rows="5" name="comment"></textarea>
						<input type="hidden" name="food_name" value="<?php echo $name; ?>">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<p>您將用Facebook身份對「<?php echo $name;?>」進行評論</p>
	      		</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-flat btn-default" data-dismiss="modal">取消</button>
		        	<button type="submit" class="btn btn-flat btn-warning">送出</button>
		      	</div>
	      	</from>
		</div>
	</div>
</div>
<script>
	$('#addCommentForm').submit(function(){
	    $.ajax({
	    	url: $('#addCommentForm').attr('action'),
	    	type: "POST",
	    	data : $('#addCommentForm').serialize(),
	    	success: function(data){
	    		console.log(data);
	    		if (data === 'success') {
	    			$("#addCommentModal").modal('hide');
	    			location.reload();
	    		}
	      	}
	    });
	    return false;
	});
</script>
@stop