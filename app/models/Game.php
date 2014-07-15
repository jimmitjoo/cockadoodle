<?php

class Game extends \Eloquent {

    // DB fields that is fillable
    protected $fillable = [
        'first_player_id',
        'second_player_id'
    ];

    protected $table = 'games';
}