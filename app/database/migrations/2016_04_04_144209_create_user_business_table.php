<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserBusinessTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_business', function(Blueprint $table)
		{
			$table->integer('user_id')->default(0);
			$table->integer('business_id')->default(0);
			$table->timestamp('time_joined')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('it_admin')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_business');
	}

}
