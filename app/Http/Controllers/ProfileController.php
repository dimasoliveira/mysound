<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Overtrue\LaravelFollow\Models\Follower;
use Overtrue\LaravelFollow\FollowTrait;

class ProfileController extends Controller
{
    public function index(){

      $user = User::findOrfail(1);


//      $user = User::findOrfail(1);
//      $user->follow(3);
//      $user->follow(4);
//      $user->follow(5);
//      dd($user->followers);

      return view('profile',compact('user'));
    }
}
