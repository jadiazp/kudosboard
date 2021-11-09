<?php

namespace App\Http\Controllers;

use App\Events\KudosAddedEvent;
use Illuminate\Http\Request;

class TestController extends Controller
{
  public function message(Request $request)
  {
    //event(new KudosAddedEvent($request->input('message')));
    event(new KudosAddedEvent("PRUEBA"));

    return [];
  }
}
