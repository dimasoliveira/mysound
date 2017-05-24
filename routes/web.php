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

Route::get('/', function (){
  if (Auth::user()){
    return redirect(route('timeline.show'));
  }
    return view('welcome'); })
  ->name('index');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

Route::group(['middleware' => ['role:admin|superadmin']], function () {

      Route::get('/admin',function () {return view('admin.index');})->name('admin.index');
      Route::get('/admin/users','Admin\UsersController@index')->name('admin.users');
      Route::get('/admin/roles','Admin\RoleController@index')->name('admin.roles');
      Route::get('/admin/audio','Admin\AudioController@index')->name('admin.audio');
      Route::get('/admin/comments','Admin\CommentController@index')->name('admin.comments');
      Route::get('/admin/settings','Admin\SettingsController@index')->name('admin.settings');


      Route::post('/admin/settings','Admin\SettingsController@updateUploadLimit')->name('admin.uploadlimit.update')->middleware('permission:uploadlimit-edit');


      Route::group(['middleware' => ['permission:user-edit']], function () {
          Route::get('/admin/users/{user}','Admin\UsersController@edit')->name('admin.users.edit');
          Route::post('/admin/users/{user}','Admin\UsersController@store')->name('admin.users.store');
          Route::delete('/admin/users/{user}','Admin\UsersController@destroy')->name('admin.users.destroy'); });

      Route::group(['middleware' => ['permission:role-create']], function () {
          Route::get('/admin/role/add','Admin\RoleController@create')->name('admin.role.create');
          Route::post('/admin/role/add','Admin\RoleController@store')->name('admin.role.store'); });

      Route::group(['middleware' => ['permission:role-edit']], function () {
          Route::get('/admin/role/{role}/edit','Admin\RoleController@edit')->name('admin.role.edit');
          Route::post('/admin/role/{role}/edit','Admin\RoleController@update')->name('admin.role.update'); });

      Route::delete('/admin/role/{role}/destroy','Admin\RoleController@destroy')->name('admin.role.destroy')->middleware('permission:role-delete');

      Route::group(['middleware' => ['permission:audio-edit']], function () {
          Route::get('/admin/audio/{audio}','Admin\AudioController@edit')->name('admin.audio.edit');
          Route::post('/admin/audio/{audio}','Admin\AudioController@update')->name('admin.audio.update');
          Route::delete('/admin/admin/{audio}','Admin\AudioController@destroy')->name('admin.audio.destroy'); });
      });

  Route::get('/search','SearchController@index');
  Route::post('/search','SearchController@searchRequest')->name('search.request');
  Route::get('/timeline','TimelineController@index')->name('timeline.show');

  Route::post('like/{audio}','LikeController@create')->name('like.create');

  Route::post('/playlist/{playlist}/{audio}','PlaylistController@addToPlaylist')->name('playlist.request');
  Route::delete('/playlist/{id}','PlaylistController@removeFromPlaylist')->name('playlist.remove');

  Route::get('/myaudio/','AudioController@index')->name('myaudio.index');

  Route::group(['middleware' => ['permission:audio-upload']], function () {
      Route::get('/add','AudioController@create')->name('myaudio.create');
      Route::post('/add','AudioController@store')->name('myaudio.store');
  });

  Route::group(['middleware' => ['can:owner,audio']], function () {
      Route::get('/myaudio/edit/{audio}','AudioController@edit')->name('myaudio.edit');
      Route::post('/myaudio/edit/{audio}','AudioController@update')->name('myaudio.update');
      Route::delete('/myaudio/destroy/{audio}','AudioController@destroy')->name('myaudio.destroy');
  });

  Route::get('/albums','AlbumController@index')->name('myaudio.albums');

  Route::group(['middleware' => ['can:owner,album']], function () {
      Route::get('/myaudio/album/{album}','AlbumController@show')->name('myaudio.album.show');
      Route::post('/myaudio/album/{album}/edit','AlbumController@update')->name('myaudio.album.update');
    // A L B U M  D E L E T E
  });

  Route::post('/playlist/add','PlaylistController@store')->name('playlist.store');
  Route::get('/playlists','PlaylistController@index')->name('playlist.index');

  Route::group(['middleware' => ['can:owner,playlist']], function () {
    Route::get('/playlist/{playlist}','PlaylistController@show')->name('playlist.show');
    Route::post('/playlist/{playlist}','PlaylistController@update')->name('playlist.update');
  });


  Route::get('/profile', function () {return redirect()->intended(route('profile.show',Auth::user()->slug));})->name('profile');

  Route::get('/{slug}','ProfileController@index')->name('profile.show');
  Route::post('/profile/avatar/{user}','ProfileController@avatarUpdate')->name('avatar.update')->middleware('can:owner,user');
  Route::post('/profile/name/{user}','ProfileController@nameUpdate')->name('name.update')->middleware('can:owner,user');
  Route::post('profile/{slug}/follow','ProfileController@followRequest')->name('follow.request');

  Route::get('/{slug}/audio/{audio}','TimelineController@show')->name('audio.show');
  Route::post('/audio/{audio}','CommentController@store')->name('comment.store');
  Route::delete('/comment/{comment}','CommentController@destroy')->name('comment.destroy');


});
