<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

//Social Login
Route::get('social/{provider?}', 'SocialController@getSocialAuth');
Route::get('social/callback/{provider?}', 'SocialController@getSocialAuthCallback');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/user/{id}','UserController@user');
Route::get('/user/profile/{id}','UserController@profile');

Route::post('/user/updateProfile','UserController@updateProfile');
Route::post('/user/updatePassword','UserController@updatePassword');
Route::post('/user/updateInfo','UserController@updateInfo');

//Route::match(['get', 'post'], 'admin/createAdmin', 'AdminController@createAdmin');
Route::get('admin', 'AdminController@admin');
