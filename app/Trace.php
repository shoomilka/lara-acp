<?php namespace App;

use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['title', 'email_id', 'user_id', 'start', 'finish'];

    static function getValidationRules() {
        return array(
            'email_id' => 'required|exists:emails,id',
            'user_id' => 'required|exists:users,id',
            'title' => 'required|min:6',
			'start' => 'required|date_format:d-m-Y H:i|after:yesterday',
			'finish' => 'required|date_format:d-m-Y H:i|after:yesterday',
        );
    }

}
