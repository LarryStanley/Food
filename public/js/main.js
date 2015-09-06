var showTableRow = 11;
var showTable = 0;
var type = {
	"dine" : "午晚餐",
	"drink" : "飲料",
	"breakfast" : "早餐"
};

function showMore() {
	showTableRow += 20;
	if ($('.table tr').length < showTableRow) {
	    $("#showMoreButton").hide();
	}
	$('.table').find('tr').each(function (i, el) {
	   if ( i < showTableRow) {
	        $(this).show();
	    }
	});
}

function showMoreTable (tableId) {
	if ($("#"+tableId+ " table").css('display') !== 'none') {
		$("#"+tableId+" p").hide();
		$("#"+tableId+" table").hide();
	}else{
		$("#"+tableId+" p").show();
		$("#"+tableId+" table").show();
	}

	event.preventDefault();
}

function search() {
	if ($("#searchInput").val()){
		/*$(".fb-share-button").remove();
		$("#loading").remove();
		$("#add_food").remove();
		$("#search").append("<div id='loading'>資料查詢中...</div>");
		$("body").find(".result").each(function(i, el) {
			$(this).remove();
		});
		$("#detailResult").remove();
		var query = "/api/" + $("#searchInput").val();
		$.getJSON( query, function( data ) {
			$("#loading").remove();
			if (data.length === 0) {
				$("#search").append("<div id='loading'>查無資料</div>");
				$("#search").append('<p id="add_food">找不到你要的餐廳？<a href="/add-food" class="btn btn-default" style="color: white;">立即新增</a></p>');
			}else {
				$('#search').animate({
					top: '15%', 
					transform: 'translate(-50%, -15%)'
				}, "slow", function() {
					$.each(data, function(index, item) {
						var result = '';
						if (index)
						result += '<div class="well animated fadeIn result" id="result" style="margin-top: 20px"><h2 style="display:inline">'+ item['name'] +'</h2><a href="/'+ item['name'] +'" class="seeMore btn btn-flat btn-material-orange-A400">查看更多</a></div>';
						else
						result += '<div class="well animated fadeIn result" id="result"><h2 style="display:inline">'+ item['name'] +'</h2><a href="/'+ item['name'] +'" class="seeMore btn btn-flat btn-material-orange-A400">查看更多</a></div>';
						$("#search").append(result);
					});
					$("#search").append('<p id="add_food">找不到你知道的餐廳？<a href="/add-food" class="btn btn-default" style="color: white;">立即新增</a></p>');
				});
			}
		});*/
		
		window.location= "/query/"+$("#searchInput").val();
	}else{
		$("#search").append("<div id='loading'>請輸入要查詢的店家</div>");
	}
}

function showMoreComment() {
	console.log("yes");
	$('#comment').find('.row').each(function (i, el) {
        $(el).show();
	});

	$('#showMoreCommentButton').hide();
}

$(document).keypress(function(e) {
	if(e.which == 13){
		if ($("#searchInput").is(":focus"))
			search();
	}
});

$(document).ready(function(){
	var allFoodData = [];
	$.ajax({
		url: '/api/auto-complete/',
		dataType: 'json',
		jsonpCallback: 'callback',
		type: 'GET',
		success: function (data) {
			$.each(data, function(index, value) {
				var result = {value: value, data: value};
				allFoodData.push(result);
			})
		}
	});

	$("#searchInput").autocomplete({
		lookup: allFoodData,
		preserveInput:true,
		onSelect: function(suggestion) {
			window.location= "/query/"+suggestion.data;
		}
	});
});