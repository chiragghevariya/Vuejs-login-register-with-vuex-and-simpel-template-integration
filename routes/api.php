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

Route::post('register', 'Api\CommonApiController@register');
Route::post('login', 'Api\CommonApiController@login');
Route::post('sociallogin/{provider}', 'Api\CommonApiController@SocialSignup');

Route::group(['middleware'=>'auth:api'],function(){

	Route::post('logout', 'Api\CommonApiController@logout');
	Route::post('refresh', 'Api\CommonApiController@refresh');
	Route::any('me', 'Api\CommonApiController@me');
});
