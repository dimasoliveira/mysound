<?php

namespace App\Http\Controllers;

use App\Audio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
  /**
   * Logger
   *
   * This code will be executed whenever a user clicks on a play button in
   * an audiocard
   *
   * @param \Illuminate\Http\Request $request
   */

   public function logUserActivity(Request $request){

    activity()
       ->causedBy(Auth::user()->id)
       ->withProperties(Audio::findOrFail($request->id))
       ->log('audio_log');
   }
}
