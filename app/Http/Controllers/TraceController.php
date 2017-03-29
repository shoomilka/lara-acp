<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Trace;
use App\Email;
use Auth;

use Validator;
use Redirect;
use Session;

use Carbon\Carbon;

use App\Target;

class TraceController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$traces = Trace::paginate(25);

        return view('trace.index', compact('traces'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$emails = Email::where('user_id', '=', Auth::id())->lists('email', 'id');

		return view('trace.create', compact('emails'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		
        $requestData = $request->all();
        
		$requestData['user_id'] = Auth::id();

        $validator = Validator::make($requestData, Trace::getValidationRules());
        if ($validator->fails()) {
            return redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

		$requestData['start'] = Carbon::createFromFormat('d-m-Y H', $requestData['start'])->toDateTimeString();
		$requestData['finish'] = Carbon::createFromFormat('d-m-Y H', $requestData['finish'])->toDateTimeString();

        Trace::create($requestData);

        Session::flash('flash_message', 'Trace added!');

        return redirect('trace');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$trace = Trace::find($id);
		$email = Email::find($trace->email_id);
		return view('trace.show', compact(['trace', 'email']));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$trace = Trace::find($id);
		$emails = Email::where('user_id', '=', Auth::id())->lists('email', 'id');
		return view('trace.edit', compact(['trace', 'emails']));
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
        
		$requestData['user_id'] = Auth::id();

        $validator = Validator::make($requestData, Trace::getValidationRules());
        if ($validator->fails()) {
            return redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

		$requestData['start'] = Carbon::createFromFormat('d-m-Y H', $requestData['start'])->toDateTimeString();
		$requestData['finish'] = Carbon::createFromFormat('d-m-Y H', $requestData['finish'])->toDateTimeString();

        $trace = Trace::findOrFail($id);
        $trace->update($requestData);

        Session::flash('flash_message', 'Trace added!');

        return redirect('trace');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Target::where('trace_id', '=', $id)->delete();
		Trace::destroy($id);

        Session::flash('flash_message', 'Trace deleted!');

        return redirect('trace');
	}

}
