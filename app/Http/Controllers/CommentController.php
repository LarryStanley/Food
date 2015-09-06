<?php
namespace App\Http\Controllers;
use DB;
use App\User;
use App\Http\Controllers\Controller;
use Input;
use URL;
use Session;

class CommentController extends Controller
{
	public function facebookLogin() {
	    $code = Input::get( 'code' );
	    $fb = \OAuth::consumer( 'Facebook');
	    if ( !empty( $code ) ) {
	        $token = $fb->requestAccessToken( $code );
	        $result = json_decode( $fb->request( '/me?fields=id,link,name&locale=zh_TW' ), true );

	        $userData = DB::collection("users")->where("id", $result['id'])->first();
	        if (!$userData) {
	        	DB::collection("users")->insert($result);
		        $userData = DB::collection("users")->where("id", $result['id'])->first();
	        }
			
			Session::put('facebookId', $result['id']);

			$previousURL = Session::get("previousURL");

			return redirect($previousURL[0]);

	    } else {
	    	$previousURL = URL::previous();
	    	Session::push("previousURL", $previousURL);
	    	echo $previousURL;
	        $url = $fb->getAuthorizationUri();
			return redirect( (string)$url );
	    }
 	}

 	public function addComment() {
 		if (Session::get('facebookId')) {
 			$comment = strip_tags(Input::get('comment'));
 			$userData = DB::collection("users")->where("id", Session::get('facebookId'))->first();
 			$foodData = DB::collection("Info")->where("name", Input::get('food_name'))->first();

 			if ($foodData && $comment) {
  				$result = array("user" => $userData, "comment" => $comment);
 				DB::collection("Info")->where("name", Input::get('food_name'))->push('comments', $result);

 				$result = array("message" => "success", "user" => $userData, "comment" => $comment);

		 		return response()->json($result);
 			}else
 				return response()->json(["message" => "error"]);
 		} else {
 			echo "please login with facebook.";
 		}
 	}

 	public function addLike() {
 		if (Session::get('facebookId')) {
 			$userData = DB::collection("users")->where("id", Session::get('facebookId'))->first();
 			$foodData = DB::collection("Info")->where("name", Input::get('food_name'))->first();

 			if (empty($foodData['likes'])) {
 				DB::collection("Info")->where("name", Input::get('food_name'))->push("likes", ["like_count" => 0, "dislike_count" => 0, "like_peolple" => [], "dilike_people" => []]);
 				$foodData = DB::collection("Info")->where("name", Input::get('food_name'))->first();
 			}

 			if ($foodData) {
 				$likeData = $foodData['likes'];

 				if (empty($likeData)) {

 				}


 				if (Input::get('type') == 'dislike') {
 				} else {

 				}

 			} else
 				return response()->json(["message" => "error"]);
 		} else {
 			echo "please login with facebook";
 		}
 	}
}