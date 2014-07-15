<?php

class Game extends \Eloquent {
	protected $fillable = [
        'first_player_id',
        'second_player_id'
    ];

    protected $rules = [
        'first_player_id' => 'required',
        'second_player_id' => 'required'
    ];

    protected $table = 'games';
}