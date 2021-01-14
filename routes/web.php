<?php

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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/search', 'ShopsController@search')->name('search');
Route::get('/search/{id}', 'ShopsController@show')->name('show');

Route::group(['middleware' => 'auth'], function(){
  Route::get('/user/mypage', 'UsersController@mypage')->name('mypage');
  Route::get('/shop/favorite/{id}', 'FavoritesController@favorite')->name('shop.favorite');
  Route::get('/shop/unfavorite/{id}', 'FavoritesController@unfavorite')->name('shop.unfavorite');
  Route::get('/user/updatename', 'UsersController@updateUserNameShow')->name('updateUserNameShow');
  Route::post('/user/updatename', 'UsersController@updateUserName')->name('updateUserName');
  Route::get('/user/updatemailaddress', 'UsersController@updateMailAddressShow')->name('updateMailAddressShow');
  Route::post('/user/updatemailaddress', 'UsersController@updateMailAddress')->name('updateMailAddress');
  Route::get('/user/updatepassword', 'UsersController@updatePasswordShow')->name('updatePasswordShow');
  Route::post('/user/updatepassword', 'UsersController@updatePassword')->name('updatePassword');
});