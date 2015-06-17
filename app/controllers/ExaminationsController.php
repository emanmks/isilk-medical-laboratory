<?php

class ExaminationsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Examinations Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index()
	{
		/*$examinations = Examination::where(DB::raw('date(created_at)'),'=',date('Y-m-d'))
							->with('sampling.laboratory','sampling.speciment')
							->get();*/
		
		//$samplings = Sampling::where('taken','=',1)->where(DB::raw('date(created_at)'),'=',date('Y-m-d'))->paginate(20);
		$samplings = Sampling::where('taken','=',1)->orderBy('id','desc')->paginate(20);
		$menu = 'examination';
		
		return View::make('examination/index', compact('samplings','menu'));
	}

	public function store()
	{
		$sampling = Sampling::with('laboratory','speciment','examinations')->findOrFail(Input::get('sampling_id'));

		$sampling->name 		= Input::get('name');
		$sampling->form 		= Input::get('form');
		$sampling->container 	= Input::get('container');
		$sampling->volume 		= Input::get('volume');
		$sampling->save();

		$counter = 0;
		$results = Input::get('values');
		$regulations = Input::get('regulations');
		$methods = Input::get('methods');

		foreach ($sampling->examinations as $examination) {

			foreach ($examination->results as $result) {
				
				$result->result 		= $results[$counter];
				$result->regulation 	= $regulations[$counter];
				$result->method 		= $methods[$counter];
				$result->save();

				$counter++;

			}

		}

		Session::flash('message','Sukses melakukan Entry Nilai Hasil Uji');
	}

	public function show($id)
	{
		$sampling = Sampling::with('laboratory','speciment','examinations')->find($id);
		$menu = 'examination';

		return View::make('examination/show', compact('sampling','menu'));
	}
}