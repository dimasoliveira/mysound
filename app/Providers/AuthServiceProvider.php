<?php

namespace App\Providers;

use App\Album;
use App\Audio;
use App\Playlist;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('audio_owner', function (User $user,Audio $audio) {

          return $user->id == $audio->user_id;
        });

        Gate::define('album_owner', function (User $user,Album $album) {

          return $user->id == $album->user_id;
        });

        Gate::define('playlist_owner', function (User $user,Playlist $playlist) {

          return $user->id == $playlist->user_id;
        });

        Gate::define('profile_owner', function (User $user,$profile) {

          return $user->id == $profile->user_id;
        });

    }
}
