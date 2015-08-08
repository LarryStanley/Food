<?php
namespace App\Http\Controllers;
use DB;
use App\User;
use App\Http\Controllers\Controller;
use Input;
use Session;
use Image;

class SearchController extends Controller
{
	public function index($domain, $query) {
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

				$coordinate = '';
				if (!empty($data['coordinate']))
					$coordinate = $data['coordinate'];
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
					if ($recentView){
						$recentView = $recentView['log'];
						$recentView = array_reverse($recentView);
					}
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

				// add image
				$metaImage = '';
				if (!empty($data['og_image_url'])) {
					$metaImage = $data['og_image_url'][0];
				} else {
					$metaImage = $this->createImage($data['name']);
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
					"metaImage" => $metaImage,
					"coordinate" => $coordinate,
					"menu" => $menu));			
			}else
				return view("index", array(
					"title" => $data['name']." - 中大美食",
					"message" => "<h2>該筆資料還在審核中!</h2>"));
		}else
			return view("errors/404");
	}

	public function api($domain, $query) {
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

	public function createImage($name) {
		$data = DB::collection('Info')->where('name', $name)->first();
		$image = Image::canvas(1200, 630, '#0277BD');
 		$image->text($data['name'], 60, 130, function($font) {
 			$font->file(public_path('fonts/NotoSansCJKtc-Light.otf'));
			$font->size(72);
			$font->color("#FFF");
     	});

     	$image->line(70, 190, 1130, 190, function ($draw) {
		    $draw->color('#FFF');
		});

 		$image->text("● 電話：".$data['telephone'], 80, 290, function($font) {
 			$font->file(public_path('fonts/NotoSansCJKtc-Light.otf'));
			$font->size(48);
			$font->color("#FFF");
     	});

 		$image->text("● 地址：".$data['address'], 80, 350, function($font) {
 			$font->file(public_path('fonts/NotoSansCJKtc-Light.otf'));
			$font->size(48);
			$font->color("#FFF");
     	});

 		$image->text("● 類型：".$data['type'], 80, 410, function($font) {
 			$font->file(public_path('fonts/NotoSansCJKtc-Light.otf'));
			$font->size(48);
			$font->color("#FFF");
     	});

 		$image->text("● 外送：".$data['togo'], 80, 470, function($font) {
 			$font->file(public_path('fonts/NotoSansCJKtc-Light.otf'));
			$font->size(48);		
			$font->color("#FFF");
     	});

 		$image->text("● 備註：".$data['note'], 80, 530, function($font) {
 			$font->file(public_path('fonts/NotoSansCJKtc-Light.otf'));
			$font->size(48);
			$font->color("#FFF");
     	});


		$image->encode('jpg');
		$filename = $data['name'];
		$client_id="0cabe1987d4fb3f";
		$timeout = 30;
		$pvars = array('image' => base64_encode($image));
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
		curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
		$out = curl_exec($curl);
		curl_close ($curl);
		$pms = json_decode($out,true);

		if(!empty($pms['data']['link'])){
			DB::collection('Info')->where('name', $name)->push('og_image_url', $pms['data']['link']);
			return $pms['data']['link'];
		}
	}

}