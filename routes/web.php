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

Route::get('/search','SearchController@index');
Route::post('/search','SearchController@searchRequest')->name('search.request');
Route::get('/timeline','TimelineController@index')->name('timeline.show');
Route::get('/profile/{slug}','ProfileController@index')->name('profile.show');
Route::post('/profile/{slug}','ProfileController@follow_request')->name('follow.request');

Route::get('/myaudio/','AudioController@index')->name('myaudio.index');
Route::get('/myaudio/add','AudioController@create')->name('myaudio.create');
Route::post('/myaudio/add','AudioController@store')->name('myaudio.store');
Route::get('/myaudio/edit/{id}','AudioController@edit')->name('myaudio.edit');//->middleware('can:update-audio,audio')
Route::post('/myaudio/edit/{id}','AudioController@update')->name('myaudio.update');

//Route::get('/myaudio/albums/{slug}/edit','AlbumController@edit')->name('myaudio.album.edit');//->middleware('can:update-audio,audio')
Route::post('/myaudio/albums/{slug}/edit','AlbumController@update')->name('myaudio.album.update');

Route::delete('/myaudio/destroy/{id}','AudioController@destroy')->name('myaudio.destroy');

Route::get('/myaudio/albums','AlbumController@getAll')->name('myaudio.albums');
Route::get('/myaudio/albums/{slug}','AlbumController@getAlbum')->name('myaudio.album.show');
