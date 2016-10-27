<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsSettings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('queue_settings', function(Blueprint $table){
			$table->integer('appointment_time_interval');
			$table->integer('appointment_number_start');
			$table->integer('appointment_number_limit');
			$table->string('appointment_number_prefix');
			$table->string('appointment_number_suffix');
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
			$table->dropColumn('appointment_time_interval');
			$table->dropColumn('appointment_number_start');
			$table->dropColumn('appointment_number_limit');
			$table->dropColumn('appointment_number_prefix');
			$table->dropColumn('appointment_number_suffix');
		});
	}

}
