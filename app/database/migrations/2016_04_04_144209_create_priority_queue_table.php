<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePriorityQueueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('priority_queue', function(Blueprint $table)
		{
			$table->increments('transaction_number');
			$table->string('priority_number')->default('0');
			$table->integer('track_id')->default(0);
			$table->string('confirmation_code')->default('0');
			$table->integer('user_id')->default(0);
			$table->string('queue_platform')->default('web');
			$table->string('name')->nullable();
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('priority_queue');
	}

}
