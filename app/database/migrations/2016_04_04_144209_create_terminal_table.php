<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTerminalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('terminal', function(Blueprint $table)
		{
			$table->increments('terminal_id');
			$table->string('name')->default('');
			$table->string('code')->default('');
			$table->integer('service_id')->default(0);
			$table->integer('status')->default(1);
			$table->timestamp('time_created')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('box_rank')->default(0);
			$table->string('color')->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('terminal');
	}

}
