<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FreeAccountsBusinessTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business', function(Blueprint $table){
			$table->integer('free_account');
			$table->string('logo');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business', function(Blueprint $table){
			$table->dropColumn('free_account');
			$table->dropColumn('logo');
		});
	}

}
