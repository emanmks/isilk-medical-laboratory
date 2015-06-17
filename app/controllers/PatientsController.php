<?php

class PatientsController extends BaseController {

	public function index()
	{
		$patients = Patient::with('city')->paginate(12);
		$menu = 'datas';

		return View::make('patients/index', compact('patients','states','menu'));
	}

	public function show($id)
	{
		$patient = Patient::with('insurances')->find($id);
		$financers = Financer::all();
		$menu = 'datas';

		return View::make('patients/show', compact('patient','financers','menu'));
	}

	public function create()
	{
		$states = State::all();
		$menu = 'datas';

		return View::make('patients/create', compact('states','menu'));
	}

	public function store()
	{
		$patient = New Patient;

		$patient->name = Input::get('name');
		$patient->sex = Input::get('sex');
		$patient->birthdate = Input::get('birthdate');
		$patient->address = Input::get('address');
		$patient->contact = Input::get('contact');
		$patient->city_id = Input::get('city_id');
		
		$patient->save();

		$this->generateCode($patient->id);

		Session::flash('message','Sukses menambahkan pasien');
	}

	public function storeQuick()
	{
		$patient = New Patient;

		$patient->name = Input::get('name');
		$patient->sex = Input::get('sex');
		$patient->birthdate = Input::get('birthdate');
		$patient->address = Input::get('address');
		$patient->contact = Input::get('contact');
		$patient->city_id = Input::get('city_id');
		
		$patient->save();

		$this->generateCode($patient->id);

		$patient = Patient::find($patient->id);

		if(Input::get('financer_id') > 0){
			$patient->insurances()->attach(Input::get('financer_id'), array('code' => Input::get('code')));
		}

		return array('id' => $patient->id,'code' => $patient->code);
	}

	private function generateCode($id)
	{
		$patient = Patient::find($id);

		$state_id = $patient->city_id;
		$birtdate = str_replace("-", "", $patient->birthdate);

		$code = $state_id.$birtdate.str_pad($patient->id, 5, "0", STR_PAD_LEFT);

		$patient->code = $code;
		$patient->save();
	}


	public function edit($id)
	{
		$patient = Patient::find($id);
		$states = State::all();
		$menu = 'datas';

		return View::make('patients/edit', compact('patient','states','menu'));
	}

	public function update($id)
	{
		$patient = Patient::find($id);

		$patient->name = Input::get('name');
		$patient->sex = Input::get('sex');
		$patient->birthdate = date('Y-m-d', strtotime(Input::get('birthdate')));
		$patient->address = Input::get('address');
		$patient->contact = Input::get('contact');
		$patient->city_id = Input::get('city_id');
		$patient->save();

		Session::flash('message','Sukses mengupdate pasien');
	}

	public function destroy($id)
	{
		$patient = Patient::find($id);

		$patient->delete();

		Session::flash('message','Sukses menghapus pasien');
	}

	public function attachInsurance($id)
	{
		$patient = Patient::find($id);

		$patient->insurances()->attach(Input::get('financer_id'), array('code' => Input::get('code')));

		Session::flash('message','Sukses menambahkan Asuransi untuk Pasien ini!');
	}

	public function detachInsurance($id)
	{
		$patient = Patient::find($id);

		$patient->insurances()->detach(Input::get('financer_id'));

		Session::flash('message','Sukses menghapus Asuransi untuk Pasien ini!');
	}

}