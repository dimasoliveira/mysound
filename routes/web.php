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
Route::get('/myaudio/','AudioController@index')->name('audio.index');
Route::get('/myaudio/add','AudioController@addForm')->name('audio.add');
Route::post('/myaudio/add','AudioController@add')->name('audio.add');
Route::get('/myaudio/albums','AudioController@getAlbums')->name('audio.albums');

