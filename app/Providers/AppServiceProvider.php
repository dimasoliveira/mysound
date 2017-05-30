<?php

namespace App\Providers;
use App\Genre;
use App\Playlist;
use App\Validation\AllowedUsernameValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
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
      /**
       * Makes the genre variable available on all views.
       */

      view()->share('genres', Genre::all());

      /**
       * Loads an custom validator in that checks if the name is a routename,
       * directory or on our reserved list.
       */

      Validator::extend('allowed_username','App\Validation\AllowedUsernameValidator@validate');
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
