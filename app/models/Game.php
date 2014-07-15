<?php

class Game extends \Eloquent {
	protected $fillable = [
        'first_player_id',
        'second_player_id'
    ];

    protected $table = 'games';
}