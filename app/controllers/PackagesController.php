<?php

class PackagesController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Packages Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index()
	{
		$packages = Package::with('speciments')->get();
		$speciments = Speciment::all();
		$menu = 'package';

		return View::make('packages/index', compact('packages','speciments','menu'));
	}

	public function show($id)
	{
		$package = Package::find($id);
		$classifications = Classification::where('parent_id','=',0)->get();
		$speciments = Speciment::all();
		$menu = 'package';

		return View::make('packages/show', compact('package','classifications','speciments','menu'));
	}

	public function create()
	{
		$menu = 'package';
		$classifications = Classification::where('parent_id','=',0)->get();
		$speciments = Speciment::all();

		return View::make('packages/create', compact('classifications','speciments','menu'));
	}


	public function store()
	{
		$package = new Package;

		$price = Input::get('price');
		$price = str_replace(",", ".", $price);
		$price = str_replace(".", "", $price);
		$price = substr($price,0,-2);

		$package->name = Input::get('name');
		$package->price = $price;
		$package->save();

		$this->generateCode($package->id);

		foreach(Input::get('services') as $key => $value)
		{
			$package->services()->attach($value[0]);
		}

		foreach(Input::get('speciments') as $key => $value) 
		{
			$package->speciments()->attach($value[0]);
		}	

		Session::flash('message','Sukses menginput paket');
	}

	public function update($id)
	{
		$package = Package::find($id);

		$price = Input::get('price');
		$price = str_replace(",", ".", $price);
		$price = str_replace(".", "", $price);
		$price = substr($price,0,-2);

		$package->name = Input::get('name');
		$package->price = $price;
		$package->save();

		Session::flash('message','Sukses mengupdate paket');
	}

	public function destroy($id)
	{
		$package = Package::find($id);

		$package->delete();

		Session::flash('message','Sukses menghapus paket');
	}

	public function attachService($id)
	{
		$package = Package::find($id);

		foreach(Input::get('services') as $key => $value)
		{
			$package->services()->attach($value[0]);
		}

		Session::flash('message','Sukses menambahkan Layanan Pemeriksaan');
	}

	public function detachService($id, $service_id)
	{
		$package = Package::find($id);
		$package->services()->detach($service_id);

		Session::flash('message','Sukses menghapus Layanan Pemeriksaan');
	}

	public function attachSpeciment($id)
	{
		$package = Package::find($id);

		foreach(Input::get('speciments') as $key => $value) 
		{
			$package->speciments()->attach($value[0]);
		}	

		Session::flash('message','Sukses menambahkan Spesimen ke Paket Pemeriksaan');
	}

	public function detachSpeciment($id, $speciment_id)
	{
		$package = Package::find($id);
		$package->speciments()->detach($speciment_id);

		Session::flash('message','Sukses menghapus Spesimen dari Paket Pemeriksaan');
	}

	private function generateCode($id)
	{
		$package = Package::find($id);

		$package->code = 'PKT'.$package->id;
		$package->save();
	}
}