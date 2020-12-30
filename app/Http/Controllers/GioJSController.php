<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GioJSController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $histories = \App\History::with('user')->with('emotion')->get();
        $emotions = \App\Emotion::all();
        $countries = DB::table('countries')->orderBy('name')->get();

        return view('giojs')->with('histories', $histories)->with('emotions', $emotions)->with('countries', $countries);
    }
}
