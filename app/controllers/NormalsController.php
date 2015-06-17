<?php

class NormalsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Normal Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function create($parameter_id)
	{
		$parameter = Parameter::find($parameter_id);
		$regulations = Regulation::all();
		$methods = Method::where('clinical','=',$parameter->service->clinical)->get();
		$menu = 'service';

		return View::make('normal/create', compact('parameter','regulations','methods','menu'));
	}

	public function store()
	{
		$normal = new Normal;
		$normal->parameter_id 			= Input::get('parameter_id');
		$normal->regulation_id 			= Input::get('regulation_id');
		$normal->method_id 				= Input::get('method_id');
		$normal->normal 				= Input::get('normal');
		$normal->save();

		Session::flash('message','Sukses menambahkan alternatif nilai rujukan baru!');
	}

	public function edit($id)
	{
		$normal = Normal::find($id);
		$regulations = Regulation::all();
		$methods = Method::where('clinical','=',$normal->parameter->service->clinical)->get();
		$menu = 'service';

		return View::make('normal/edit', compact('normal','regulations','methods','menu'));
	}

	public function update($id)
	{
		$normal = Normal::find($id);
		
		$normal->regulation_id 			= Input::get('regulation_id');
		$normal->method_id 				= Input::get('method_id');
		$normal->normal 				= Input::get('normal');
		$normal->save();

		Session::flash('message','Sukses mengupdate alternatif nilai rujukan!');
	}

	public function destroy($id)
	{
		$normal = Normal::find($id);
		$normal->delete();

		Session::flash('message','Sukses menghapus nilai normal');
	}

	public function loadNormal($parameter)
	{
		return Normal::with('regulation','method')->where('parameter_id','=',$parameter)->get();
	}

}