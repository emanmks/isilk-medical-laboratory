<?php

class InvoicesController extends \BaseController {

	public function index()
	{
		$invoices 	= Invoice::orderBy('id','desc')->paginate(20);
		$menu 		= 'report';

		return View::make('invoices.index', compact('invoices','menu'));
	}

	public function create()
	{
		
	}

	public function store()
	{

	}


	public function show($id)
	{
		$invoice = Invoice::with('laboratory')->findOrFail($id);
		$menu = '';

		return View::make('invoices.show', compact('invoice','menu'));
	}

	public function edit($id)
	{
		
	}

	public function update($id)
	{
		
	}

	public function destroy($id)
	{
		Invoice::destroy($id);
	}

}
