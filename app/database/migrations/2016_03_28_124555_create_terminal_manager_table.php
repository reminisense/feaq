<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTerminalManagerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('terminal_manager', function(Blueprint $table)
		{
			$table->increments('login_id');
			$table->integer('user_id')->default(0);
			$table->integer('terminal_id')->default(0);
			$table->integer('in_out')->default(0);
			$table->timestamp('time_in_out')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('terminal_manager');
	}

}
