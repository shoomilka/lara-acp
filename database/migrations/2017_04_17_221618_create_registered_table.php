<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisteredTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registered', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('member_id')->references('id')->on('members');
			$table->integer('trace_id')->references('id')->on('traces');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('registered');
	}

}
