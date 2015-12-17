<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Fuel;
use Auth;

class MainController extends Controller
{
    public function index()
    {
        $array = Fuel::where('org_id', Auth::user()->inn)->get();

        return view('main.index', compact('array'));
    }
}
