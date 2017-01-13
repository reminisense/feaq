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
			$table->integer('service_id')->default(0);
			$table->float('mean_today')->default(0);
			$table->float('mean_yesterday')->default(0);
			$table->float('mean_three_days')->default(0);
			$table->float('mean_this_week')->default(0);
			$table->float('mean_last_week')->default(0);
			$table->float('mean_this_month')->default(0);
			$table->float('mean_last_month')->default(0);
			$table->integer('mean_most_likely')->default(0);
			$table->integer('mean_most_optimistic')->default(0);
			$table->integer('mean_most_pessimistic')->default(0);
			$table->integer('weight_today')->default(1);
			$table->integer('weight_yesterday')->default(1);
			$table->integer('weight_three_days')->default(1);
			$table->integer('weight_this_week')->default(1);
			$table->integer('weight_last_week')->default(1);
			$table->integer('weight_this_month')->default(1);
			$table->integer('weight_last_month')->default(1);
			$table->integer('weight_most_likely')->default(0);
			$table->integer('weight_most_optimistic')->default(0);
			$table->integer('weight_most_pessimistic')->default(0);
			$table->float('final_mean')->default(0);
			$table->string('last_changed')->default('');
			$table->primary('service_id');
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
