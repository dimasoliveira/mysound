<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'firstname', 'lastname', 'birthdate', 'user_id',
  ];

  public function user(){
    return $this->belongsTo(User::class);
  }
}
