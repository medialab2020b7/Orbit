<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
