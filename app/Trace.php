<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Trace extends Model {

	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'traces';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'email_id', 'user_id', 'start', 'finish', 'description',
                           'is_active'];

    static function getValidationRules() {
        return array(
            'email_id' => 'required|exists:emails,id',
            'user_id' => 'required|exists:users,id',
            'title' => 'required|min:6',
			'start' => 'required|date_format:d-m-Y H:i|after:yesterday',
			'finish' => 'required|date_format:d-m-Y H:i|after:yesterday',
            'description' => 'required',
        );
    }

    static function checkActive() {
        $traces = Trace::where('is_active', 1)->get();
        $now = Carbon::now();
        foreach($traces as $trace){
            $tempe = Carbon::createFromFormat('Y-m-d H:i:s', $trace->finish);
            if($tempe->lt($now)){
                $trace->is_active = false;
                $trace->save();
            }
        }
    }

}
