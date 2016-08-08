<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQueueAnalyticsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('queue_analytics', function(Blueprint $table)
		{
			$table->integer('transaction_number')->default(0);
			$table->integer('date')->default(0);
			$table->integer('business_id')->default(0);
			$table->integer('branch_id')->default(0);
			$table->integer('service_id')->default(0);
			$table->integer('terminal_id')->default(0);
			$table->integer('user_id')->default(0);
			$table->integer('action')->default(0);
			$table->integer('action_time')->default(0);
			$table->string('queue_platform')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('queue_analytics');
	}

}
