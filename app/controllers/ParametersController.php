<?php

class ParametersController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Parameter Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function show($id)
	{
		$parameter = Parameter::find($id);
		$menu = 'service';

		return View::make('normal/index', compact('parameter','menu'));
	}

	public function create($service_id)
	{
		$service = Service::find($service_id);
		$regulations = Regulation::all();
		$methods = Method::all();
		$menu = 'service';

		return View::make('parameter/create', compact('service','regulations','methods','menu'));
	}

	public function store()
	{
		$parameter = new Parameter;

		$parameter->service_id			= Input::get('service_id');
		$parameter->name 				= Input::get('name');
		$parameter->datatype			= Input::get('datatype');
		$parameter->unit				= Input::get('unit');
		$parameter->expression 			= Input::get('expression');
		$parameter->normal 				= Input::get('normal');
		$parameter->regulation_id 		= Input::get('regulation_id');
		$parameter->method_id 			= Input::get('method_id');
		$parameter->save();

		Session::flash('message','Sukses menambahkan parameter baru');
	}

	public function edit($id)
	{
		$parameter = Parameter::find($id);
		$regulations = Regulation::all();
		$methods = Method::all();
		$menu = 'service';

		return View::make('parameter/edit', compact('parameter','regulations','methods','menu'));
	}

	public function update($id)
	{
		$parameter = Parameter::find($id);

		$parameter->name 				= Input::get('name');
		$parameter->datatype			= Input::get('datatype');
		$parameter->unit				= Input::get('unit');
		$parameter->expression 			= Input::get('expression');
		$parameter->normal 				= Input::get('normal');
		$parameter->regulation_id 		= Input::get('regulation_id');
		$parameter->method_id 			= Input::get('method_id');
		$parameter->save();

		Session::flash('message','Sukses mengupdate parameter');
	}

	public function destroy($id)
	{
		$parameter = Parameter::destroy($id);

		Session::flash('message','Sukses menghapus parameter');
	}
}