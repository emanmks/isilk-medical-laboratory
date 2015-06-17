<?php

class Choice extends \Eloquent {
    protected $fillable = [];

    public function examinable()
    {
    	return $this->morphTo();
    }

    public function sampling()
    {
    	return $this->belongsTo('Sampling');
    }

    public function examinations()
    {
    	return $this->hasMany('Examination');
    }
}