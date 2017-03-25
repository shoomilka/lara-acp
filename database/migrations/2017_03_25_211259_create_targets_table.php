<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('targets', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('trace_id')->unsigned();
			$table->foreign('trace_id')->references('id')->on('traces');

			$table->string('title');
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
		Schema::drop('targets');
	}

}
