<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTerminalTransactionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('terminal_transaction', function(Blueprint $table)
		{
			$table->integer('transaction_number')->default(0);
			$table->integer('login_id')->default(0);
			$table->integer('time_completed')->default(0);
			$table->integer('time_queued')->default(0);
			$table->integer('time_called')->default(0);
			$table->integer('time_removed')->default(0);
			$table->integer('terminal_id')->default(0);
			$table->integer('time_assigned')->nullable()->default(0);
			$table->integer('time_checked_in')->nullable()->default(0);
			$table->primary(['transaction_number','login_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('terminal_transaction');
	}

}
