<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPacingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pacing', function(Blueprint $table)
		{
			//
			$table->dropColumn('schedule');
			$table->renameColumn('quantity', 'quota');
			$table->string('time_start');
			$table->string('time_end');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pacing', function(Blueprint $table)
		{
			//
		});
	}

}
