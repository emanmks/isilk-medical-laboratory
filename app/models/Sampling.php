<?php

class Sampling extends \Eloquent {
    protected $fillable = [];

    public function laboratory()
    {
    	return $this->belongsTo('Laboratory');
    }

    public function speciment()
    {
    	return $this->belongsTo('Speciment');
    }

    public function examinations()
    {
    	return $this->hasMany('Examination');
    }

    public function service()
    {
        return $this->belongsTo('Service');
    }
}