<?php

class Grade extends \Eloquent {
	protected $fillable = [
        'doodle_id',
        'judge_id',
        'grade'
    ];

    protected $table = 'doodlegrades';

    public function doodle()
    {
        return $this->belongsTo('Doodle');
    }

}