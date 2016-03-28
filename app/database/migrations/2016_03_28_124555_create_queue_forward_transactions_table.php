<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQueueForwardTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('queue_forward_transactions', function(Blueprint $table)
		{
			$table->increments('forward_id');
			$table->integer('forwarder_transaction_id');
			$table->integer('forwarder_service_id');
			$table->integer('forwarder_terminal_id');
			$table->integer('forwarder_user_id');
			$table->integer('transaction_id');
			$table->integer('service_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('queue_forward_transactions');
	}

}
