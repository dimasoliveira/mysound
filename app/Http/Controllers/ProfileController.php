<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Overtrue\LaravelFollow\Models\Follower;
use Overtrue\LaravelFollow\FollowTrait;

class ProfileController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index($slug){

      if ($slug == Auth::user()->slug)
      {
        $user = Auth::user();

        return view('profile',compact('user'));
      }
      elseif ($slug !== Auth::user()->slug){
        $user = User::where('slug', $slug)->first();

        return view('profile',compact('user'));
      }
      else{

        //Return not found
      }
      return view('profile',compact('user'));
    }

  public function follow_request($slug){


    $user_id = User::where('slug', $slug)->value('id');

    if ($user_id !== Auth::user()->id){

      if (Auth::user()->isFollowing($user_id))
      {
        Auth::user()->unfollow($user_id);
      }
      else{
        Auth::user()->follow($user_id);
      }
    }
    return redirect()->intended(route('profile.show',$slug));
  }

}
