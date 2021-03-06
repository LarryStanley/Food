angular.module('admin', [])
	.controller('AdminController', function($scope, $http) {
		var admin = this;
		admin.data = [];
		admin.currentData = {};

		admin.changeData = function(index) {
			angular.element("#successLabel").remove();
			admin.currentData = admin.data[index];
		};

		admin.getHashTags = function() {
			var foodData = '';
			admin.currentData.hashTags = [];
			if (admin.currentData.menu[0].category_name) {
				$.each(admin.currentData.menu, function(index, category){
					foodData += category.category_name;
					$.each(category.items, function(key, item) {
						foodData += item.name + " ";
					});
				});
			} else {
				$.each(admin.currentData.menu, function(index, item){
					foodData += item.name + " ";
				});
			}

			var options = {
			  workerUrl: '/js/wordfreq.worker.js' };
			var wordfreq = WordFreq(options).process(foodData, function (list) {
				admin.currentData.hashTags = list;
				$scope.$apply();
			});
		}

		admin.caculatePrice = function() {
			var deviation = 0;
			var mean = 0;
			var itemLength = 0;
			
			// calculate mean 
			if (admin.currentData.menu[0].category_name) {
				$.each(admin.currentData.menu, function(index, category){
					$.each(category.items, function(key, item) {
						itemLength++;
						mean += parseInt(item.price);
					});
				});
			} else {
				$.each(admin.currentData.menu, function(index, item){
					itemLength++;
					mean += parseInt(item.price);
				});
			}

			mean = mean / itemLength;

			// calculate deviation
			if (admin.currentData.menu[0].category_name) {
				$.each(admin.currentData.menu, function(index, category){
					$.each(category.items, function(key, item) {
						deviation += Math.pow((parseInt(item.price) - mean), 2);
					});
				});
			} else {
				$.each(admin.currentData.menu, function(index, item){
					deviation += Math.pow((parseInt(item.price) - mean), 2);
				});
			}

			deviation = Math.sqrt(deviation / (itemLength -1));

			admin.currentData.priceInterval = parseInt(5 * Math.round((mean - deviation)/5)) + " ~ " + parseInt(5 * Math.round((mean + deviation)/5));
		}

		$http.get('/api/all').
    		success(function(data, status, headers, config) {
    			admin.data = data;
    			admin.changeData(5);
	    }).
    		error(function(data, status, headers, config) {
    			console.log(data);
	    });
	});