<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use Illuminate\Support\Facades\DB;

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
        return \App\User::with('histories')->get();
    }

    /**
     * Get histories.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function histories(Request $request)
    {
        $stories = \App\History::with('emotion')->with('user')->with('histories')
        ->whereHas('emotion', function($q) use($request) {
            if($request->has('emotion'))
                $q->where('id', $request->input('emotion'));
        })
        ->get();

        return $stories;
    }

        /**
     * Persist history to database
     *
     * @param  Request $request
     * @return Response
     */
    public function historiesCreate(Request $request)
    {
        $user = Auth::user();

        //1 Get params from request

        //2 Get all histories from desired Emotion
        //Select one or more of that (try to select from other users only)
        
        //3 Create history and persist to database
        $history = $user->histories()->create([
            //put other params
        ]);

        //4 Create connection with selected histories (from 2)

        //Return created history

        return $history;
    }

    /**
     * Get emotions.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function emotions(Request $request)
    {
        return \App\Emotion::with('histories')->get();
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

    public  function  userEmotionHistoriesFetch(Request $request)
    {
        $storyId = $request->id;

        $story = \App\History::with('user')->with('emotion')->get();

        return $story[$storyId-1];
    }

    // public  function  historiesByCountryFetch(Request $request)
    // {
    //     $countryCode = $request->country_code;
    //     $countries = DB::table('countries')->where('code', $countryCode)->first();

    //     $stories = \App\History::where('country', $countries->name)->with('emotion')->with('user')->get();

    //     return $stories;
    // }

    // public function historiesByEmotionFetch(Request $request)
    // {
    //     $emotionId = $request->emotion_id;
    //     $stories = \App\History::where('emotion_id', $emotionId)->with('emotion')->with('user')->get();

    //     return $stories;
    // }

    /**
     * Get cities.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cities(Request $request)
    {
        $country_code = $request->country;
        $countries = DB::table('countries')->where('code', $country_code)->first();

        $states = DB::table('states')->where('country_id', $countries->id)->orderBy('name')->get();
        $cities = collect([]);

        $states->each(function ($item, $key) use($cities) {
            $state_cities = DB::table('cities')->where('state_id', $item->id)->orderBy('name')->get();
            $state_cities->each(function ($item2, $key2) use($cities) {
                $cities->push($item2);
            });
        });

        return $cities;
    }

            /**
     * Update profile
     *
     * @param  Request $request
     * @return Response
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $name = $request->input('name');
        $city_id = $request->input('city_id');
        $description = $request->input('description');

        $user->name = $name;
        $user->city_id = $city_id;
        $user->description = $description;

        // Handle the user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            \Image::make($avatar)->resize(300, 300)->save( public_path('/img/avatar/' . $filename ) );

            $user->avatar = $filename;
        }

        $user->save();

        return ['user' => $user->toArray()];
    }
}
