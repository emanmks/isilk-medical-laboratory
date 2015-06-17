<?php

class Normal extends \Eloquent {
    protected $fillable = [];

    public function parameter()
    {
    	return $this->belongsTo('Parameter');
    }

    public function regulation()
    {
    	return $this->belongsTo('Regulation');
    }
    
    public function method()
    {
    	return $this->belongsTo('Method');
    }
}