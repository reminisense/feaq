<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVirtualUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('virtual_users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('domain_id')->index('domain_id');
			$table->string('password', 106);
			$table->string('email', 120)->unique('email');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('virtual_users');
	}

}
