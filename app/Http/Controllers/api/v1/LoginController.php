<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{

	public function auth(Request $request)
	{
		// return response(['message' => 'Hello Auth Function']);


		// if (Cookie::get('loginAuth') != $authToken['token']) {
		// 	return response(['message' => 'Unauthorised action', 'status' => 404]);
		// }
		return response()->json(['user' => Auth::user() ]);
		// return response([
		// 	'user' => Auth::user(),
		// 	'accessToken' => $authToken['token'],
		// ]);
	}
}
