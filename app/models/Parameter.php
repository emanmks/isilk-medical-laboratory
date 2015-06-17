<?php

class Parameter extends \Eloquent {
    protected $fillable = [];

    public function service()
    {
    	return $this->belongsTo('Service');
    }

    public function regulation()
    {
        return $this->belongsTo('Regulation');
    }

    public function method()
    {
        return $this->belongsTo('Method');
    }

    public function result()
    {
    	return $this->belongsTo('Result');
    }

    public function normals()
    {
    	return $this->hasMany('Normal');
    }
}