<?php

class GameRound extends \Eloquent {
	protected $fillable = [];

    protected $table = 'doodlegames';


    public function game()
    {
        return $this->belongsTo('Game', 'game_id');
    }

    public function receiver()
    {
        return $this->hasOne('User', 'id', 'receiver_id');
    }
}