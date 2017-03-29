<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model {

	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'emails';

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
    protected $fillable = ['email', 'pass', 'user_id', 'pop3'];

    static function getValidationRules() {
        return array(
            'email' => 'required|email',
            'user_id' => 'required|exists:users,id',
            'pass' => 'required|min:6',
            'pop3' => 'required'
        );
    }

}
