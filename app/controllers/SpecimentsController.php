<?php

class SpecimentsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Billing Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index()
	{
		$speciments = Speciment::paginate(12);
		$menu = 'datas';

		return View::make('data/speciment', compact('speciments','menu'));
	}

	public function store()
	{
		$speciment = new Speciment;

		$speciment->name 		= Input::get('name');
		$speciment->save();

		$this->generateCode($speciment->id);

		Session::flash('message','Sukses menginput data spesimen');
	}

	private function generateCode($id)
	{
		$code = 'SC'.$id;

		$speciment = Speciment::find($id);

		$speciment->code = $code;
		$speciment->save();
	}

	public function update($id)
	{
		$speciment = Speciment::find($id);

		$speciment->name 		= Input::get('name');
		$speciment->save();

		Session::flash('message','Sukses mengupdate spesimen');
	}

	public function destroy($id)
	{
		$speciment = Speciment::find($id);

		$speciment->delete();

		Session::flash('message','Sukses menghapus spesimen');
	}

}