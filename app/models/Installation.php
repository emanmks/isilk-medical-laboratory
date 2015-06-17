<?php

class Installation extends \Eloquent {
    protected $fillable = [];

    public function employees()
    {
    	return $this->belongsToMany('Employee', 'positionings','installation_id','employee_id')->withPivot('position');
    }

    public function classifications()
    {
        return $this->belongsToMany('Classification', 'placements', 'installation_id', 'classification_id');
    }
}