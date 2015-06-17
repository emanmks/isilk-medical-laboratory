<?php

class Service extends \Eloquent {
    protected $fillable = [];
    protected $table = 'services';

    public function installation()
    {
    	return $this->belongsTo('Installation');
    }

    public function classification()
    {
    	return $this->belongsTo('Classification');
    }

    public function speciment()
    {
    	return $this->belongsTo('speciment');
    }

    public function parameters()
    {
        return $this->hasMany('Parameter');
    }

    public function choices()
    {
        return $this->morphMany('Choice','examinable');
    }
}