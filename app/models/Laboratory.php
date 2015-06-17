<?php

class Laboratory extends \Eloquent {
    protected $fillable = [];

    public function registrant()
    {
    	return $this->morphTo();
    }

    public function employee()
    {
    	return $this->belongsTo('Employee');
    }

    public function regulation()
    {
        return $this->belongsTo('Regulation');
    }

    public function choices()
    {
        return $this->hasMany('Choice');
    }

    public function samplings()
    {
    	return $this->hasMany('Sampling');
    }

    public function earning()
    {
        return $this->morphMany('Earning', 'earnable');
    }

    public function invoice()
    {
        return $this->hasOne('Invoice');
    }
}