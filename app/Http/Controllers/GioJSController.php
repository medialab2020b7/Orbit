<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $histories = \App\History::all();
        $users = \App\User::all();
        $emotions = \App\Emotion::all();

        return view('giojs')->with('histories', $histories)->with('users', $users)->with('emotions', $emotions);
    }
}
