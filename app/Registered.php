<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Registered extends Model {

	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'registered';

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
    protected $fillable = ['member_id', 'trace_id'];

}
