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

Route::group(['middleware' => ['role:admin|superadmin']], function () {

  Route::get('/admin', function () {return view('admin.index'); });
  Route::get('/admin/users','Admin\UsersController@index')->name('admin.users');
  Route::get('/admin/roles','Admin\RoleController@index')->name('admin.roles');

  Route::group(['middleware' => ['permission:user-edit']], function () {
    Route::get('/admin/users/{id}','Admin\UsersController@edit')->name('admin.users.edit');
    Route::post('/admin/users/{id}','Admin\UsersController@store')->name('admin.users.store');
    Route::delete('/admin/users/{id}','Admin\UsersController@destroy')->name('admin.users.destroy');
  });

  Route::group(['middleware' => ['permission:role-create']], function () {
    Route::get('/admin/role/add','Admin\RoleController@create')->name('admin.role.create');
    Route::post('/admin/role/add','Admin\RoleController@store')->name('admin.role.store');
  });

  Route::group(['middleware' => ['permission:role-edit']], function () {
    Route::get('/admin/role/{role}/edit','Admin\RoleController@edit')->name('admin.role.edit');
    Route::post('/admin/role/{role}/edit','Admin\RoleController@update')->name('admin.role.update');
  });

  Route::group(['middleware' => ['permission:role-delete']], function () {
    Route::delete('/admin/role/{role}/destroy','Admin\RoleController@destroy')->name('admin.role.destroy');
  });

});

Route::group(['middleware' => ['auth']], function () {
  Route::get('/search','SearchController@index');
  Route::post('/search','SearchController@searchRequest')->name('search.request');
  Route::get('/timeline','TimelineController@index')->name('timeline.show');
  Route::get('/profile/{slug}','ProfileController@index')->name('profile.show');
  Route::post('/profile/{slug}','ProfileController@follow_request')->name('follow.request');


  Route::post('/playlistrequest','PlaylistController@addToPlaylist')->name('playlist.request');

  Route::get('/myaudio/','AudioController@index')->name('myaudio.index');

  Route::group(['middleware' => ['permission:audio-upload']], function () {
    Route::get('/myaudio/add','AudioController@create')->name('myaudio.create');
    Route::post('/myaudio/add','AudioController@store')->name('myaudio.store');
  });

  Route::group(['middleware' => ['permission:audio-edit']], function () {

    //Route::resource('id','AudioController',['except' => ['edit']]);
    Route::get('/myaudio/edit/{audio}','AudioController@edit')->name('myaudio.edit');
    Route::post('/myaudio/edit/{audio}','AudioController@update')->name('myaudio.update');
    Route::post('/myaudio/albums/{slug}/edit','AlbumController@update')->name('myaudio.album.update');

  });

  //Route::get('/myaudio/albums/{slug}/edit','AlbumController@edit')->name('myaudio.album.edit');//->middleware('can:update-audio,audio')



  Route::group(['middleware' => ['permission:audio-delete']], function () {
    Route::delete('/myaudio/destroy/{id}','AudioController@destroy')->name('myaudio.destroy');
  });

  Route::get('/myaudio/albums','AlbumController@getAll')->name('myaudio.albums');
  Route::get('/myaudio/album/{slug}','AlbumController@getAlbum')->name('myaudio.album.show');

  Route::get('/myaudio/playlists','PlaylistController@index')->name('myaudio.playlist.index');
  Route::get('/myaudio/playlist/{id}','PlaylistController@show')->name('myaudio.playlist.show');
});
//Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {
//  Route::get('/', 'AdminController@welcome');
//  Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
//});