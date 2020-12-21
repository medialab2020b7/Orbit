<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'description', 'history_date', 'country', 'city', 'active', 'emotion_id'];

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
}
