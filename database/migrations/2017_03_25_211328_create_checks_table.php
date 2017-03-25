<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('checks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('phone');
			$table->dateTime('time');
			$table->boolean('ckecked')->default(false);

			$table->integer('target_id')->unsigned();
			$table->foreign('target_id')->references('id')->on('targets');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('checks');
	}

}
