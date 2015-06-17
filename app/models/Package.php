<?php

class Package extends \Eloquent {
    protected $fillable = [];
    protected $table = 'packages';

    public function services()
    {
        return $this->belongsToMany('Service', 'package_service');
    }

    public function speciments()
    {
    	return $this->belongsToMany('Speciment','package_speciment');
    }

    public function choices()
    {
        return $this->morphMany('Choice', 'examinable');
    }
}