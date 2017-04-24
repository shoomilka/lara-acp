<?php namespace App\Http\Controllers;

use App\Trace;
use App\Check;
use App\Member;
use App\Registered;
use Carbon\Carbon;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->traces();
		return view('welcome');
	}

	public function traces(){
		$traces = Trace::orderBy('id', 'DESC')->paginate(25);
		return view('traces', compact('traces'));
	}

	public function trace($id){
		$trace = Trace::find($id);
		$checks = Check::where('checked', true)->get();
		$registered = Registered::where('trace_id', $id)->get()->lists('member_id');
		$members = Member::whereIn('id', $registered)->get();
		$targets = $trace->hasMany('App\Target')->orderBy('coordinate')->get();
		Carbon::now()->gt($trace->finish) ? $are_results = true : $are_results = false;
		return view('trace', compact(array('checks', 'members', 'targets', 'trace', 'are_results')));
	}
}
