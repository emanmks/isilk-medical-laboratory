<?php

class RegulationsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Regulation Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index()
	{
		$regulations = Regulation::paginate(9);
		$menu = 'datas';

		return View::make('regulations/index', compact('regulations','menu'));
	}

	public function show($id)
	{
		$regulation = Regulation::find($id);
		$menu = 'datas';

		return View::make('regulations/show', compact('regulation','menu'));
	}

	public function create()
	{
		$menu = 'datas';

		return View::make('regulations/create', compact('menu'));
	}

	public function store()
	{
		$regulation = new Regulation;

		$regulation->name = Input::get('name');
		$regulation->description = Input::get('description');
		$regulation->save();

		Session::flash('message','Sukses menambahkan Regulasi/Peraturan baru');
	}

	public function edit($id)
	{
		$regulation = Regulation::find($id);
		$menu = 'datas';

		return View::make('regulations/edit', compact('regulation','menu'));
	}

	public function update($id)
	{
		$regulation = Regulation::find($id);

		$regulation->name = Input::get('name');
		$regulation->description = Input::get('description');
		$regulation->save();

		Session::flash('message','Sukses mengupdate Regulasi/Peraturan');
	}

	public function destroy($id)
	{
		$regulation = Regulation::find($id);

		$regulation->delete();

		Session::flash('message','Sukses menghapus Regulasi/Peraturan');
	}

}