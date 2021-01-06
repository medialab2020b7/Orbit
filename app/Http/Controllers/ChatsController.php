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
      $user = \Auth::user();

      $users = collect([]);

      $histories = $user->histories;

      // Only add users with connected histories
      $histories->each(function ($item, $key) use($user, $users) {
        $histories_histories = $item->histories;
        
        $histories_histories->each(function ($item2, $key2) use($user, $users) {
          if($item2->user != $user)
            $users->push($item2->user);
          else if($item2->receiver != $user)
            $users->push($item2->receiver);
        });
      });

      return view('chat')->with('users', $users->unique());
    }
}
