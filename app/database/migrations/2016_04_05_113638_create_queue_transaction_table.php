<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQueueTransactionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('queue_transaction', function(Blueprint $table)
		{
			$table->integer('transaction_number')->default(0)->primary();
			$table->integer('date')->default(0);
			$table->integer('user_id')->default(0);
			$table->integer('terminal_id')->default(0);
			$table->integer('service_id')->default(0);
			$table->integer('branch_id')->default(0);
			$table->integer('business_id')->default(0);
			$table->integer('time_queued')->default(0);
			$table->integer('time_called')->default(0);
			$table->integer('time_completed')->default(0);
			$table->integer('time_removed')->default(0);
			$table->integer('time_assigned')->default(0);
			$table->integer('time_checked_in')->default(0);
			$table->integer('last_number_given')->default(0);
			$table->integer('current_number')->default(0);
			$table->string('priority_number')->default('0');
			$table->string('confirmation_code')->default('0');
			$table->string('queue_platform')->default('web');
			$table->string('name')->nullable();
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
			$table->timestamp('created')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('last_updated')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('queue_transaction');
	}

}
