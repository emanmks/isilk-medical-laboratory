<?php

class FinancersController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Financer Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index()
	{
		$financers = Financer::all();
		$menu = 'datas';

		return View::make('financers/index', compact('financers','menu'));
	}

	public function create()
	{
		$menu = 'datas';
		return View::make('financers/create', compact('menu'));
	}

	public function store()
	{
		$financer = new Financer;

		$financer->name 		= Input::get('name');
		$financer->address 		= Input::get('address');
		$financer->phone 		= Input::get('phone');
		$financer->email 		= Input::get('email');
		$financer->description 	= Input::get('description');
		$financer->save();

		Session::flash('message','Sukses menginput data Pembiayaan');
	}

	public function show($id)
	{
		$financer = Financer::find($id);
		$menu = 'datas';

		return View::make('financers/show', compact('financer','menu'));
	}

	public function edit($id)
	{
		$financer = Financer::find($id);
		$menu = 'datas';

		return View::make('financers/edit', compact('financer','menu'));
	}

	public function update($id)
	{
		$financer = Financer::find($id);

		$financer->name 		= Input::get('name');
		$financer->address 		= Input::get('address');
		$financer->phone 		= Input::get('phone');
		$financer->email 		= Input::get('email');
		$financer->description = Input::get('description');
		$financer->save();

		Session::flash('message','Sukses mengupdate Pembiayaan');
	}

	public function destroy($id)
	{
		$financer = Financer::find($id);

		$financer->delete();

		Session::flash('message','Sukses menghapus Pembiayaan');
	}

}