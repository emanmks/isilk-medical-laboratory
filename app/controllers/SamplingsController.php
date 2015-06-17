<?php

class SamplingsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Samplings Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index()
	{
		//$samplings = Sampling::where(DB::raw('date(created_at)'),'=',date('Y-m-d'))->get();
		$samplings = Sampling::with('laboratory')->orderBy('id','desc')->paginate(20);
		$menu = 'sampling';

		return View::make('sampling/index', compact('samplings','menu'));
	}

	public function store()
	{
		$sampling = new Sampling;

		$sampling->code = $this->generateCode();
		$sampling->taken = 0;
		$sampling->description = Input::get('description');
		$sampling->form = Input::get('form');
		$sampling->container = Input::get('container');
		$sampling->volume = Input::get('volume');
		$sampling->laboratory_id = Input::get('laboratory_id');
		$sampling->speciment_id = Input::get('speciment_id');
		$sampling->save();
	}

	public function generateCode()
	{
		$rows = Sampling::all()->count();

		if($rows < 1)
		{
			$id = 1;
		}
		else
		{
			$samplings = Sampling::orderBy('id','desc')->take(1)->get();

			foreach ($samplings as $sampling) {
				$id = $sampling->id;
			}

			$id += 1;
		}

		return date('y').'-'.date('m').'-02-'.$id;
	}

	public function update($id)
	{
		$sampling = Sampling::find($id);

		$sampling->name = Input::get('name');
		$sampling->taken = Input::get('taken');
		$sampling->description = Input::get('description');
		$sampling->form = Input::get('form');
		$sampling->container = Input::get('container');
		$sampling->volume = Input::get('volume');
		$sampling->save();

		Session::flash('message',"Status Sampel: ".$sampling->code." telah diubah");
	}

}