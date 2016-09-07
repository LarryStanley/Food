<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['domain' => '{server}.ncufood.info'], function () {
	$myURL = ["beta.ncufood.info", "www.ncufood.info"];

   	Route::get('/', function () {
		return view("index");
	});

	Route::get('/menu-format', function() {
		return view("menu-format");
	});

	Route::get('/breakfast', "SearchController@showBreakfast");
	Route::get('/dine', "SearchController@showDine");
	Route::get('/drink', "SearchController@showDrink");
	Route::get('/midnight-snack', "SearchController@showMidnightSnack");
	Route::get('/宵夜街', "SearchController@showSnackStreet");
	Route::get('/後門', "SearchController@showBackDoor");
	Route::get('/松苑', "SearchController@showStreet");
	Route::get('/九餐', "SearchController@showNine");
	Route::get('/松果餐廳', "SearchController@showSeven");
	Route::get('/外送', "SearchController@showToGo");

	Route::get('/auth/facebook', "CommentController@facebookLogin");
	Route::post('/add-comment', "CommentController@addComment");
	Route::post('/add-like', "CommentController@addLike");

	Route::get('/add-food', "AddController@index");
	Route::post('/add-food', "AddController@post");
	Route::get('/feedback', "AddController@showFeedback");
	Route::post('/feedback', "AddController@recordFeedback");

	Route::get('/about', function() {
		return view('about', ["title" => "關於中大美食", "metaImage" => "http://www.ncufood.info/image/about.jpg"]);
	});

	Route::get('/login', function() {
		if (!Session::get('facebookId'))
			return view('login');
		else
			return redirect('/');
	});

	Route::get('/login/{next}', function($domain, $next) {
		if (!Session::get('facebookId'))
			return view('login');
		else
			return redirect('/'.$next);
	});

	Route::post('/admin/save', "AdminController@saveData");
	Route::get('/admin', "AdminController@index");

	Route::get('/query/{query}', "SearchController@queryPage");

	Route::get('/api/all', "SearchController@showAllData");
	Route::get('/api/all_name', "SearchController@showAllRestaurantName");
	Route::get('/api/auto-complete', "SearchController@autoComplete");
	Route::get('/api/breakfast', "SearchController@showBreakfastApi");
	Route::get('/api/dine', "SearchController@showDineApi");
	Route::get('/api/drink', "SearchController@showDrinkApi");
	Route::get('/api/midnight-snack', "SearchController@showMidnightSnackApi");

	Route::get('/api/{query}', "SearchController@api");

	Route::get('/{query}', "SearchController@index"); 
});