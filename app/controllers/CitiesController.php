<?php

class CitiesController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Cities Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index()
	{
		$cities = City::all();
	}

	public function store()
	{

	}

	public function update($id)
	{

	}

	public function destroy($id)
	{

	}

	public function filter($state)
	{
		$cities = City::where('state_id',$state)->get();

		return Response::json($cities->toArray());
	}

}