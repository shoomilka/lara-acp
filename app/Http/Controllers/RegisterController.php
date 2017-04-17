<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Trace;
//use App\Member;
use App\Registered;
use Redirect;

class RegisterController extends Controller {

	public function __construct()
	{
        //
	}

	public function register($id, Request $request){
        $requestData = $request->all();
        $register = array();
		$register['trace_id'] = $id;
		$register['member_id'] = $requestData['member_id'];
        Registered::create($register);
        return redirect()->action('TraceController@show', ['id' => $id]);
    }

    public function unregister($trace_id, $member_id){
        Registered::where('member_id', $member_id)
                  ->where('trace_id', $trace_id)->delete();
        return redirect()->action('TraceController@show', ['id' => $trace_id]);
    }
}
