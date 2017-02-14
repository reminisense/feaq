<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueueStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('queue_status', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('service_id')->default(0);
			$table->string('punch_type')->default('');
			$table->string('punch_time')->default('');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('queue_status');
	}

}
