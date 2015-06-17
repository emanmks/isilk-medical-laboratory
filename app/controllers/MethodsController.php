<?php

class MethodsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Methods Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index()
	{
		$methods = Method::paginate(12);
		$menu = 'datas';

		return View::make('methods/index', compact('methods','menu'));
	}

	public function create()
	{
		$menu = 'datas';

		return View::make('methods/create', compact('menu'));
	}

	public function store()
	{
		$method = new Method;

		$method->name 		= Input::get('name');
		$method->description = Input::get('description');
		$method->clinical = Input::get('clinical');
		$method->save();

		Session::flash('message','Sukses menginput data metode');
	}

	public function show($id)
	{
		$method = Method::find($id);
		$menu = 'datas';

		return View::make('methods/show', compact('method','menu'));
	}

	public function edit($id)
	{
		$method = Method::find($id);
		$menu = 'datas';

		return View::make('methods/edit', compact('method','menu'));
	}

	public function update($id)
	{
		$method = Method::find($id);

		$method->name 		= Input::get('name');
		$method->description = Input::get('description');
		$method->clinical = Input::get('clinical');
		$method->save();

		Session::flash('message','Sukses mengupdate metode');
	}

	public function destroy($id)
	{
		$method = Method::find($id);

		$method->delete();

		Session::flash('message','Sukses menghapus metode');
	}

}