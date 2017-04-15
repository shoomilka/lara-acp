<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoordinateToTargetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('targets', function(Blueprint $table)
		{
			$table->float('coordinate', 5, 2)->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('targets', function(Blueprint $table)
		{
			$table->dropColumn('coordinate');
		});
	}

}
