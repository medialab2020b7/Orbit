<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'city_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['location'];

    /**
     * A user can have many messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * A user can have many messages (receiver)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receivers()
    {
        return $this->hasMany(Message::class, "receiver_id");
    }

    /**
     * Get the histories of user.
     */
    public function histories()
    {
        return $this->hasMany(History::class);
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
