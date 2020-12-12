<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

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

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages(Request $request)
    {
      $user = Auth::user();

      $receiver_id = $request->input('receiver_id');

      $messages = Message::with('user')
      ->where(function ($q) use($user, $receiver_id) {
        $q->where('user_id', $user->id)
          ->Where('receiver_id', $receiver_id);
      })
      ->orWhere(function ($q) use($user, $receiver_id) {
        $q->where('user_id', $receiver_id)
          ->Where('receiver_id', $user->id);
      })
      ->get();

      dd($messages);

      return $messages;
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $receiver_id = $request->input('receiver_id');

        $message = $user->messages()->create([
          'message' => $request->input('message'),
          'receiver_id' => $receiver_id
        ]);
      
        broadcast(new MessageSent($user, $message))->toOthers();
      
        return ['message' => $message, 'user' => $message->user, 'receiver' => $message->receiver];
    }
}
