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
					$commentButton = "<a class='btn btn-default' style='color: white' href='/auth/facebook'>登入新增評論</a>";
				else
					$commentButton = '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#addCommentModal" style="color:white">新增評論</button>';
					
				// count query times
				$queryTimes = 1;
				if (!empty($data['query_times'])) 
					$queryTimes = (int)$data['query_times'] + 1;
				DB::collection("Info")->where("name", $query)->update(["query_times" => $queryTimes]);

				// get recent view
				$recentView = '';
				if (Session::get('id')) {
					$recentView = DB::collection("viewLog")->where("id", Session::get('id'))->first();
					$recentView = $recentView['log'];
					$recentView = array_reverse($recentView);
				}

				// view log
				$id = '';
				if (empty(Session::get('id'))) {
					$id = str_random(12);
					Session::put("id", $id);
				}else
					$id = Session::get('id');

				$log = DB::collection("viewLog")->where("id", $id)->first();
				if (!$log) {
					DB::collection("viewLog")->insert(array(
						"id" => $id, 
						"log" => array(array("name" => $query, "time" => date('m/d/Y h:i:s a', time())))
					));
				}else{
					DB::collection("viewLog")->where("id", $id)->push("log", array(
						"name" => $query, 
						"time" => date('m/d/Y h:i:s a', time())
					));
				}


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
					"recentView" => $recentView,
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

	public function autoComplete() {
		$data = DB::collection('Info')->lists("name");

		return $data;
	}

	public function showBreakfast() {
		$result = DB::collection('Info')->where("type", "早餐")->orderBy('query_times', 'desc')->get();

		return view("category", array(
			"title" => "早餐 - 中大美食",
			"results" => $result
		));
	}

	public function showDine() {
		$result = DB::collection('Info')->where("type", "午晚餐")->orderBy('query_times', 'desc')->get();

		return view("category", array(
			"title" => "午晚餐 - 中大美食",
			"results" => $result
		));
	}

	public function showDrink() {
		$result = DB::collection('Info')->where("type", "飲料")->orderBy('query_times', 'desc')->get();

		return view("category", array(
			"title" => "飲料 - 中大美食",
			"results" => $result
		));
	}

	public function showMidnightSnack() {
		$result = DB::collection('Info')->where("type", "宵夜")->orderBy('query_times', 'desc')->get();

		return view("category", array(
			"title" => "宵夜 - 中大美食",
			"results" => $result
		));
	}


}