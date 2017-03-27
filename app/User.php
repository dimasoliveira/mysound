<?php

namespace App;

//use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Overtrue\LaravelFollow\FollowTrait;

class User extends Authenticatable
{
    //use Notifiable;

    use FollowTrait;

    protected $primaryKey = 'user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','email','password','firstname',
        'lastname','birthdate','role_id',
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

    public function album(){
      return $this->hasMany(Album::class);
    }

}
