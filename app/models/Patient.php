<?php

class Patient extends \Eloquent {
    protected $fillable = [];
    protected $table = 'patients';

    public function city()
    {
    	return $this->belongsTo('City');
    }

    public function insurances()
    {
        return $this->belongsToMany('Financer','insurances')->withPivot('code');
    }

    public function laboratories()
    {
        return $this->morphMany('Laboratory','registrant');
    }

}