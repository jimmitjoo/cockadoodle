<?php

class GameRound extends \Eloquent {
	protected $fillable = [];

    protected $table = 'doodlegames';


    public function receiver()
    {
        return $this->hasOne('User', 'receiver_id');
    }
}