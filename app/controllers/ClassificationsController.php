<?php

class ClassificationsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Classifications Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function index()
	{
		$classifications = Classification::where('parent_id','=',0)->get();
		$menu = 'service';

		return View::make('services/index', compact('classifications','menu'));
	}

	public function show($id)
	{
		$classification = Classification::find($id);
		$classifications = Classification::with('services')->where('parent_id','=',$id)->get();
		$services = Service::where('classification_id','=',$id)->get();
		$speciments = Speciment::all();
		$menu = 'service';

		return View::make('classification/show', compact('classifications','classification','speciments','menu'));
	}

	public function store()
	{
		$classification = new Classification;

		$classification->parent_id = Input::get('parent_id');
		$classification->name = Input::get('name');
		$classification->save();

		$this->generateClassificationCode($classification->id);

		Session::flash('message','Sukses menambahkan Klasifikasi');
	}

	public function update($id)
	{
		$classification = Classification::find($id);

		$classification->name = Input::get('name');
		$classification->save();

		Session::flash('message','Sukses mengupdate Klasifikasi');
	}

	public function destroy($id)
	{
		$classification = Classification::find($id);

		$classification->delete();

		Session::flash('message','Sukses menghapus Klasifikasi');
	}

	private function generateClassificationCode($classification_id)
	{
		$classification = Classification::find($classification_id);

		if($classification->parent_id > 0)
		{
			$parent = Classification::find($classification->parent_id);

			$counter = Classification::where('parent_id','=',$classification->parent_id)->count();

			switch ($counter) {
				case 1:
					$code = $parent->code.'A';
					break;
				case 2:
					$code = $parent->code.'B';
					break;
				case 3:
					$code = $parent->code.'C';
					break;
				case 4:
					$code = $parent->code.'D';
					break;
				case 5:
					$code = $parent->code.'E';
					break;
				case 6:
					$code = $parent->code.'F';
					break;
				case 7:
					$code = $parent->code.'G';
					break;
				case 8:
					$code = $parent->code.'H';
					break;
				case 9:
					$code = $parent->code.'I';
					break;
				case 10:
					$code = $parent->code.'J';
					break;
				case 11:
					$code = $parent->code.'K';
					break;
				case 12:
					$code = $parent->code.'L';
					break;
				case 13:
					$code = $parent->code.'M';
					break;
				case 14:
					$code = $parent->code.'N';
					break;
				case 15:
					$code = $parent->code.'O';
					break;
				case 16:
					$code = $parent->code.'P';
					break;
				case 17:
					$code = $parent->code.'Q';
					break;
				case 18:
					$code = $parent->code.'R';
					break;
				case 19:
					$code = $parent->code.'S';
					break;
				case 20:
					$code = $parent->code.'T';
					break;
				case 21:
					$code = $parent->code.'U';
					break;
				case 22:
					$code = $parent->code.'V';
					break;
				case 23:
					$code = $parent->code.'W';
					break;
				case 24:
					$code = $parent->code.'X';
					break;
				case 25:
					$code = $parent->code.'Y';
					break;
				case 26:
					$code = $parent->code.'Z';
					break;
			}
		}
		else
		{
			switch($classification_id){
				case 1:
					$code = 'I';
					break;
				case 2:
					$code = 'II';
					break;
				case 3:
					$code = 'III';
					break;
				case 4:
					$code = 'IV';
					break;
				case 5:
					$code = 'V';
					break;
				case 6:
					$code = 'VI';
					break;
				case 7:
					$code = 'VII';
					break;
				case 8:
					$code = 'VIII';
					break;
				case 9:
					$code = 'IX';
					break;
				case 10:
					$code = 'X';
					break;
				case 11:
					$code = 'XI';
					break;
				case 12:
					$code = 'XII';
					break;
				case 13:
					$code = 'XIII';
					break;
				case 14:
					$code = 'XIV';
					break;
				case 15:
					$code = 'XV';
					break;
			}
		}

		$classification->code = $code;
		$classification->save();

		/*
		$class_count = Classification::where('installation_id','=',$installation_id)->count();
		$class_count += 1;

		return str_pad($installation_id,2,"0",STR_PAD_LEFT).str_pad($class_count, 2, "0", STR_PAD_LEFT);
		*/
	}

}