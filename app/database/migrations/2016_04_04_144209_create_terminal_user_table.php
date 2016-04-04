<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTerminalUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('terminal_user', function(Blueprint $table)
		{
			$table->integer('terminal_user_id', true);
			$table->integer('user_id')->default(0);
			$table->integer('terminal_id')->default(0);
			$table->boolean('status')->default(0);
			$table->integer('date')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('terminal_user');
	}

}
