<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class ChatsController extends Controller
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
      $users = \App\User::all();

        return view('chat')->with('users', $users);
    }
}
