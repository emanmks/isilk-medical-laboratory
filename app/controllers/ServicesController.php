<?php

class ServicesController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Service Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index()
	{
		$classifications = Classification::where('parent_id','=',0)->get();
		$menu = 'service';

		return View::make('services/index', compact('classifications','menu'));
	}

	public function create()
	{
		$installations = Installation::all();
		$speciments = Speciment::all();
		$menu = 'service';

		return View::make('services/create', compact('installations','speciments','menu'));
	}

	public function store()
	{
		$service = new Service;

		$service->classification_id	= Input::get('classification_id');
		$service->name 				= Input::get('name');
		$service->price				= Input::get('price');
		$service->clinical			= Input::get('clinical');
		$service->speciment_id		= Input::get('speciment_id');
		$service->save();

		$this->generateServiceCode($service->id);

		Session::flash('message','Sukses menambahkan pemeriksaan baru');
	}

	private function generateServiceCode($id)
	{
		$service = Service::find($id);
		$classification = Classification::find($service->classification_id);
		$counter = Service::where('classification_id','=',$classification->id)->count();

		$code = $classification->code.str_pad($counter, 2, STR_PAD_LEFT, "0");

		$service->code = $code;
		$service->save();
	}

	public function show($id)
	{
		$service = Service::with('parameters')->find($id);
		$menu = 'service';

		return View::make('services/show', compact('service','menu'));
	}

	public function update($id)
	{
		$service = Service::find($id);

		$service->name 				= Input::get('name');
		$service->price				= Input::get('price');
		$service->clinical			= Input::get('clinical');
		$service->speciment_id		= Input::get('speciment_id');
		$service->save();

		Session::flash('message','Sukses mengupdate pemeriksaan baru');
	}

	public function destroy($id)
	{
		$service = Service::find($id);
		$service->delete();

		Session::flash('message','Sukses menghapus pemeriksaan');
	}

}