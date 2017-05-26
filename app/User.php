<?php

namespace App;

//use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Overtrue\LaravelFollow\CanFollow;
use Overtrue\LaravelFollow\CanBeFollowed;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    //use Notifiable;
    use CanFollow, CanBeFollowed;
    use EntrustUserTrait;
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','email','password','firstname',
        'lastname','birthdate','role_id','avatar','banner',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function audio(){
      return $this->hasMany(Audio::class);
    }

    public function audio_published(){
      return $this->hasMany(Audio::class)->where('published', '=', 1);
    }

    public function playlists(){
      return $this->hasMany(Playlist::class);
    }

    public function album(){
      return $this->hasMany(Album::class);
    }

    public function role(){
      return $this->hasOne(Role::class,'role_user');

    }


    public function sluggable()
    {
      return [
        'slug' => [
          'source' => 'username'
        ]
      ];
    }

    public function uploadLimitCheck($durationCurrent) {

      foreach ($this->audio as $audio){
        $totalUploadSeconds[] = $audio->length;
      }
        $totalUploadSeconds[] = $durationCurrent;
        return array_sum($totalUploadSeconds) >= $this->upload_limit;
    }
}
