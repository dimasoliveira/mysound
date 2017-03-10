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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home','HomeController@index');
Route::get('/profile','ProfileController@index')->name('profile.show');
Route::get('/timeline','TimelineController@index')->name('timeline.show');
Route::get('/audio/','AudioController@index')->name('audio.index');
Route::post('/audio/add','AudioController@add')->name('audio.add');
