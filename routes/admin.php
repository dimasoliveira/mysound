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



//
//
//Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {
//  Route::get('/admin', 'AdminController@index');
//  Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'Admin\UsersController@index']);
//});

//
//Auth::routes();
//
//
////Route::get('/admin','HomeController@index');
//
//Route::get('protected', ['middleware' => ['auth', 'admin'], function() {
//  return "this page requires that you be logged in and an Admin";
//}]);