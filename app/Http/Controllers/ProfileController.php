<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Overtrue\LaravelFollow\Models\Follower;
use Overtrue\LaravelFollow\FollowTrait;

class ProfileController extends Controller
{
    public function index(){

      $user = User::$manyMethods;
      dd($user);
      $user->followers();

      return view('profile');
    }
}
