<?php

class ResultsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Results Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index()
	{
		//$laboratories = Laboratory::where(DB::raw('date(registrationtime)'),'=',date('Y-m-d'))->get();
		$laboratories = Laboratory::orderBy('id','desc')->paginate(20);
		$menu = 'result';

		return View::make('result/index', compact('laboratories','menu'));
	}

	public function show($laboratory)
	{
		$laboratory = Laboratory::with('samplings','choices.examinations.results')->find($laboratory);
		$menu = 'result';

		return View::make('result/show', compact('laboratory','menu'));
	}

	public function verify($id)
	{
		$laboratory = Laboratory::find($id);

		$laboratory->verified = 1;
		$laboratory->save();

		Session::flash('message','Verifikasi Sukses!!');
	}

	public function unverify($id)
	{
		$laboratory = Laboratory::find($id);

		$laboratory->verified = 0;
		$laboratory->save();

		Session::flash('message','Verifikasi Dibatalkan!!');
	}

	public function release($id)
	{
		$laboratory = Laboratory::find($id);

		$laboratory->released = 1;
		$laboratory->save();

		Session::flash('message','Rilis Sukses!!');
	}

	public function unrelease($id)
	{
		$laboratory = Laboratory::find($id);

		$laboratory->released = 0;
		$laboratory->save();

		Session::flash('message','Rilis Batal!!');
	}

	public function layout($id, $option)
	{
		$laboratory = Laboratory::find($id);
		$employees = Employee::all();
		$menu = 'result';

		switch ($option) {
			case 'konvensional':
				return View::make('result/conventional', compact('laboratory','employees','menu'));
				break;

			case 'horizontal':
				return View::make('result/horizontal', compact('laboratory','employees','menu'));
				break;

			case 'naratif':
				return View::make('result/narrative', compact('laboratory','employees','menu'));
				break;

			case 'surat':
				return View::make('result/letter', compact('laboratory','employees','menu'));
				break;
			
			default:
				return View::make('result/conventional', compact('laboratory','employees','menu'));
				break;
		}
	}

}