<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emotion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'sound'];

    /**
     * Get the histories of emotion.
     */
    public function histories()
    {
        return $this->hasMany(History::class);
    }
}
