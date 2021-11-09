<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
  public function index()
  {
    $results = DB::select("SELECT
    id,
    concat(firstname, ' ', lastname) as name
    FROM kudosboard.users
    order by firstname asc");
    return response()->json($results);
  }

}
