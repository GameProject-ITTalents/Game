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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

//Social Login
Route::get('social/{provider?}', 'SocialController@getSocialAuth');
Route::get('social/callback/{provider?}', 'SocialController@getSocialAuthCallback');

Route::auth();

Route::get('/user/{id}','UserController@user');
Route::get('/user/profile/{id}','UserController@profile');
Route::post('/createUser', 'UserController@createUser');
Route::get('/user/delete/{id}', 'UserController@deleteUser');
Route::get('/user/makeAdmin/{id}', 'UserController@makeAdmin');

Route::get('/allUsers', 'DevController@allUsers');
Route::post('/showUserData', 'DevController@showUserData');

Route::post('/user/updateProfile','UserController@updateProfile');
Route::post('/user/updatePassword','UserController@updatePassword');
Route::post('/user/updateInfo','UserController@updateInfo');

Route::get('admin/panel', 'AdminController@admin');
Route::get('/admin/transactions', 'AdminController@transactions');

Route::get('/viewAllUsers/{sortingMethod}', 'AdminController@viewAllUsers');
Route::get('admin/addUser', 'AdminController@addUser');

//ESHOP
Route::get('/shop', 'ShopController@show');
Route::get('/buyCoins', 'ShopController@buyCoins');
Route::get('/editProduct/{id}', 'ShopController@editObject');
Route::post('/updateProduct/{id}', 'ShopController@updateObject');
Route::get('/deleteProduct/{id}', 'ShopController@destroyObject');

Route::get('/newObject', 'ShopController@newObject');
Route::post('/saveObject', 'ShopController@addObject');

Route::get('/newBundle', 'ShopController@newBundle');
Route::post('/saveBundle', 'ShopController@addBundle');
Route::get('/editBundle/{id}', 'ShopController@editBundle');
Route::post('/updateBundle/{id}', 'ShopController@updateBundle');
Route::get('/deleteBundle/{id}', 'ShopController@destroyBundle');

//CART
Route::get('/addProduct/{productId}', 'CartController@addItem');
Route::get('/removeItem/{productId}', 'CartController@removeItem');
Route::get('/cart', 'CartController@showCart');

Route::resource('total.items', 'UserController');

//FORUM
Route::resource('/forum', 'PostsController');


//ABOUT
Route::get('/about', 'HomeController@about');

//GAME
Route::get('/startGame', 'HomeController@startGame');
Route::get('/userInfo', 'HomeController@userInfo');

Route::get('/highScore', 'HomeController@highScore');

//DEV
Route::resource('/dev', 'DevController');
Route::post('/userRequest', 'DevController@userRequest');


