<?php

class ReportsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Results Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index($pages)
	{
		switch ($pages) {
			case 'laboratorium':
				return View::make('reports/laboratories/index')->with('menu','report');
				break;

			case 'keuangan':
				return View::make('reports/financial/index')->with('menu','report');
				break;
		}
	}


	public function examinations()
	{
		$laboratories = Laboratory::paginate(10);
		return View::make('reports/laboratories/examinations')->with('laboratories',$laboratories)->with('menu','report');
	}

	public function examinationsFilter()
	{
		$periods = explode(" - ", Input::get('periods'));

		$from = $periods[0];
		$to = $periods[1];

		$laboratories = Laboratory::whereBetween(DB::raw('date(registrationtime)'),array($from,$to))->paginate(10);

		return View::make('reports/laboratories/examinationsfilter')
					->with('laboratories',$laboratories)
					->with('from', $from)
					->with('to', $to)
					->with('menu','report');
	}

	public function examinationsRecap()
	{
		$laboratories = Laboratory::all();
		return View::make('reports/laboratories/examinationsrecap')->with('menu','report');
	}

	public function examinationsRecapFilter()
	{
		$periods = explode(" - ", Input::get('periods'));

		$from = $periods[0];
		$to = $periods[1];

		$laboratories = Laboratory::whereBetween(DB::raw('date(registrationtime)'),array($from,$to))->get();
		return View::make('reports/laboratories/examinationsrecapfilter')
					->with('laboratories',$laboratories)
					->with('from', $from)
					->with('to', $to)
					->with('menu','report');
	}


	public function patients()
	{
		$laboratories = Laboratory::where('registrant_type','=','Patient')->paginate(10);
		return View::make('reports/laboratories/patients')->with('laboratories',$laboratories)->with('menu','report');
	}

	public function patientsFilter()
	{
		$periods = explode(" - ", Input::get('periods'));

		$from = $periods[0];
		$to = $periods[1];

		$laboratories = Laboratory::where('registrant_type','=','Patient')
						->whereBetween(DB::raw('date(registrationtime)'),array($from,$to))->paginate(10);
		return View::make('reports/laboratories/patientsfilter')
					->with('laboratories',$laboratories)
					->with('from', $from)
					->with('to', $to)
					->with('menu','report');
	}

	public function patientsRecap()
	{
		$laboratories = Laboratory::where('registrant_type','=','Patient')->get();
		return View::make('reports/laboratories/patientsrecap')->with('laboratories',$laboratories)->with('menu','report');
	}

	public function patientsRecapFilter()
	{
		$periods = explode(" - ", Input::get('periods'));

		$from = $periods[0];
		$to = $periods[1];

		$laboratories = Laboratory::where('registrant_type','=','Patient')
						->whereBetween(DB::raw('date(registrationtime)'),array($from,$to))->get();
		return View::make('reports/laboratories/patientsrecapfilter')
					->with('laboratories',$laboratories)
					->with('from', $from)
					->with('to', $to)
					->with('menu','report');
	}

	

	public function offices()
	{
		$laboratories = Laboratory::where('registrant_type','=','Office')->paginate(10);
		return View::make('reports/laboratories/offices')->with('laboratories',$laboratories)->with('menu','report');
	}

	public function officesFilter()
	{
		$periods = explode(" - ", Input::get('periods'));

		$from = $periods[0];
		$to = $periods[1];

		$laboratories = Laboratory::where('registrant_type','=','Office')
						->whereBetween(DB::raw('date(registrationtime)'),array($from,$to))->paginate(10);
		return View::make('reports/laboratories/officesfilter')
					->with('laboratories',$laboratories)
					->with('from', $from)
					->with('to', $to)
					->with('menu','report');
	}

	public function officesRecap()
	{
		$laboratories = Laboratory::where('registrant_type','=','Office')->get();
		return View::make('reports/laboratories/officesrecap')->with('laboratories',$laboratories)->with('menu','report');
	}

	public function officesRecapFilter()
	{
		$periods = explode(" - ", Input::get('periods'));

		$from = $periods[0];
		$to = $periods[1];

		$laboratories = Laboratory::where('registrant_type','=','Office')
						->whereBetween(DB::raw('date(registrationtime)'),array($from,$to))->get();
		return View::make('reports/laboratories/officesrecapfilter')
					->with('laboratories',$laboratories)
					->with('from', $from)
					->with('to', $to)
					->with('menu','report');
	}



	
	public function samplings()
	{
		$samplings = Sampling::where('taken','=',1)->paginate(10);
		return View::make('reports/laboratories/samplings')->with('samplings',$samplings)->with('menu','report');
	}

	public function samplingsFilter()
	{
		$periods = explode(" - ", Input::get('periods'));

		$from = $periods[0];
		$to = $periods[1];

		$samplings = Sampling::where('taken','=',1)->whereBetween(DB::raw('date(takentime)'),array($from,$to))->paginate(10);
		return View::make('reports/laboratories/samplingsfilter')
					->with('samplings',$samplings)
					->with('from', $from)
					->with('to', $to)
					->with('menu','report');
	}

	public function samplingsRecap()
	{
		$laboratories = Laboratory::all();
		return View::make('reports/laboratories/samplingsrecap')->with('laboratories',$laboratories)->with('menu','report');
	}

	public function samplingsRecapFilter()
	{
		$periods = explode(" - ", Input::get('periods'));

		$from = $periods[0];
		$to = $periods[1];

		$laboratories = Laboratory::whereBetween(DB::raw('date(registrationtime)'),array($from,$to))->get();
		return View::make('reports/laboratories/samplingsrecapfilter')
					->with('laboratories',$laboratories)
					->with('from', $from)
					->with('to', $to)
					->with('menu','report');
	}


	
	public function patientsSampling()
	{
		$laboratories = Laboratory::where('registrant_type','=','Patient')->paginate(10);
		return View::make('reports/laboratories/patientssampling')->with('laboratories',$laboratories)->with('menu','report');
	}

	public function patientsSamplingFilter()
	{
		$periods = explode(" - ", Input::get('periods'));

		$from = $periods[0];
		$to = $periods[1];

		$laboratories = Laboratory::where('registrant_type','=','Patient')
						->whereBetween(DB::raw('date(registrationtime)'),array($from,$to))->paginate(10);
		return View::make('reports/laboratories/patientssamplingfilter')
					->with('laboratories',$laboratories)
					->with('from', $from)
					->with('to', $to)
					->with('menu','report');
	}

	public function patientsSamplingRecap()
	{
		$laboratories = Laboratory::where('registrant_type','=','Office')->get();
		return View::make('reports/laboratories/patientssamplingrecap')->with('laboratories',$laboratories)->with('menu','report');
	}

	public function patientsSamplingRecapFilter()
	{
		$periods = explode(" - ", Input::get('periods'));

		$from = $periods[0];
		$to = $periods[1];

		$laboratories = Laboratory::where('registrant_type','=','Patient')
						->whereBetween(DB::raw('date(registrationtime)'),array($from,$to))->get();
		return View::make('reports/laboratories/patientssamplingrecapfilter')
					->with('laboratories',$laboratories)
					->with('from', $from)
					->with('to', $to)
					->with('menu','report');
	}

	

	public function officesSampling()
	{
		$laboratories = Laboratory::where('registrant_type','=','Office')->paginate(10);
		return View::make('reports/laboratories/officessampling')->with('laboratories',$laboratories)->with('menu','report');
	}

	public function officesSamplingFilter()
	{
		$periods = explode(" - ", Input::get('periods'));

		$from = $periods[0];
		$to = $periods[1];

		$laboratories = Laboratory::where('registrant_type','=','Office')
						->whereBetween(DB::raw('date(registrationtime)'),array($from,$to))->paginate(10);
		return View::make('reports/laboratories/officessamplingfilter')
					->with('laboratories',$laboratories)
					->with('from', $from)
					->with('to', $to)
					->with('menu','report');
	}

	public function officesSamplingRecap()
	{
		$laboratories = Laboratory::where('registrant_type','=','Office')->get();
		return View::make('reports/laboratories/officessamplingrecap')->with('laboratories',$laboratories)->with('menu','report');
	}

	public function officesSamplingRecapFilter()
	{
		$periods = explode(" - ", Input::get('periods'));

		$from = $periods[0];
		$to = $periods[1];

		$laboratories = Laboratory::where('registrant_type','=','Office')
						->whereBetween(DB::raw('date(registrationtime)'),array($from,$to))->get();
		return View::make('reports/laboratories/officessamplingrecapfilter')
					->with('laboratories',$laboratories)
					->with('from', $from)
					->with('to', $to)
					->with('menu','report');
	}


}