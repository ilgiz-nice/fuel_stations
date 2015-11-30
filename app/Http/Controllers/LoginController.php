<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Org;

class LoginController extends Controller
{
    public function auth(Request $request)
    {
        if (Org::where('inn', $request->inn)->where('password', bcrypt($request->password)))
        {

        }
    }
}
