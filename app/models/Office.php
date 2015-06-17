<?php

class Office extends \Eloquent {
    protected $fillable = [];

    public function city()
    {
        return $this->belongsTo('City');
    }

    public function billings()
    {
    	return $this->morphMany('Billing', 'financer');
    }

    public function payments()
    {
    	return $this->moprhMany('Payment', 'financer');
    }

    public function laboratories()
    {
        return $this->morphMany('Laboratory','registrant');
    }
}