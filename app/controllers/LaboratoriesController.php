<?php

class LaboratoriesController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Laboratories Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index()
	{
		//$laboratories = Laboratory::where(DB::raw('date(registrationtime)'), "=", date('Y-m-d'))->get();
		$laboratories = Laboratory::orderBy('id','desc')->paginate(20);
		$menu = 'registration';

		return View::make('laboratory/index', compact('laboratories','menu'));
	}

	public function show($id)
	{
		$laboratory = Laboratory::with('choices','registrant','samplings','earning','invoice')->find($id);
		$menu = 'registration';

		return View::make('laboratory/show', compact('laboratory','menu'));
	}

	public function create()
	{
		$financers = Financer::all();
		$packages = Package::all();
		$regulations = Regulation::all();
		$methods = Method::all();
		$classifications = Classification::where('parent_id','=',0)->get();
		$menu = 'registration';

		return View::make('laboratory/create',
						compact('financers','packages','regulations','methods','classifications','menu'));
	}

	public function edit($id)
	{
		$laboratory = Laboratory::findOrFail($id);
		$classifications = Classification::where('parent_id','=',0)->get();
		$menu = 'registration';

		return View::make('laboratory/create',
						compact('classifications','menu'));
	}

	public function store()
	{
		// Speciments
		$speciments = array();

		/* Determining Registrant Type */
		if(Input::get('patient_id') > 0){

			// Registrant is from Patient
			$registrant_type = 'Patient';
			$registrant_id = Input::get('patient_id');

		}elseif(Input::get('office_id') > 0){

			// Registrant is from Office
			$registrant_type = 'Office';
			$registrant_id = Input::get('office_id');

		}else{

			// Registrant is Unknown
			$registrant_type = 'Unknown';

		}

		// Get the value of Packages and services
		$packages = Input::get('packages');
		$services = Input::get('services');

		/**
		 * Exit from Function store() if:
		 * 1. Registrant Type is empty
		 * 2. Packages and Services is empty
		 */
		if((empty($packages) && empty($services)) || $registrant_type == 'Unknown'){

			// send json to client and then stop execution
			return array('status' => 'Aborted');
			exit();

		}

		/*return array('patient_id' => Input::get('patient_id'),'office_id' => Input::get('office_id'),
					'packages' => $packages, 'services' => $services,
					'registrant_type' => $registrant_type);*/

		// Store New Registration Record to Database
		$laboratory = new Laboratory;
		$laboratory->registrant_type 	= $registrant_type;
		$laboratory->registrant_id 		= $registrant_id;
		$laboratory->employee_id 		= Auth::user()->employee->id;
		$laboratory->regulation_id 		= Input::get('regulation_id');
		$laboratory->recommender 		= Input::get('recommender');
		$laboratory->recommender_name 	= Input::get('recommender_name');
		$laboratory->registrationtime	= date('Y-m-d H:i:s');
		$laboratory->save();

		// Generate Laboratory Code
		$laboratory->code = $this->generateCode($laboratory->id);
		$laboratory->save();

		// Create Choices & Samplings

		if(count($packages) > 0)
		{
			$packagesLength = count($packages);

			// Generate Choices Record
			for($i = 0; $i < $packagesLength; $i++)
			{
				$package = Package::with('services')->find($packages[$i]);

				//Create Choice Record
				$choice = new Choice;
				$choice->laboratory_id = $laboratory->id;
				$choice->examinable_type = 'Package';
				$choice->examinable_id = $package->id;
				$choice->save();

				// Generate Samplings Record
				foreach ($package->speciments as $speciment)
				{
					$sampling = new Sampling;
					$sampling->laboratory_id = $laboratory->id;
					$sampling->speciment_id = $speciment->id;
					if($speciment->id > 1):
						$sampling->name = $speciment->name;
					else:
						$sampling->name = '';
					endif;
					$sampling->save();

					//Generate Sampling Code
					$sampling->code = $this->generateSamplingCode($laboratory->code, $speciment->code, $sampling->id);
					$sampling->save();

					array_push($speciments, $speciment->id);
				}

				foreach($package->services as $service)
				{
					if(in_array($service->speciment_id, $speciments))
					{
						$sampling = Sampling::where('laboratory_id','=',$laboratory->id)
											->where('speciment_id','=',$service->speciment_id)->first();

						//Create Examination Record
						$examination = new Examination;
						$examination->choice_id = $choice->id;
						$examination->service_id = $service->id;
						$examination->sampling_id = $sampling->id;
						$examination->save();

						//Create Examination Parameters using Attach
						foreach ($service->parameters as $parameter)
						{
							$normal = Normal::where('parameter_id','=',$parameter->id)->first();

							if(count($normal)) {

								$result = new Result;
								$result->examination_id = $examination->id;
								$result->parameter_id = $parameter->id;
								$result->result = '';
								$result->normal = $normal->normal;
								$result->regulation = $normal->regulation->name;
								$result->method = $normal->method->name;
								$result->save();

							}

						}
					}
				}
			}
		}

		if(count($services) > 0)
		{
			$servicesLength = count($services);

			for($i = 0; $i < $servicesLength; $i++)
			{
				$service = Service::with('parameters')->find($services[$i]);

				//Store Choice Record
				$choice = new Choice;
				$choice->laboratory_id = $laboratory->id;
				$choice->examinable_type = 'Service';
				$choice->examinable_id = $service->id;
				$choice->save();

				if(!in_array($service->speciment_id, $speciments)) array_push($speciments, $service->speciment_id);
			}

			array_unique($speciments);
			$specimentsLength = count($speciments);

			for($i = 0; $i < $specimentsLength; $i++)
			{
				$speciment = Speciment::find($speciments[$i]);

				//Create Sampling Record
				$sampling = new Sampling;
				$sampling->laboratory_id = $laboratory->id;
				$sampling->speciment_id = $speciment->id;
				if($speciment->id > 1):
					$sampling->name = $speciment->name;
				else:
					$sampling->name = '';
				endif;
				$sampling->save();

				//Generate Sampling Code
				$sampling->code = $this->generateSamplingCode($laboratory->code, $sampling->speciment_id, $sampling->id);
				$sampling->save();
			}


			$choices = Choice::where('laboratory_id','=',$laboratory->id)->where('examinable_type','=','Service')->get();

			foreach ($choices as $choice)
			{
				$service = Service::with('parameters')->find($choice->examinable_id);

				for($i=0;$i<$specimentsLength; $i++)
				{
					if(in_array($service->speciment_id, $speciments))
					{
						//Create Examination Record
						$examination = new Examination;
						$examination->choice_id = $choice->id;
						$examination->service_id = $service->id;
						$examination->sampling_id = $sampling->id;
						$examination->save();

						//Create Examination Parameters using Attach
						foreach ($service->parameters as $parameter)
						{
							$result = new Result;
							$result->examination_id = $examination->id;
							$result->parameter_id = $parameter->id;
							$result->result = '';
							$result->normal = $parameter->normal;
							$result->regulation = $parameter->regulation->name;
							$result->method = $parameter->method->name;
							$result->save();
						}
					}
				}
			}
		}


		/**
		 * Prepare for Payment
		 * payment_type == 1 is Cash Payment
		 * payment_type == 2 is Receivables / Invoice
		 * payment_type == 3 is Insurance
		 */
		$payment_type = Input::get('payments');
		$financer_id = Input::get('financer_id');
		$costs = Input::get('costs');
		$fee = Input::get('fee');
		$tax = Input::get('tax');
		$total = Input::get('total');
		$dp = Input::get('downpayment');
		$balance = $total - $dp;


		if($payment_type == 1){

			// Store Earning for Cash Payment
			$earning 					= new Earning;
			$earning->earnable_type		= 'Laboratory';
			$earning->earnable_id		= $laboratory->id;
			$earning->earning_date		= date('Y-m-d');
			$earning->costs 			= $costs;
			$earning->fee 				= $fee;
			$earning->tax 				= $tax;
			$earning->total 			= $total;
			$earning->save();

			// Generate Earning Code
			$earning->code = $this->generateEarningCode($earning->id);
			$earning->save();

		}else if($payment_type == 2){

			// Store Invoice for Patient/Office
			$invoice 					= new Invoice;
			$invoice->laboratory_id		= $laboratory->id;
			$invoice->financer_type		= $registrant_type;
			$invoice->financer_id		= $registrant_id;
			$invoice->costs 			= $costs;
			$invoice->fee 				= $fee;
			$invoice->tax 				= $tax;
			$invoice->total 			= $total;
			$invoice->balance 			= $balance;
			$invoice->guarantor_name 	= Input::get('guarantor_name');
			$invoice->guarantor_id_card 	= Input::get('guarantor_id_card');
			$invoice->guarantor_id_address 	= Input::get('guarantor_id_address');
			$invoice->guarantor_address 	= Input::get('guarantor_address');
			$invoice->guarantor_contact 	= Input::get('guarantor_contact');
			$invoice->save();

			// Generate Invoice Code
			$invoice->code 				= $this->generateInvoiceCode($invoice->id);
			$invoice->save();

			if($dp > 0) {
				// Store Earning for Cash Payment
				$earning 					= new Earning;
				$earning->earnable_type		= 'Laboratory';
				$earning->earnable_id		= $laboratory->id;
				$earning->earning_date		= date('Y-m-d');
				$earning->costs 			= $dp;
				$earning->fee 				= 0;
				$earning->tax 				= 0;
				$earning->total 			= $dp;
				$earning->save();

				// Generate Earning Code
				$earning->code = $this->generateEarningCode($earning->id);
				$earning->save();
			}

		}else if($payment_type == 3){

			// Store Invoice for Financer
			$invoice 					= new Invoice;
			$invoice->laboratory_id		= $laboratory->id;
			$invoice->financer_type		= 'Financer';
			$invoice->financer_id		= $financer_id;
			$invoice->insurance_id		= Input::get('insurance_id');
			$invoice->costs 			= $costs;
			$invoice->fee 				= $fee;
			$invoice->tax 				= $tax;
			$invoice->total 			= $total;
			$invoice->save();

			// Generate Invoice Code
			$invoice->code 				= $this->generateInvoiceCode($invoice->id);
			$invoice->save();

			if($registrant_type == 'Patient'){

				$insurances = Insurance::where('patient_id','=',$registrant_id)
								->where('code','=',Input::get('insurance_id'))->count();

				if($insurances == 0){

					$patient = Patient::find($registrant_id);

					$patient->insurances()->attach($financer_id, array('code' => Input::get('insurance_id')));

				}

			}
		}

		if(isset($earning)){
			$earning_id = $earning->id;
		}else{
			$earning_id = 0;
		}

		if(isset($invoice)){
			$invoice_id = $invoice->id;
		}else{
			$invoice_id = 0;
		}

		return Response::json(array('status' => 'Succeed','id' => $laboratory->id, 'code' => $laboratory->code,
									'earning_id' => $earning_id, 'invoice_id' => $invoice_id));
	}

	private function generateCode($registration_id)
	{
		$year = date('Y');
		$month = date('m');

		$code = 'LAB'.substr($year, 2, 2).$month.str_pad($registration_id, 5, "0", STR_PAD_LEFT);

		return $code;
	}

	private function generateSamplingCode($lab,$code,$id)
	{
		$year = date('Y');
		$month = date('m');

		$sampling_code = substr($year, 2, 2).$month.str_pad($id, 5, "0", STR_PAD_LEFT);

		return $sampling_code;
	}

	private function generateEarningCode($id)
	{
		$year = date('Y');
		$month = date('m');

		$earning_code = 'E'.substr($year, 2, 2).$month.str_pad($id, 5, "0", STR_PAD_LEFT);

		return $earning_code;
	}

	private function generateInvoiceCode($id)
	{
		$year = date('Y');
		$month = date('m');

		$invoice_code = 'I'.substr($year, 2, 2).$month.str_pad($id, 5, "0", STR_PAD_LEFT);

		return $invoice_code;
	}

	public function destroy($id)
	{
		$choices = Choice::where('laboratory_id','=',$id)->get();

		foreach($choices as $choice) {

			$examinations = Examination::where('choice_id','=',$choice->id)->get();

			foreach($examinations as $examination){
				Result::where('examination_id','=',$examination->id)->delete();
			}

			Examination::where('choice_id','=',$choice->id)->delete();

		}

		Choice::where('laboratory_id','=',$id)->delete();

		Sampling::where('laboratory_id','=',$id)->delete();

		Earning::where('earnable_type','=','Laboratory')->where('earnable_id','=',$id)->delete();

		Invoice::where('laboratory_id','=',$id)->delete();

		Laboratory::destroy($id);

		Session::flash('message','Sukses menghapus Data Lab beserta informasi-informasi yang berkaitan!');
	}


	//create new patient
	private function generatePatientCode($id)
	{
		return 'P'.date('y').'-'.date('m').$id;
	}

	public function storePatient()
	{
		$patient = New Patient;

		$patient->name = Input::get('name');
		$patient->sex = Input::get('sex');
		$patient->birthdate = date('Y-m-d', strtotime(Input::get('birthdate')));
		$patient->address = Input::get('address');
		$patient->phone = Input::get('phone');
		$patient->city_id = Input::get('city_id');
		$patient->save();

		//Generate Patient Code
		$patient->code = $this->generatePatientCode($patient->id);
		$patient->save();

		return Response::json($patient);
	}

	public function storeOffice()
	{
		$office = new Office;

		$office->name = Input::get('name');
		$office->address = Input::get('address');
		$office->phone = Input::get('phone');
		$office->fax = Input::get('fax');
		$office->save();

		return Response::json($office);
	}

}
