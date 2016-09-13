<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQueueSettingsNumberPrefix extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('queue_settings', function(Blueprint $table){
			$table->string('number_prefix');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('queue_settings', function(Blueprint $table){
			$table->dropColumn('number_prefix');
		});
	}

}
