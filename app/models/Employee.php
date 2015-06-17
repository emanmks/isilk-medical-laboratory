<?php

class Employee extends \Eloquent {
    protected $fillable = [];

    public function laboratories()
    {
    	return $this->morphMany('Laboratory','registrant');
    }
}