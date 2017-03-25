<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('traces', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('title');

			$table->integer('email_id')->unsigned();
			$table->foreign('email_id')->references('id')->on('emails');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');

			$table->dateTime('start');
			$table->dateTime('finish');

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
		Schema::drop('traces');
	}

}
