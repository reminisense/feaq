<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePriorityNumberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('priority_number', function(Blueprint $table)
		{
			$table->increments('track_id');
			$table->integer('date')->default(0);
			$table->integer('service_id')->default(0);
			$table->integer('number_start')->default(0);
			$table->integer('number_limit')->default(0);
			$table->integer('last_number_given')->default(0);
			$table->integer('current_number')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('priority_number');
	}

}
