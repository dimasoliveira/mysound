<?php

namespace App\Http\Controllers;

use App\Audio;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Overtrue\LaravelFollow\Models\Follower;
use Overtrue\LaravelFollow\FollowTrait;

class ProfileController extends Controller
{

    public function index($slug){

      if (User::where('slug', $slug)->exists()){

        if ($slug == Auth::user()->slug)
        {
          $user = Auth::user();

          $posts = Audio::where('user_id',Auth::user()->id)->where('published',1)->get();

          return view('profile',compact('user','posts'));
        }
        else{
          $user = User::where('slug', $slug)->first();

          $posts = Audio::where('user_id',$user->id)->where('published',1)->get();

          return view('profile',compact('user','posts'));
        }

      }

      return redirect(route('timeline.show'))->with('message', 'Unfortunately, user '.$slug.' cannot be found');

    }

    public function followRequest($slug){


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

    public function avatarUpdate(Request $request, User $user){

      //dd($request);

      $this->validate($request, [
        'avatar' => 'nullable|image|file',
      ]);



     //$user->update(['avatar' => $request->avatar]);

          if (Storage::exists($user->avatar)) {
            Storage::delete($user->avatar);
          }

          $user->update([
            'avatar' => $request->avatar = request()
              ->file('avatar')
              ->store('public/avatars')
          ]);

        return redirect()->intended(route('profile'));

    }

}
