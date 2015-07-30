<?php
namespace App\Http\Controllers;
use DB;
use App\User;
use App\Http\Controllers\Controller;
use Input;

class SearchController extends Controller
{
	public function index($query) {
		$type = array(
			"dine" => "午晚餐",
			"drink" => "飲料",
			"breakfast" => "早餐");
		$data = DB::collection('Info')->where("name", $query)->first();
		return view("search", array(
			"title" => $data['name']." - 中大美食",
			"name" => $data['name'],
			"telephone" => $data['telephone'],
			"type" => $type[$data['type']],
			"address" => $data['address'],
			"togo" => $data['togo'],
			"menu" => $data['menu']));
	}

	public function api($query) {
		$data = DB::collection('Info')->where("name", "LIKE", "%".$query."%")->get();

		return $data;
	}
}