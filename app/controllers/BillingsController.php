<?php

class BillingsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Billings Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index()
	{
		//$billings = Billing::where(DB::raw('date(created_at)'),'=',date('Y-m-d'))->get();
		$billings = Billing::all();

		return View::make('billing/index')->with('billings', $billings)->with('menu', 'money');
	}

	public function show($id)
	{
		$billing = Billing::find($id);

		return View::make('billing/show')->with('billing', $billing)->with('menu', 'money');
	}

	public function receipt($id)
	{
		$billing = Billing::find($id);

		return View::make('billing/print')->with('billing', $billing)->with('menu', 'money');
	}

	public function store()
	{
		$billing = new Billing;

		$billing->total = Input::get('total');
		$billing->total = Input::get('laboratory_id');
		$billing->total = Input::get('financer_type');
		$billing->total = Input::get('financer_id');
		$billing->save();
	}

	public function edit($id)
	{
		$billing = Billing::find($id);

		return View::make('billing/edit')->with('billing', $billing)->with('menu', 'money');
	}

	public function update($id)
	{
		$billing = Billing::find($id);

		$billing->total = Input::get('total');
		$billing->total = Input::get('financer_type');
		$billing->total = Input::get('financer_id');
		$billing->save();
	}

	public function destory($id)
	{
		$billing = Billing::find($id);

		$billing->delete();
	}

	public function paid($id)
	{
		$billing = Billing::find($id);

		$billing->paid = 1;
		$billing->save();

		return Redirect::to('tagihan');
	}

	public function unpaid($id)
	{
		$billing = Billing::find($id);

		$billing->paid = 0;
		$billing->save();

		return Redirect::to('tagihan');
	}
}