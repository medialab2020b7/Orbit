<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if(is_null($user->city_id)){
            $city = "";
            $country = "";
        }
        else{
            $city = DB::table('cities')->where('id', $user->city_id)->first();
            $state = DB::table('states')->where('id', $city->state_id)->first();
            $country = DB::table('countries')->where('id', $state->country_id)->first();

            $city = $city->name;
            $country = $country->name;
        }

        $histories = $user->histories;
        $connections = $histories->reduce(function ($carry, $item) {
            return $carry + $item->histories->count();
        });

        return view('profile')->with('user', $user)->with('country', $country)->with('city', $city)
                ->with('histories', $histories)->with('connections', $connections);
    }

    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit()
    {
        $user = Auth::user();
        $countries = DB::table('countries')->orderBy('name')->get();
        $cities = collect([]);

        if(is_null($user->city_id)){
            $city_id = null;
            $country_id = null;
        }
        else{
            $city = DB::table('cities')->where('id', $user->city_id)->first();
            $state = DB::table('states')->where('id', $city->state_id)->first();
            $country = DB::table('countries')->where('id', $state->country_id)->first();

            $city_id = $city->id;
            $country_id = $country->id;

            $states = DB::table('states')->where('country_id', $country_id)->orderBy('name')->get();
            $states->each(function ($item, $key) use($cities) {
                $state_cities = DB::table('cities')->where('state_id', $item->id)->orderBy('name')->get();
                $state_cities->each(function ($item2, $key2) use($cities) {
                    $cities->push($item2);
                });
            });
        }

        return view('profile.edit')->with('user', $user)->with('countries', $countries)->with('cities', $cities)->with('country_id', $country_id)->with('city_id', $city_id);
    }
}
