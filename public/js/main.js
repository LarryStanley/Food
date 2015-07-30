var showTableRow = 11;
var type = {
	"dine" : "午晚餐",
	"drink" : "飲料",
	"breakfast" : "早餐"
};

function showMore(tableId) {
	showTableRow += 20;
	if ($('#' + tableId +' tr').length < showTableRow) {
	    $("#showMoreButton").hide();
	}
	$('#' + tableId).find('tr').each(function (i, el) {
	   if ( i < showTableRow) {
	        $(this).show();
	    }
	});
}

function search() {
	$("#loading").remove();
	$("#search").append("<div id='loading'>資料查詢中...</div>");
	$("#result").remove();
	var query = "/api/" + $("#searchInput").val()
	$.getJSON( query, function( data ) {
		$("#loading").remove();
		if (data.length === 0) {
			$("#search").append("<div id='loading'>查無資料</div>");
		}else {
			$('#search').animate({
				top: '10%', 
				transform: 'translate(-50%, 0%)'
			}, "slow", function() {
				$.each(data, function(index, item) {
					var result = '<div class="well animated fadeIn" id="result"><h2>'+ item['name'] +'</h2><hr><ul><li>電話：'+ item['telephone'] +'</li><li>地址：'+ item['address'] +'</li><li>類型：'+ type[item['type']] +'</li><li>外送：'+ item['togo'] +'</li></ul>';
					result += '<h3>菜單</h3>';
					result += '<table class="table table-striped table-hover" id="'+ index +'"><thead><tr><td>品項</td><td>價錢</td><td>備註</td></tr></thead><tbody>';
					$.each(item['menu'], function(key, food) {
						if (key < 5)
							result += "<tr>";
						else
							result += "<tr style='display: none'>";
						result += "<td>"+ food['name'] +"</td>";
						result += "<td>"+ food['price'] +"</td>";
						result += "<td>"+ food['note'] +"</td>";
						result += "</tr>";
					});
					result += '</tbody></table><button class="btn btn-flat btn-info" onclick="showMore('+ index +')" id="showMoreButton">顯示更多</button></div>';
					$("#search").append(result);
				});
			});
		}
	});
}

$(document).keypress(function(e) {
	if(e.which == 13)
		search();
});