<?php

class Game extends \Eloquent {

    // DB fields that is fillable
    protected $fillable = [
        'first_player_id',
        'second_player_id'
    ];

    protected $table = 'games';

    public function first_player()
    {
        return $this->belongsTo('User', 'first_player_id');
    }

    public function second_player()
    {
        return $this->belongsTo('User', 'second_player_id');
    }

    public function game_rounds()
    {
        return $this->hasMany('GameRound');
    }

}