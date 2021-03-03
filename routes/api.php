<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Login User API Route, returns access token and user model.
Route::prefix('/user')->group(function() {
    Route::get('/auth', 'api\v1\LoginController@auth')->middleware('auth:api');
    // Route::post('/login', 'api\v1\LoginController@login');
});

