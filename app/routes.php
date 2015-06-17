<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('login', array('as' => 'login.form', 'uses' => 'AuthController@getLogin'));
Route::post('login', array('as' => 'login.auth', 'uses' => 'AuthController@login'));
Route::get('logout', 'AuthController@logout');

Route::group(array('before' => 'auth'), function(){

	Route::get('/', array('as' => 'dashboard', 'uses' => 'HomeController@showDashboard'));

	Route::resource('klasifikasi', 'ClassificationsController', array('only' => array('show','store','update','destroy')));

	Route::resource('pemeriksaan', 'ServicesController', array('only' => array('show','create','store','edit','update','destroy')));
		Route::get('pemeriksaan', 'ClassificationsController@index');
		Route::get('pemeriksaan/{id}/klasifikasi', 'ClassificationsController@show');

	Route::get('parameter/{id}', 'ParametersController@show');
	Route::get('parameter/{id}/create', 'ParametersController@create');
	Route::post('parameter', 'ParametersController@store');
	Route::get('parameter/{id}/edit', 'ParametersController@edit');
	Route::put('parameter/{id}', 'ParametersController@update');
	Route::delete('parameter/{id}', 'ParametersController@destroy');
		Route::post('parameter/{parameter_id}/attach', 'ParametersController@createNormal');
		Route::post('parameter/{parameter_id}/attachNormal', 'ParametersController@attachNormal');
		Route::post('parameter/{id}/attach', 'ParametersController@detachNormal');

	Route::resource('normal', 'NormalsController', array('only' => array('store','edit','update','destroy')));
		Route::get('normal/{parameter_id}/create', 'NormalsController@create');
		Route::get('loadnormals/{parameter}','NormalsController@loadNormal');

	Route::resource('paket', 'PackagesController', array('only' => array('index','show','create','store','update','destroy')));
		Route::post('paket/{id}/attachspesimen', 'PackagesController@attachSpeciment');
		Route::delete('paket/{id}/detachspesimen/{speciment}', 'PackagesController@detachSpeciment');
		Route::post('paket/{id}/attachpemeriksaan', 'PackagesController@attachService');
		Route::delete('paket/{id}/detachpemeriksaan/{service}', 'PackagesController@detachService');

	Route::get('data', 'HomeController@showDataMenu');
	Route::get('laporan', 'HomeController@showReportMenu');
	Route::get('manual', 'HomeController@showManual');

	Route::resource('pegawai', 'EmployeesController', array('only' => array('index','store','update','destroy')));
		Route::put('pegawai/{id}/isdoctor', 'EmployeesController@isDoctor');
		Route::put('pegawai/{id}/notdoctor', 'EmployeesController@notDoctor');

	Route::resource('instalasi', 'InstallationsController', array('only' => array('index','show','store','update','destroy')));
		Route::post('instalasi/{id}/attach', 'InstallationsController@attachEmployee');
		Route::delete('instalasi/{id}/detach/{employee}', 'InstallationsController@detachEmployee');
		Route::post('instalasi/{id}/tambah/klasifikasi', 'InstallationsController@attachClassification');
		Route::delete('instalasi/{id}/hapus/klasifikasi/{classification}', 'InstallationsController@detachClassification');

	Route::resource('referensi', 'RegulationsController', array('only' => array('index','show','create','store','edit','update','destroy')));
	
	Route::resource('instansi', 'OfficesController', array('only' => array('index','show','create','store','edit','update','destroy')));
		Route::post('instansi/store', 'OfficesController@storeQuick');

	Route::resource('pasien', 'PatientsController');
		Route::post('pasien/store', 'PatientsController@storeQuick');
		Route::post('pasien/{id}/attach', 'PatientsController@attachInsurance');
		Route::post('pasien/{id}/detach', 'PatientsController@detachInsurance');

	Route::resource('spesimen', 'SpecimentsController', array('only' => array('index','store','update','destroy')));
	Route::resource('metode', 'MethodsController', array('only' => array('index','show','create','store','edit','update','destroy')));
	Route::resource('user', 'UsersController', array('only' => array('index','show','store','update','destroy')));

	Route::resource('laboratorium','LaboratoriesController', array('only' => array('index','create','show','store','destroy')));

	Route::resource('sampling','SamplingsController', array('only' => array('index','show','store','update')));
	Route::resource('entry','ExaminationsController', array('only' => array('index','show','store','update')));
		Route::post('loadnormal/{parameter}', 'NormalsController@loadNormal');

	Route::resource('hasil','ResultsController', array('only' => array('index','show','store','update')));

		Route::put('hasil/{id}/verifikasi', 'ResultsController@verify');
		Route::put('hasil/{id}/batalverifikasi', 'ResultsController@unverify');
		Route::put('hasil/{id}/rilis', 'ResultsController@release');
		Route::put('hasil/{id}/batalrilis', 'ResultsController@unrelease');

		Route::get('hasil/{id}/{option}', 'ResultsController@layout');
	

	Route::resource('penerimaan','EarningsController', array('only' => array('index','show','store','update')));
		Route::get('penerimaan/{from}/sampai/{to}', 'EarningsController@filter');

	Route::resource('tagihan','InvoicesController', array('only' => array('index','show','store','update')));

	Route::resource('pembiayaan','FinancersController');

	Route::get('filterkota/{state}', 'AjaxesController@loadCities');
	Route::get('carikota/{name}', 'AjaxesController@searchCities');
	Route::get('caripasien/{name}', 'AjaxesController@searchPatients');
	Route::get('carikantor/{name}', 'AjaxesController@searchOffices');
	Route::get('loadasuransi/{patient}', 'AjaxesController@loadInsurance');
});