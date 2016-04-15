<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserAnonymousTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_anonymous', function(Blueprint $table)
		{
			$table->integer('anonymous_id', true);
			$table->string('first_name')->default('');
			$table->string('last_name')->default('');
			$table->string('phone', 11)->default('');
			$table->string('email')->default('');
			$table->integer('service_id')->default(0);
			$table->string('sex', 1)->default('');
			$table->string('token')->default('')->unique('token');
			$table->string('confirmation_code')->default('');
			$table->integer('priority_number')->default(0);
			$table->string('platform')->default('');
			$table->integer('signup_time')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_anonymous');
	}

}
