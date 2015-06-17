<?php

class InstallationsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Installation Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index()
	{
		$installations = Installation::paginate(9);
		$menu = 'datas';

		return View::make('installation/index', compact('installations', 'menu'));
	}

	public function show($id)
	{
		$installation = Installation::find($id);
		$employees = Employee::all();
		$classifications = Classification::where('parent_id','=',0)->get();
		$menu = 'datas';

		return View::make('installation/show', compact('installation','employees','classifications','menu'));
	}

	public function store()
	{
		$installation = new Installation;

		$installation->name = Input::get('name');
		$installation->save();

		Session::flash('message','Instalasi baru sukses ditambahkan');
	}

	public function update($id)
	{
		$installation = Installation::find($id);

		$installation->name = Input::get('name');
		$installation->save();

		Session::flash('message','Instalasi sukses diupdate');
	}

	public function destroy($id)
	{
		$installation = Installation::destroy($id);

		Session::flash('message','Instalasi telah dihapus');
	}

	public function attachEmployee($id)
	{
		$installation = Installation::find($id);
		$installation->employees()->attach(Input::get('employee_id'), array('position' => Input::get('position')));

		Session::flash('message','Sukses menambahkan pegawai');
	}

	public function detachEmployee($id, $employee)
	{
		$installation = Installation::find($id);
		$installation->employees()->detach($employee);

		Session::flash('message','Sukses mengeluarkan pegawai');
	}

	public function attachClassification($id)
	{
		$installation = Installation::find($id);
		$installation->classifications()->attach(Input::get('classification_id'));

		Session::flash('message','Sukses menambahkan kelompok pemeriksaan');
	}

	public function detachClassification($id, $classification)
	{
		$installation = Installation::find($id);
		$installation->classifications()->detach($classification);

		Session::flash('message','Sukses mengeluarkan kelompok pemeriksaan');
	}
}