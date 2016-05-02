<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRemoteQueueTimeBusinessSettings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('queue_settings', function($table) {
			$table->integer('remote_hour');
			$table->integer('remote_minute');
			$table->string('remote_ampm');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('queue_settings', function($table) {
			$table->dropColumn('remote_hour');
			$table->dropColumn('remote_minute');
			$table->dropColumn('remote_ampm');
		});
	}

}
