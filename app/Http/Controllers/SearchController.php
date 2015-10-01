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
				$likeArea = '';

				if (!Session::get('facebookId')){
					if(empty($data['likes']))
						$data['likes'] = array("like_count" => 0, "dislike_count" => 0, "like_people" => array(), "dislike_people" => array());

					$commentButton = "<a class='btn btn-default' style='color: white' href='/login/".$query."'>登入新增評論</a>";
					$likeArea = '
					<div id="likeArea">
						<a href="/login/'.$query.'">
							<sapn id="like">
								<i class="fa fa-lg fa-thumbs-up"></i> 
								<span class="counter">'.$data['likes']['like_count'].'</span> 					
							</sapn> 
						</a>
						<a href="/login/'.$query.'">
							<span id="dislike">
								<i class="fa fa-lg fa-thumbs-down"></i>		
								<span  class="counter">'.$data['likes']['dislike_count'].'</span>			
							</span>
						</a>
					</div>';
				} else {
					$likeClass = '';
					$dislikeClass = '';
					if (!empty($data['likes'])) {
						foreach ($data['likes']['like_people'] as $key => $value) {
							if ($value['id'] == Session::get('facebookId')) {
								$likeClass = 'likeActive';
								break;
							}
						}

						if ($likeClass != 'likeActive') {
							foreach ($data['likes']['dislike_people'] as $key => $value) {
								if ($value['id'] == Session::get('facebookId')) {
									$dislikeClass = 'dislikeActive';
									break;
								}
							}
						}
					} else {
						$data['likes'] = array("like_count" => 0, "dislike_count" => 0, "like_people" => array(), "dislike_people" => array());
					}

					$commentButton = '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#addCommentModal" style="color:white">新增評論</button>';
					$likeArea = '
								<div id="likeArea">
									<a href="#" onclick="return false;" ng-click="food.likeClick()" ng-init="food.likeCounter = '.$data['likes']['like_count'].'">
										<sapn id="like" class="'.$likeClass.'">
											<i class="fa fa-lg fa-thumbs-up"></i> 
											<span class="counter">{{food.likeCounter}}</span> 					
										</sapn> 
									</a>
									<a href="#" onclick="return false;" ng-click="food.dislikeClick()" ng-init="food.dislikeCounter = '.$data['likes']['dislike_count'].'">
										<span id="dislike" class="'.$dislikeClass.'">
											<i class="fa fa-lg fa-thumbs-down"></i>		
											<span  class="counter">{{food.dislikeCounter}}</span>			
										</span>
									</a>
								</div>';
				}
					
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

				if (empty($data['priceInterval']))
					$data['priceInterval'] = '';

				return view("search", array(
					"title" => $data['name']." - 中大美食",
					"name" => $data['name'],
					"telephone" => $data['telephone'],
					"priceInterval" => $data['priceInterval'],
					"type" => $data['type'],
					"address" => $data['address'],
					"togo" => $data['togo'],
					"note" => $note,
					"comments" => $comments,
					"newCommentButton" => $commentButton,
					"likeArea" => $likeArea,
					"recentView" => $recentView,
					"metaImage" => $metaImage,
					"coordinate" => $coordinate,
					"ng_app" => "food",
					"menu" => $menu));			
			}else
				return view("index", array(
					"title" => $data['name']." - 中大美食",
					"message" => "<h2>該筆資料還在審核中!</h2>"));
		}else
			return view("errors/404");
	}

	public function queryPage($domain, $query) {
		$result = DB::collection('Info')->where("name", "LIKE", "%".$query."%")->orderBy('query_times', 'desc')->get();

		// get data from food
		$data = DB::collection('Info')->get();
		foreach ($data as $key => $value) {
			if (!empty($value["hashTags"])) {
				foreach ($value["hashTags"] as $index => $hashTag) {
					similar_text($query, $hashTag[0], $percent);
					if ($percent > 90) {
						array_push($result, $value);		
						break;				
					}
				}
			}
		}

		return view("category", array(
			"title" => $query." - 中大美食",
			"results" => $result,
			"query" => $query
		));
	}

	public function showAllData() {
		$data = DB::collection("Info")->get();

		return $data;
	}

	public function api($domain, $query) {
		$data = DB::collection('Info')->where("name", "LIKE", "%".$query."%")->get();

		return $data;
	}

	public function autoComplete() {
		$data = DB::collection('Info')->lists("name");
		
		$hashTags = DB::collection('Info')->lists("hashTags");
		foreach ($hashTags as $key => $value) {
			if ($value) {
				foreach ($value as $index => $item) {
					array_push($data, $item[0]);
				}
			}
		}

		$data = array_unique($data);

		return $data;
	}

	public function showBreakfast() {
		$result = DB::collection('Info')->where("type", "早餐")->orderBy('query_times', 'desc')->get();

		return view("category", array(
			"title" => "早餐 - 中大美食",
			"results" => $result,
			"type" => "category"
		));
	}

	public function showDine() {
		$result = DB::collection('Info')->where("type", "午晚餐")->orderBy('query_times', 'desc')->get();

		return view("category", array(
			"title" => "午晚餐 - 中大美食",
			"results" => $result,
			"type" => "category"
		));
	}

	public function showDrink() {
		$result = DB::collection('Info')->where("type", "飲料")->orderBy('query_times', 'desc')->get();

		return view("category", array(
			"title" => "飲料 - 中大美食",
			"results" => $result,
			"type" => "category"
		));
	}

	public function showMidnightSnack() {
		$result = DB::collection('Info')->where("type", "宵夜")->orderBy('query_times', 'desc')->get();

		return view("category", array(
			"title" => "宵夜 - 中大美食",
			"results" => $result,
			"type" => "category"
		));
	}

	public function showSnackStreet() {
		$result = DB::collection('Info')->where("location", "宵夜街")->orderBy('query_times', 'desc')->get();

		return view("category", array(
			"title" => "宵夜街 - 中大美食",
			"results" => $result,
			"query" => "宵夜街",
			"type" => "area"
		));
	}

	public function showBackDoor() {
		$result = DB::collection('Info')->where("location", "後門")->orderBy('query_times', 'desc')->get();

		return view("category", array(
			"title" => "後門 - 中大美食",
			"results" => $result,
			"query" => "後門",
			"type" => "area"
		));
	}

	public function showStreet() {
		$result = DB::collection('Info')->where("location", "松苑")->orderBy('query_times', 'desc')->get();

		return view("category", array(
			"title" => "松苑 - 中大美食",
			"results" => $result,
			"query" => "松苑",
			"type" => "area"
		));
	}

	public function showNine() {
		$result = DB::collection('Info')->where("location", "九餐")->orderBy('query_times', 'desc')->get();

		return view("category", array(
			"title" => "九餐 - 中大美食",
			"results" => $result,
			"query" => "九餐",
			"type" => "area"
		));
	}

	public function showSeven() {
		$result = DB::collection('Info')->where("location", "松果餐廳")->orderBy('query_times', 'desc')->get();

		return view("category", array(
			"title" => "松果餐廳 - 中大美食",
			"results" => $result,
			"query" => "松果餐廳",
			"type" => "area"
		));
	}

	public function showToGo() {
		$result = DB::collection('Info')->where("location", "外送")->orderBy('query_times', 'desc')->get();

		return view("category", array(
			"title" => "外送 - 中大美食",
			"results" => $result, 
			"query" => "外送",
			"type" => "area"
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