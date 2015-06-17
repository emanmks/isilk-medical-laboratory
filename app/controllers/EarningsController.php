<?php

class EarningsController extends \BaseController {

	public function index()
	{
		$earnings = Earning::orderBy('id','desc')->paginate(20);
		$menu = 'report';

		return View::make('earnings.index', compact('earnings','menu'));
	}

	public function create()
	{
		
	}

	public function store()
	{
		
	}

	public function show($id)
	{
		$earning = Earning::with('earnable')->findOrFail($id);
		$menu = '';

		return View::make('earnings.show', compact('earning','menu'));
	}

	
	public function edit($id)
	{
		
	}

	public function update($id)
	{
		
	}

	public function destroy($id)
	{
		Earning::destroy($id);
	}

}
