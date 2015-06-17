<?php

class RequestsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Requests Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index()
	{
		return View::make('result/index')->with('menu','laboratory');
	}

}