<?php
namespace App\Http\Controllers;
use DB;
use App\User;
use App\Http\Controllers\Controller;
use Input;

class AddController extends Controller
{
	public function index() {
		return view("add", array(
			"title" => "新增餐廳 - 中大美食"
		));
	}

	public function post() {
		$data = array(
			"name" => Input::get("name"),
			"telephone" => Input::get("telephone"),
			"address" => Input::get("address"),
			"note" => Input::get("note"),
			"type" => Input::get("type"),
			"togo" => Input::get('togo')
		);

		DB::collection('Info')->insert($data);

		return redirect("/add-food/thanks");
	}

	public function thanks() {
		return view("add-thanks");
	}
}