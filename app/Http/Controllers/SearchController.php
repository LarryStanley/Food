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
		$data = DB::collection('Info')->where("name", $query)->first();
		if ($data) {
			if (empty($data['prove']))
				$data['prove'] = 'true';
			if ($data['prove'] == 'true') {
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
					
				// count query times
				$queryTimes = 1;
				if (!empty($data['query_times'])) 
					$queryTimes = (int)$data['query_times'] + 1;
				DB::collection("Info")->where("name", $query)->update(["query_times" => $queryTimes]);

				return view("search", array(
					"title" => $data['name']." - 中大美食",
					"name" => $data['name'],
					"telephone" => $data['telephone'],
					"type" => $data['type'],
					"address" => $data['address'],
					"togo" => $data['togo'],
					"note" => $note,
					"comments" => $comments,
					"newCommentButton" => $commentButton,
					"menu" => $menu));			
			}else
				return view("index", array(
					"title" => $data['name']." - 中大美食",
					"message" => "<p>該筆資料還在審核中!</p>"));
		}else
			return view("errors/404");
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