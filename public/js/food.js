angular.module('food', [])
	.controller('FoodController', function($scope, $http) {
		var food = this;
		food.order = [];
		food.totalPrice = 0;
		food.likeClick = function() {
			$.post("/add-like", {
				"type" : "like",
				"food_name" : $("#food_name").val(),
				"_token" : $("#token").val()
			}).done(function(data) {
				console.log(data);
				if ($("#like").hasClass("likeActive")) {
					$("#like").removeClass("likeActive");
					food.likeCounter--;
				} else {
					$("#like").addClass("likeActive");
					food.likeCounter++;
					if ($("#dislike").hasClass("dislikeActive")) {
						$("#dislike").removeClass("dislikeActive");
						food.dislikeCounter--;
					}
				}
				$scope.$apply();
			});
		}

		food.dislikeClick = function() {
			$.post("/add-like", {
				"type" : "dislike",
				"food_name" : $("#food_name").val(),
				"_token" : $("#token").val()
			}).done(function(data) {
				console.log(data);
				if ($("#dislike").hasClass("dislikeActive")) {
					$("#dislike").removeClass("dislikeActive");
					food.dislikeCounter--;
				} else {
					$("#dislike").addClass("dislikeActive");
					food.dislikeCounter++;
					if ($("#like").hasClass("likeActive")) {
						$("#like").removeClass("likeActive");
						food.likeCounter--;
					}
				}
				$scope.$apply();
			});
		}

		food.orderClick = function(name, price) {
			var itemExist = false;
			$.each(food.order, function(index, item) {
				if (item['name'] === name) {
					food.order[index]['count']++;
					itemExist = true;
					return false;
				}
			});

			if (!itemExist) {
				var item = {
					"name" : name,
					"price" : price,
					"count" : 1
				};

				food.order.push(item);
			}

			food.totalPrice += price;
			$("#order").show();
		}

		food.orderCancel = function(name, price) {
			$.each(food.order, function(index, item) {
				if (item['name'] === name) {
					food.order[index]['count']--;

					if (item['count'] == 0) {
						food.order.splice(index, 1);
					}

					if (food.order.length == 0)
						$("#order").hide();

					food.totalPrice -= price;
					return false;
				}
			});
		}

	});