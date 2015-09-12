angular.module('food', [])
	.controller('FoodController', function($scope, $http) {
		var food = this;
		food.order = [];
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

		}

	});