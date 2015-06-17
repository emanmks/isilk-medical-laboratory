<?php

class Result extends \Eloquent {
    protected $fillable = [];

    public function parameter()
    {
    	return $this->belongsTo('Parameter');
    }

    public function examination()
    {
        return $this->belongsTo('Examination');
    }
}