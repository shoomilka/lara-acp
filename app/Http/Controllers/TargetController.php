<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Target;
use App\Trace;
use Auth;
use Validator;
use Redirect;
use Session;
use App\Check;

class TargetController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$targets = Target::paginate(25);

        return view('target.index', compact('targets'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$traces = Trace::where('user_id', '=', Auth::id())->lists('title', 'id');
		return view('target.create', compact('traces'));
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

        $validator = Validator::make($requestData, Target::getValidationRules());
        if ($validator->fails()) {
            return redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        Target::create($requestData);

        Session::flash('flash_message', 'Target added!');

        return redirect('target');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$target = Target::find($id);
		$trace = Trace::find($target->trace_id);
		return view('target.show', compact(['target', 'trace']));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$target = Target::find($id);
		$traces = Trace::where('user_id', '=', Auth::id())->lists('title', 'id');
		return view('target.edit', compact(['target', 'traces']));
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

        $validator = Validator::make($requestData, Target::getValidationRules());
        if ($validator->fails()) {
            return redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

		$trace = Target::findOrFail($id);
        $trace->update($requestData);

        Session::flash('flash_message', 'Target added!');

        return redirect('target');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Check::where('target_id', '=', $id)->delete();
		
		Target::destroy($id);

        Session::flash('flash_message', 'Target deleted!');

        return redirect('target');
	}

}
