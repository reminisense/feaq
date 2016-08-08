<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWatchdogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('watchdog', function(Blueprint $table)
		{
			$table->integer('log_id', true);
			$table->integer('user_id');
			$table->string('action_type')->default('');
			$table->text('value');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('watchdog');
	}

}
