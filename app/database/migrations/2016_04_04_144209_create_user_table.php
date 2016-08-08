<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function(Blueprint $table)
		{
			$table->increments('user_id');
			$table->string('remember_token')->default('');
			$table->string('email')->default('');
			$table->string('username')->default('');
			$table->string('password')->default('');
			$table->string('phone', 24)->default('0');
			$table->integer('status')->default(1);
			$table->string('last_name')->default('');
			$table->string('first_name')->default('');
			$table->integer('birthdate')->default(0);
			$table->string('gender', 10)->default('0');
			$table->string('local_address')->default('');
			$table->string('city')->default('');
			$table->integer('country')->default(0);
			$table->integer('nationality')->default(0);
			$table->integer('civil_status')->default(0);
			$table->integer('last_login')->default(0);
			$table->timestamp('registration_date')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('referred_by')->default(0);
			$table->integer('date_referred')->default(0);
			$table->integer('area')->default(0);
			$table->string('verified', 10)->default('');
			$table->string('fb_id', 124)->default('0');
			$table->string('fb_url')->default('');
			$table->string('gcm_token');
			$table->unique(['username','email']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user');
	}

}
