<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeanServingTimeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mean_serving_time', function(Blueprint $table)
		{
			$table->integer('service_id');
			$table->float('mean_today');
			$table->float('mean_yesterday');
			$table->float('mean_three_days');
			$table->float('mean_this_week');
			$table->float('mean_last_week');
			$table->float('mean_this_month');
			$table->float('mean_last_month');
			$table->integer('mean_most_likely');
			$table->integer('mean_most_optimistic');
			$table->integer('mean_most_pessimistic');
			$table->integer('weight_today');
			$table->integer('weight_yesterday');
			$table->integer('weight_three_days');
			$table->integer('weight_this_week');
			$table->integer('weight_last_week');
			$table->integer('weight_this_month');
			$table->integer('weight_last_month');
			$table->integer('weight_most_likely');
			$table->integer('weight_most_optimistic');
			$table->integer('weight_most_pessimistic');
			$table->string('last_changed');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mean_serving_time');
	}

}
