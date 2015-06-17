<?php

class PaymentsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Payments Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index()
	{
		// /$payments = Payment::where(DB::raw(''),'=',date('Y-m-d'))->get();
		$payments = Payment::all();

		return View::make('payment/index')->with('payments', $payments)->with('menu','money');
	}	

	public function show($id)
	{
		$payment = Payment::with('laboratory.choices')->find($id);

		return View::make('payment/show')->with('payment', $payment)->with('menu','money');
	}

	public function store()
	{
		$payment = new Payment;

		$payment->payment = Input::get('payment');
		$payment->fee = Input::get('fee');
		$payment->tax = Input::get('tax');
		$payment->paymentdate = Input::get('paymentdate');
		$payment->laboratory_id = Input::get('laboratory_id');
		$payment->save();
	}

	public function edit($id)
	{
		$payment = Payment::find($id);

		return View::make('payment/edit')->with('payment', $payment)->with('menu','money');
	}

	public function update($id)
	{
		$payment = Payment::find($id);

		$payment->payment = Input::get('payment');
		$payment->fee = Input::get('fee');
		$payment->tax = Input::get('tax');
		$payment->paymentdate = Input::get('paymentdate');
		$payment->save();
	}

	public function destory($id)
	{
		$payment = Payment::where(DB::raw('date()'));

		$payment->delete();
	}

}