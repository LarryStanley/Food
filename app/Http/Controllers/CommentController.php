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
 			$foodData = DB::collection("Info")->where("name", Input::get("food_name"))->first();
			unset($foodData['_id']);

 			if (empty($foodData['likes'])) {
 				$foodData['likes'] = array("like_count" => 0, "dislike_count" => 0, "like_people" => array(), "dislike_people" => array());
 			}

 			if ($foodData) {
 				$likeData = $foodData['likes'];
 				if (Input::get('type') == 'dislike') {
 					// check cancel dislike
 					$cancel = false;
 					foreach ($likeData['dislike_people'] as $key => $value) {
 						if ($value['id'] == Session::get('facebookId')) {
 							$likeData['dislike_count'] -= 1;
 							unset($likeData['dislike_people'][$key]);
 							$cancel = true;
 							break;
 						}
 					}

 					if (!$cancel) {
	 					$likeData['dislike_count'] += 1;
	 					array_push($likeData['dislike_people'], $userData);
	 					// check like this food
	 					foreach ($likeData['like_people'] as $key => $value) {
	 						if ($value['id'] == Session::get('facebookId')) {
	 							unset($likeData['like_people'][$key]);
	 							$likeData['like_count'] -= 1;
	 							break;
	 						}
	 					}
	 				}
 				} else {
 					// check cancel like
 					$cancel = false;
 					foreach ($likeData['like_people'] as $key => $value) {
 						if ($value['id'] == Session::get('facebookId')) {
 							$likeData['like_count'] -= 1;
 							unset($likeData['like_people'][$key]);
 							$cancel = true;
 							break;
 						}
 					}

 					if (!$cancel) {
	 					$likeData['like_count'] += 1;
	 					array_push($likeData['like_people'], $userData);
	 					// check like this food
	 					foreach ($likeData['dislike_people'] as $key => $value) {
	 						if ($value['id'] == Session::get('facebookId')) {
	 							unset($likeData['dislike_people'][$key]);
	 							$likeData['dislike_count'] -= 1;
	 							break;
	 						}
	 					}
	 				}
 				}

 				$foodData['likes'] = $likeData;

 				DB::collection("Info")->where("name", Input::get("food_name"))->update($foodData);

 				return ["status" => "success"];
 			} else
 				return response()->json(["message" => "error"]);
 		} else {
 			echo "please login with facebook";
 		}
 	}
}