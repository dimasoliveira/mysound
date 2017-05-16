<?php

namespace App\Http\Controllers\Admin;

use App\Audio;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AudioController extends Controller
{
  public function index(){

    $audio = Audio::all();

    return view('admin.audio.index', compact('audio'));
  }

  public function edit(Audio $audio){



    return view('admin.audio.edit', compact('audio'));
  }

  public function store(Request $request, Audio $audio){

    $this->validate($request, [
      'username' => 'required|max:255|unique:users,username,'.$id,
      'firstname' => 'required|max:255',
      'birthdate' => 'nullable|date',
      'lastname' => 'required|max:255',
      'email' => 'required|email|max:255|unique:users,email,'.$id,
    ]);

    $user = User::findOrFail($id);


    $user->update([
      'username' => $request->username,
      'firstname' => $request->firstname,
      'birthdate' => $request->birthdate,
      'lastname' => $request->lastname,
      'email' => $request->email,
    ]);


    return redirect()
      ->back()
      ->with('toast', 'Updated user succesfully');



    // Veranderingen opslaan
  }

  public function destroy(Audio $audio){

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
      ->with('toast', $user->username.' deleted succesfully');

    // User deleten
  }
}
