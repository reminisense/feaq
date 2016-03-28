<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTerminalHoursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('terminal_hours', function(Blueprint $table)
		{
			$table->increments('track_id');
			$table->integer('terminal_id')->default(0);
			$table->integer('date')->default(0);
			$table->integer('time_open')->default(0);
			$table->integer('time_close')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('terminal_hours');
	}

}
