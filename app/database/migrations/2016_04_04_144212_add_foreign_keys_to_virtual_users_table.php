<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVirtualUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('virtual_users', function(Blueprint $table)
		{
			$table->foreign('domain_id', 'virtual_users_ibfk_1')->references('id')->on('virtual_domains')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('virtual_users', function(Blueprint $table)
		{
			$table->dropForeign('virtual_users_ibfk_1');
		});
	}

}
