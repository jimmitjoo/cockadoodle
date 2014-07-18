<?php

class GameRound extends \Eloquent {
	protected $fillable = [];

    protected $table = 'doodlegames';


    public function receiver()
    {
        return $this->belongsTo('User', 'receiver_id');
    }

    public function drawer()
    {
        return $this->belongsTo('User', 'drawer_id');
    }

    public function doodle()
    {
        return $this->belongsTo('Doodle');
    }

}