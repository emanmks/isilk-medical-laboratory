<?php

class AjaxesController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Ajaxes Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function loadCities($state_id)
	{
		return City::select('id','name')->where('state_id','=',$state_id)->get();
	}

	public function searchCities($name)
	{
		return City::with('state')->where('name','like',"%$name%")->take(5)->get();
	}

	public function searchPatients($name)
	{
		return Patient::with('city.state')->where('name','like',"%$name%")->take(5)->get();
	}

	public function searchOffices($name)
	{
		return Office::with('city')->where('name','like',"%$name%")->take(5)->get();
	}

	public function loadInsurance($patient_id)
	{
		return Insurance::with('financer')->where('patient_id','=',$patient_id)->get();
	}

}