<?php

namespace App\Http\Controllers\Admin;

use App\Audio;
use App\Role;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

  public function index(){

    $users = User::all();

    return view('admin.users.index', compact('users'));
  }

  public function edit($id){

    $user = User::findOrFail($id);
    $roles = Role::all();

    return view('admin.users.edit', compact('user','roles'));
  }

  public function store(Request $request, User $user){

    $this->validate($request, [
      'username' => 'required|max:255|allowed_username|unique:users,username,'.$user->id,
      'firstname' => 'required|max:255',
      'birthdate' => 'nullable|date',
      'lastname' => 'required|max:255',
      'email' => 'required|email|max:255|unique:users,email,'.$user->id,
      'role' => 'required|integer',
    ]);

    $user->update([
      'username' => $request->username,
      'firstname' => $request->firstname,
      'birthdate' => $request->birthdate,
      'lastname' => $request->lastname,
      'email' => $request->email,

    ]);
    $user->detachRoles($user->roles);
    $user->roles()->attach($request->role);

    return redirect()
      ->back()
      ->with('message', 'Updated user succesfully');
  }

  public function destroy($id){

    $user = User::findOrFail($id);

    $allAudio = Audio::where('user_id',$id)->get();

    foreach ($allAudio as $audio){

      if (Storage::exists($audio->filename)){
        Storage::delete($audio->filename);

        if (Storage::exists($audio->filename) == false)
        {
          if (Storage::exists($audio->coverart) && $audio->coverart !== "/defaults/coverart.png"){
            Storage::delete($audio->coverart);
          }

          $audio->delete();
        }

        return redirect()
          ->back()
          ->with('message', 'Bestand succesvol verwijderd');
      }
      return redirect()
        ->back()
        ->with('message', 'Er is iets fout gegaan, probeer het nogmaals');

    }

    // Delete alle bijbehorende muziek en coverarts
    $user->delete();

    return redirect()
      ->route('admin.users')
      ->with('message', $user->username.' deleted succesfully');

  }
}
