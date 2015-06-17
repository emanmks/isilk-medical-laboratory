<?php

class City extends \Eloquent {
    protected $fillable = [];

    public function state()
    {
    	return $this->belongsTo('State');
    }

}