<?php
namespace App\Http\Controllers;
use DB;
use App\User;
use App\Http\Controllers\Controller;
use Input;
use URL;
use Session;

class AdminController extends Controller
{
	public function index($domain) {
		if ($domain == "beta") {
			$names = DB::collection("Info")->lists("name");

				return view("admin", array(
					"foodName" => $names,
					"ng_app" => "admin",
					"title" => "管理介面 - 中大美食"
					)
				);
		} else {
			if (Session::get('facebookId') == '867794553236067') {

				$names = DB::collection("Info")->lists("name");

				return view("admin", array(
					"foodName" => $names,
					"ng_app" => "admin",
					"title" => "管理介面 - 中大美食"
					)
				);
			}else
				return view("errors/404");
		}
	}

	public function saveData() {
		$data = Input::get("foodData");
		$data = json_decode($data,true);
		$id = $data["_id"]["\$id"];
		unset($data["_id"]);
		DB::collection("Info")->where("_id", $id)->update($data);
		return "success";
	}
}