<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model {

	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'checks';

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
    protected $fillable = ['time', 'phone', 'checked', 'target_id', 'target_title'];

    protected $dates = ['created_at', 'updated_at', 'time'];

    static function getValidationRules() {
        return array(
            'time' => 'required|date_format:Y-m-d H:i',
			'phone' => 'required|regex:/(\d\d\d\d\d\d\d\d\d\d)/',
            'target_id' => 'required',
        );
    }
}
