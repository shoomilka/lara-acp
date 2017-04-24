<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model {

	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'members';

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
    protected $fillable = ['name', 'phone', 'user_id', 'city', 'year', 'cycle', 'nick'];

    protected $dates = ['created_at', 'updated_at'];

    static function getValidationRules() {
        return array(
            'user_id' => 'required|exists:users,id',
            'name' => 'required|min:3',
			'phone' => 'required|regex:/(\d\d\d\d\d\d\d\d\d\d)/',
            'city' => 'required|max:50',
            'year' => 'required|numeric|min:1900',
            'cycle' => 'max:50',
            'nick' => 'max:50',
        );
    }

}
