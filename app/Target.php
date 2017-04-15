<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Target extends Model {

	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'targets';

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
    protected $fillable = ['title', 'trace_id', 'coordinate'];

    static function getValidationRules() {
        return array(
            'trace_id' => 'required|exists:traces,id',
            'title' => 'required|min:3',
            'coordinate' => 'required|numeric|min:1'
        );
    }

}
