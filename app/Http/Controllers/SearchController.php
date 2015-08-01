<?php
namespace App\Http\Controllers;
use DB;
use App\User;
use App\Http\Controllers\Controller;
use Input;
use Session;

class SearchController extends Controller
{
	public function index($query) {
		$type = array(
			"dine" => "午晚餐",
			"午晚餐" => "午晚餐",
			"drink" => "飲料",
			"飲料" => "飲料",
			"breakfast" => "早餐",
			"早餐" => "早餐");
		$data = DB::collection('Info')->where("name", $query)->first();
		if ($data) {
			$menu = array();
			if (!empty($data['menu']))
				$menu = $data['menu'];
			$note = '';
			if (!empty($data['note']))
				$note = $data['note'];

			$comments = array();
			if (!empty($data['comments']))
				$comments = array_reverse($data['comments']);

			$commentButton = '';
			if (!Session::get('facebookId'))
				$commentButton = "<a class='btn btn-flat btn-default' style='color: white' href='/auth/facebook'>登入新增評論</a>";
			else
				$commentButton = '<button type="button" class="btn btn-flat btn-default" data-toggle="modal" data-target="#addCommentModal" style="color:white">新增評論</button>';
				

			return view("search", array(
				"title" => $data['name']." - 中大美食",
				"name" => $data['name'],
				"telephone" => $data['telephone'],
				"type" => $type[$data['type']],
				"address" => $data['address'],
				"togo" => $data['togo'],
				"note" => $note,
				"comments" => $comments,
				"newCommentButton" => $commentButton,
				"menu" => $menu));			
		}else
			return redirect("/");
	}

	public function api($query) {
		$data = DB::collection('Info')->where("name", "LIKE", "%".$query."%")->get();

		return $data;
	}

	public function showBreakfast() {
		$result = DB::collection('Info')->where("type", "早餐")->get();

		return view("category", array(
			"title" => "早餐 - 中大美食",
			"results" => $result
		));
	}

	public function showDine() {
		$result = DB::collection('Info')->where("type", "午晚餐")->get();

		return view("category", array(
			"title" => "午晚餐 - 中大美食",
			"results" => $result
		));
	}

	public function showDrink() {
		$result = DB::collection('Info')->where("type", "飲料")->get();

		return view("category", array(
			"title" => "飲料 - 中大美食",
			"results" => $result
		));
	}

	public function showMidnightSnack() {
		$result = DB::collection('Info')->where("type", "宵夜")->get();

		return view("category", array(
			"title" => "宵夜 - 中大美食",
			"results" => $result
		));
	}


}