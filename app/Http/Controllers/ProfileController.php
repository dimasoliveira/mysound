<?php

namespace App\Http\Controllers;

use App\Audio;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
  /**
   * @param $slug
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
   *
   * Onderstaande functie checkt of de opgevraagde user bestaat, en of de user
   * op zijn eigen pagina is of op die van een ander
   */
    public function index($slug){

      if (User::where('slug', $slug)->exists()){

        if ($slug == Auth::user()->slug)
        {
          $user = Auth::user();
          $audios = Audio::orderBy('created_at', 'desc')->where('user_id',Auth::user()->id)->where('published',1)->get();

          return view('profile',compact('user','audios'));
        }
        else{

          $user = User::where('slug', $slug)->first();
          $audios = Audio::where('user_id',$user->id)->where('published',1)->get();

          return view('profile',compact('user','audios'));
        }
      }
      return redirect(route('timeline.show'))->with('message', 'Unfortunately, user '.$slug.' cannot be found');
    }

  /**
   * @param $slug
   *
   * @return \Illuminate\Http\RedirectResponse
   *
   * Onderstaande functie wordt uitgevoerd wanneer iemand op de followbutton klikt
   * Er wordt eerst voor ze zekerheid gechecked of de user zichzelf niet probeerd
   * te volgen
   * Daarna wordt er gecheckt of de user degene al volgt, zoniet dan volgt die degene
   * Als die hem al wel volgt, wordt die onvolgt
   */
    public function followRequest($slug){

      $user = User::where('slug', $slug)->value('id');

      if ($user !== Auth::user()->id){

        Auth::user()->isFollowing($user) ?  Auth::user()->unfollow($user) : Auth::user()->follow($user);
      }
      return redirect()->intended(route('profile.show',$slug));
    }

  /**
   * @param \Illuminate\Http\Request $request
   * @param \App\User $user
   *
   * @return \Illuminate\Http\RedirectResponse
   *
   * avatarUpdate wordt aangeroepen wanneer iemand een nieuwe avatar wilt uploaden
   * Er wordt gechecked of de oude avatar bestaat, zoja, dan wordt die verwijderd
   */
    public function avatarUpdate(Request $request, User $user) {

      $this->validate($request, [
        'avatar' => 'nullable|image|file|dimensions:ratio=1/1',
      ]);

      Storage::exists($user->avatar) ? Storage::delete($user->avatar) : false;

          $user->update([
            'avatar' => $request->avatar = request()
              ->file('avatar')
              ->store('public/avatars')
          ]);

      return redirect()->intended(route('profile'));
    }

  /**
   * @param \Illuminate\Http\Request $request
   * @param \App\User $user
   *
   * @return \Illuminate\Http\RedirectResponse
   *
   * nameUpdate wordt aangeroepen wanneer iemand zijn gebruikersnaam, voornaam
   * of achternaam wilt wijzigen
   */
    public function nameUpdate(Request $request, User $user){

      $this->validate($request, [
        'firstname' => 'required|max:255',
        'lastname' => 'required|max:255',
      ]);

      $user->update([
         'firstname' => $request->firstname,
         'lastname' => $request->lastname,
      ]);

      return redirect()->intended(route('profile'));
    }
}
