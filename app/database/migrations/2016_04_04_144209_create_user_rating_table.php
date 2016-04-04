<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserRatingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_rating', function(Blueprint $table)
		{
			$table->integer('user_rating_id', true);
			$table->integer('date')->default(0);
			$table->integer('business_id')->default(0);
			$table->integer('rating')->default(0);
			$table->integer('user_id')->default(0);
			$table->integer('terminal_user_id')->default(0);
			$table->integer('action')->default(0);
			$table->string('transaction_number', 11)->nullable()->default('0');
			$table->string('rated_by', 11);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_rating');
	}

}
