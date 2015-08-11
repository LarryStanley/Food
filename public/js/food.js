angular.module('food', [])
	.controller('FoodController', function($scope, $http) {
		var food = this;
		food.likeCounter = 0;
		food.dislikeCounter = 0;

		food.likeClick = function() {
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
		}

		food.dislikeClick = function() {
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
		}

	});