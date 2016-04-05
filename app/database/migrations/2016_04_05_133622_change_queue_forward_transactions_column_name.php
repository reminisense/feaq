<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeQueueForwardTransactionsColumnName extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('queue_forward_transactions', function($table){
			$table->renameColumn('forwarder_transaction_id', 'forwarder_transaction_number');
			$table->renameColumn('transaction_id', 'transaction_number');
			$table->string('forwarded_priority_number');
			$table->string('priority_number');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('queue_forward_transactions', function($table){
			$table->renameColumn('forwarder_transaction_number', 'forwarder_transaction_id');
			$table->renameColumn('transaction_number', 'transaction_id');
			$table->dropCoumn(array('forwarded_priority_number', 'priority_number'));
		});
	}

}
