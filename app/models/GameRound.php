<?php

class GameRound extends \Eloquent {
	protected $fillable = [];

    protected $table = 'doodlegames';


    public function receiver()
    {
        return $this->belongsTo('User', 'receiver_id');
    }

}