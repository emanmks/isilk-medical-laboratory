<?php

class Payment extends \Eloquent {
    protected $fillable = [];

    public function laboratory()
    {
    	return $this->belongsTo('Laboratory');
    }

    public function financer()
    {
    	return $this->morphTo();
    }
}