<?php

class EmployeesController extends BaseController {

	public function index()
	{
		$employees = Employee::paginate(9);
		$menu = 'datas';

		return View::make('data/employee', compact('employees','menu'));
	}

	public function store()
	{
		$employee = New Employee;

		$employee->code = Input::get('code');
		$employee->name = Input::get('name');
		$employee->education = Input::get('education');
		$employee->save();

		Session::flash('message','Sukses menambahkan pegawai');
	}

	public function update($id)
	{
		$employee = Employee::find($id);

		$employee->code = Input::get('code');
		$employee->name = Input::get('name');
		$employee->education = Input::get('education');
		$employee->save();

		Session::flash('message','Sukses mengupdate pegawai');
	}

	public function isDoctor($id)
	{
		$employee = Employee::find($id);

		$employee->doctor = 1;
		$employee->save();
	}

	public function notDoctor($id)
	{
		$employee = Employee::find($id);

		$employee->doctor = 0;
		$employee->save();
	}

	public function destroy($id)
	{
		$employee = Employee::find($id);

		$employee->delete();

		Session::flash('message','Sukses menghapus pegawai');
	}

}