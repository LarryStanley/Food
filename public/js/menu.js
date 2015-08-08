angular.module('addMenu', [])
	.controller('MenuController', function() {
		var menu = this;
		menu.menuData = [
			{
				category_name: "",
				note: "",
				items: []
			}
		];

		menu.note = [];
		menu.price = [];

		menu.addCategory = function() {
			if (menu.category_name){
				menu.menuData.push({category_name: menu.category_name, note: menu.category_note, items: []});
				menu.category_name = '';
				menu.category_note = '';
			}
		};

		menu.addItem = function(index) {
			if (menu.name){
				if (menu.note[index] === undefined)
					menu.note[index] = '';
				if (menu.price[index] === undefined)
					menu.price[index] = '';

				menu.menuData[index].items.push({name: menu.name[index], price:menu.price[index], note:menu.note[index]});
				menu.name[index] = '';
				angular.element("#itemNameInput-"+index).trigger('focus');
			}
		};
	});