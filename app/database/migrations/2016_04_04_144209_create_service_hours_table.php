<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceHoursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_hours', function(Blueprint $table)
		{
			$table->increments('track_id');
			$table->integer('service_id')->default(0);
			$table->integer('date')->default(0);
			$table->string('day_week')->default('');
			$table->integer('open_hour')->default(0);
			$table->integer('open_minute')->default(0);
			$table->string('open_ampm')->default('');
			$table->integer('close_hour')->default(0);
			$table->integer('close_minute')->default(0);
			$table->string('close_ampm')->default('');
			$table->integer('queue_hour')->default(0);
			$table->integer('queue_minute')->default(0);
			$table->string('queue_ampm')->default('');
			$table->integer('cutoff_hour')->default(0);
			$table->integer('cutoff_minute')->default(0);
			$table->string('cutoff_ampm')->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('service_hours');
	}

}
