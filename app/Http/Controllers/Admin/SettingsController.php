<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
  public function index(){

    return view('admin.settings.index');
  }

  /**
   * updateUploadLimit
   *
   * Hier veranderd hij de updatelimiet voor alle bestaande users
   * Of voor specifieke users
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function updateUploadLimit(Request $request){

    $this->validate($request, [
      'user' => 'required',
      'uploadlimit' => 'integer|required',
    ]);

    if ($request->user === "all"){
      DB::table('users')->update(['upload_limit' => $request->uploadlimit]);
    }

    $user = User::where('id',$request->user)->first();

     if (!empty($user)){

       $user->upload_limit = $request->uploadlimit;
       $user->save();
      }

    return view('admin.settings.index');
  }

}
