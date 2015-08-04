<?php
namespace App\Http\Controllers;
use DB;
use App\User;
use App\Http\Controllers\Controller;
use Input;
use Session;
use URL;

class AddController extends Controller
{
	public function index() {
		if (Session::get('facebookId')) {
			return view("add", array(
				"title" => "新增餐廳 - 中大美食"
			));			
		} else 
			return redirect("/auth/facebook");
	}

	public function post() {

		// check add same
		$previousData = DB::collection("Info")->where("name", Input::get("name"))->first();
		if ($previousData) {
			$message = "非常感謝您的新增，但是「<a href='/".$previousData['name']."'>".$previousData['name']."</a>」有新增過囉！<br>";

			return view("add-thanks", array("message" => $message));
		}else{
			$userData = DB::collection("users")->where("id", Session::get("facebookId"))->first();

			$menuFile = Input::file('menu_file');

			$fileSize = Input::file('menu_file')->getSize();
			if ($fileSize < 20971520) {
				$fileTyleArray = ["json", "jpg", "jpeg", "png", "JSON", "JPG", "JPEG", "PNG", "CSV", "csv"];
				$fileOriginalName = Input::file('menu_file')->getClientOriginalName();
				$fileType = explode(".",$fileOriginalName);

				if (in_array($fileType[count($fileType) - 1], $fileTyleArray)) {
					$destinationPath = public_path().'/menu';
					$filename = str_random(12);
					$upload_success = Input::file('menu_file')->move($destinationPath, $filename.".".$fileType[count($fileType) - 1]);

					$data = array(
						"name" => strip_tags(Input::get("name")),
						"telephone" => strip_tags(Input::get("telephone")),
						"address" => strip_tags(Input::get("address")),
						"note" => strip_tags(Input::get("note")),
						"type" => strip_tags(Input::get("type")),
						"togo" => strip_tags(Input::get('togo')),
						"location" => strip_tags(Input::get('location')),
						"record_user" => $userData,
						"menu_file_url" =>  $filename.".".$fileType[count($fileType) - 1],
						"prove" => 'false'
					);
					DB::collection('Info')->insert($data);

					$message = "感謝您的新增，讓我們的資料更加豐富";
					$message .= "<br>請給我們一點時間審核，審核完後您可至「<a href='/".Input::get('name')."'>".Input::get('name')."</a>」查看";

					return view("add-thanks", array("message" => $message));
				}else
					return view("add-thanks", array("message" => "感謝您的新增，但您的菜單似乎有點問題喔!<br>您的菜單格式為：".$fileType[count($fileType) - 1]." <a href=".URL::previous()." onclick='history.back()'>更改菜單</a>"));
			} else {
					return view("add-thanks", array("message" => "感謝您的新增，但您的菜單似乎有點問題喔! <a href=".URL::previous()." onclick='history.back()'>更改菜單</a>"));
			}
		}
	}

	public function showFeedback() {
		$data = DB::collection('Info')->lists("name");

		return view("feedback", array("foods" => $data));
	}

	public function recordFeedback() {
		$error = strip_tags(Input::get('error'));
		$name = strip_tags(Input::get('name'));
		if ($error)
			DB::collection("feedback")->insert(array("feedback" => $error, "name" => $name));

		return view("feedback-thanks");
	}
}