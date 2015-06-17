<?php

class UsersController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Billing Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index()
	{
		$users = User::paginate(12);
		$employees = Employee::all();
		$menu = 'datas';

		return View::make('user/user', compact('users','employees','menu'));
	}

	public function show($id)
	{
		$user = User::find($id);

		return View::make('user/profile')->with('user',$user)->with('menu','profile');
	}

	public function store()
	{
		$user = new User;

		$user->username 	= Input::get('username');
		$user->password 	= Hash::make(Input::get('password'));
		$user->role 		= Input::get('role');
		$user->employee_id 	= Input::get('employee_id');
		$user->save();

		Session::flash('message','Sukses menambahkan user');
	}

	public function update($id)
	{
		$user = User::find($id);

		$user->username 	= Input::get('username');
		$user->password 	= Hash::make(Input::get('password'));
		$user->role 		= Input::get('role');
		$user->employee_id 	= Input::get('employee_id');
		$user->save();

		Session::flash('message','Sukses mengupdate user');
	}

	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();
		Session::flash('message','Sukses menghapus user');
	}

}