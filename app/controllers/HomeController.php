<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showDashboard()
	{
		$menu = 'dashboard';
		
		return View::make('dashboard', compact('menu'));
	}

	public function showDataMenu()
	{
		$menu = 'datas';

		return View::make('datas', compact('menu'));
	}

	public function showReportMenu()
	{
		$menu = 'report';

		return View::make('reports', compact('menu'));
	}

	public function showManual()
	{
		$menu = 'manual';

		return View::make('manual/index', compact('menu'));
	}

}