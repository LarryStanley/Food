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

Route::get('/auth/facebook', "CommentController@facebookLogin");
Route::post('/add-comment', "CommentController@addComment");

Route::get('/add-food', "AddController@index");
Route::post('/add-food', "AddController@post");

Route::get('/about', function() {
	return view('about');
});

Route::get('/api/auto-complete', "SearchController@autoComplete");
Route::get('/api/{query}', "SearchController@api");
Route::get('/{query}', "SearchController@index");