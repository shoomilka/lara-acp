<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixCkeckedInChecksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('checks', function(Blueprint $table)
		{
			$table->dropColumn('ckecked');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('checks', function(Blueprint $table)
		{
			$table->boolean('ckecked')->default(false);
		});
	}

}
