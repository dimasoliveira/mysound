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

Route::get('/admin', function () {return view('admin.index'); });
Route::get('/admin/users','Admin\UsersController@index')->name('admin.users');

//
//Auth::routes();
//
//
////Route::get('/admin','HomeController@index');
//
//Route::get('protected', ['middleware' => ['auth', 'admin'], function() {
//  return "this page requires that you be logged in and an Admin";
//}]);