<?php

namespace App\Providers;
use App\Genre;
use App\Playlist;
use App\Validation\AllowedUsernameValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      view()->share('genres', Genre::all());

      Validator::extend(
        'allowed_username',
        'App\Validation\AllowedUsernameValidator@validate'
      );


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
