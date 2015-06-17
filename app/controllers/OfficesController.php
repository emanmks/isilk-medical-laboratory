<?php

class OfficesController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Offices Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index()
	{
		$offices = Office::paginate(9);
		$menu = 'datas';

		return View::make('offices/index', compact('offices','menu'));
	}

	public function show($id)
	{
		$office = Office::find($id);
		$menu = 'datas';

		return View::make('offices/show', compact('office','menu'));
	}

	public function create()
	{
		$states = State::all();
		$menu = 'datas';

		return View::make('offices/create',compact('states','menu'));
	}

	public function store()
	{
		$office = new Office;

		$office->name = Input::get('name');
		$office->address = Input::get('address');
		$office->phone = Input::get('phone');
		$office->fax = Input::get('fax');
		$office->city_id = Input::get('city_id');
		$office->save();

		Session::flash('message','Sukses menambahkan Instansi');
	}

	public function storeQuick()
	{
		$office = new Office;

		$office->name = Input::get('name');
		$office->address = Input::get('address');
		$office->phone = Input::get('phone');
		$office->fax = Input::get('fax');
		$office->city_id = Input::get('city_id');
		$office->save();

		return array('id' => $office->id);
	}

	public function edit($id)
	{
		$office = Office::find($id);
		$states = State::all();
		$menu = 'datas';

		return View::make('offices/edit', compact('office','states','menu'));
	}

	public function update($id)
	{
		$office = Office::find($id);

		$office->name = Input::get('name');
		$office->address = Input::get('address');
		$office->phone = Input::get('phone');
		$office->fax = Input::get('fax');
		$office->city_id = Input::get('city_id');
		$office->save();

		Session::flash('message','Sukses mengupdate Instansi');
	}

	public function destroy($id)
	{
		$office = Office::find($id);

		$office->delete();

		Session::flash('message','Sukses menghapus Instansi');
	}

}