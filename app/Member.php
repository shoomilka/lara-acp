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
    protected $fillable = ['name', 'phone', 'user_id'];

    static function getValidationRules() {
        return array(
            'user_id' => 'required|exists:users,id',
            'name' => 'required|min:3',
			'phone' => 'required|regex:/(\d\d\d\d\d\d\d\d\d\d)/',
        );
    }

}
