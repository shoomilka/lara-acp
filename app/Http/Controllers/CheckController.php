<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;
use App\Check;
use App\Target;

use App\Email;
use Carbon\Carbon;

use Validator;
use Redirect;
use Session;

class CheckController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$targets = Target::all()->lists('title', 'id');
		$checks = Check::where('target_id', 0)->paginate(25);
		return view('check.index', compact(array('checks', 'targets')));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$targets = Target::all()->lists('title', 'id');
		return view('check.create', compact('targets'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$requestData = $request->all();

        $validator = Validator::make($requestData, Check::getValidationRules());
        if ($validator->fails()) {
            return redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

		$requestData['time'] .= ':00';
		$requestData['checked'] = true;

        Check::create($requestData);

        Session::flash('flash_message', 'Check added!');

		return redirect('check');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$requestData = $request->all();
		$check = Check::find($id);
		$check->target_id = $requestData['target_id'];
		$check->checked = true;
		$check->save();
		return redirect('check');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function updateAll(){
		$emails = Email::all();
		foreach($emails as $email){
			$traces = $email->hasMany('App\Trace', 'email_id')
							->where('finish', '>', Carbon::now())->get();
			if($traces->count() > 0) $email->receiveLetters();
		}
		echo 'finish';
	}

}
