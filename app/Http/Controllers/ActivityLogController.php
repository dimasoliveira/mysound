<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
   public function index(Request $request){
dd($request);
     activity()->log('Look, I logged somethinggg');

   }
}
