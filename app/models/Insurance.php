<?php

class Insurance extends \Eloquent {
    protected $fillable = [];

    public function patient()
    {
    	return $this->belongsTo('Patient');
    }

    public function financer()
    {
    	return $this->belongsTo('Financer');
    }
}