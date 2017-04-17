<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimesToTargetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('targets', function(Blueprint $table)
		{
			$table->dateTime('start')->default('0000-00-00 00:00:00');
			$table->dateTime('finish')->default('0000-00-00 00:00:00');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tagrets', function(Blueprint $table)
		{
			$table->dropColumn(['start', 'finish']);
		});
	}

}
