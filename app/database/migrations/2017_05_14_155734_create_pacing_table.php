<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pacing', function(Blueprint $table)
		{
			$table->increments('pacing_id');
			$table->integer('service_id')->default(0);
			$table->integer('schedule')->default(0);
			$table->integer('quantity')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pacing');
	}

}
