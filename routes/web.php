<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('welcome', 'HomeController@welcome');

// FRONT END VUE JS DEVELOPMENT
 
Route::get('auth/{provider}/callback', 'HomeController@callBackGithub');

Route::get('dashboard/{any?}', 'HomeController@dashboard')->where('any','[\/\w\.-]*');
Route::get('/{any?}', 'HomeController@index')->where('any','[\/\w\.-]*');

// FRONT END VUE JS DEVELOPMENT

