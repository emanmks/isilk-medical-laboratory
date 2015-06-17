<?php

class Classification extends \Eloquent {
    protected $fillable = [];
    protected $table = 'classifications';

  	public function installation()
  	{
  		return $this->belongsTo('Installation');
  	}

  	public function subclassifications()
  	{
  		return $this->hasMany('Classification','parent_id');
  	}

  	public function services()
  	{
  		return $this->hasMany('Service');
  	}
}