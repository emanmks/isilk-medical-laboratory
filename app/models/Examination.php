<?php

class Examination extends \Eloquent {
    protected $fillable = [];

    public function choice()
    {
        return $this->belongsTo('Choice');
    }

    public function service()
    {
    	return $this->belongsTo('Service');
    }

    public function results()
    {
    	return $this->hasMany('Result');
    }

    public function samplings()
    {
    	return $this->belongsTo('Sampling');
    }
}