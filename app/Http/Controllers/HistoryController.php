<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $histories = \App\History::all();

        return view('history')->with('histories', $histories);
    }
}
