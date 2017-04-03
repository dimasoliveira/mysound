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
Route::get('/profile/{slug}','ProfileController@index')->name('profile.show');
Route::post('/profile/{slug}', 'ProfileController@follow_request')->name('follow.request');
Route::get('/timeline','TimelineController@index')->name('timeline.show');
Route::get('/myaudio/','AudioController@index')->name('myaudio.index');
Route::get('/myaudio/add','AudioController@addForm')->name('myaudio.add');
Route::post('/myaudio/add','AudioController@add')->name('myaudio.add');
Route::get('/myaudio/albums','AlbumController@getAll')->name('myaudio.albums');
Route::get('/myaudio/albums/{slug}','AlbumController@getAlbum')->name('myaudio.album.show');


