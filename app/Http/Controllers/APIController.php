<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class APIController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get auth user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user(Request $request)
    {
        return $request->user();
    }

    /**
     * Get users.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function users(Request $request)
    {
        return \App\User::all();
    }

    /**
     * Get histories.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function histories(Request $request)
    {
        return \App\History::all();
    }

    /**
     * Get emotions.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function emotions(Request $request)
    {
        return \App\Emotion::all();
    }

    /**
     * Get messages.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function messages(Request $request)
    {
        return \App\Message::all();
    }

    /**
     * Get messages.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function messagesFetch(Request $request)
    {
        $user = Auth::user();

        $receiver_id = $request->input('receiver_id');
  
        $messages = \App\Message::with('user')
        ->where(function ($q) use($user, $receiver_id) {
          $q->where('user_id', $user->id)
            ->Where('receiver_id', $receiver_id);
        })
        ->orWhere(function ($q) use($user, $receiver_id) {
          $q->where('user_id', $receiver_id)
            ->Where('receiver_id', $user->id);
        })
        ->get();
  
        return $messages;
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function messagesCreate(Request $request)
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