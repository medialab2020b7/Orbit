<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class History extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'description', 'history_date', 'city_id', 'active', 'emotion_id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['location'];

    /**
     * Get the user who owns the history.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the emotion of history.
     */
    public function emotion()
    {
        return $this->belongsTo(Emotion::class);
    }

    /**
     * The histories connected to this history.
     */
    public function histories()
    {
        return $this->belongsToMany(History::class, "history_history", "history_one", "history_two");
    }

    /**
     * Get full location.
     *
     * @return string
     */
    public function getLocationAttribute()
    {
        if(is_null($this->city_id))
            return null;

        $city = DB::table('cities')->where('id', $this->city_id)->first();
        $state = DB::table('states')->where('id', $city->state_id)->first();
        $country = DB::table('countries')->where('id', $state->country_id)->first();

        return [
            'country' => $country,
            'state' => $state,
            'city' => $city
        ];
    }
}
