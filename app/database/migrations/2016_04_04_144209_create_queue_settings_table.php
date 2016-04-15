<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQueueSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('queue_settings', function(Blueprint $table)
		{
			$table->integer('queue_setting_id', true);
			$table->integer('service_id');
			$table->integer('number_start');
			$table->integer('number_limit');
			$table->boolean('auto_issue')->default(0);
			$table->boolean('terminal_specific_issue')->default(0);
			$table->integer('date');
			$table->boolean('allow_remote')->default(0);
			$table->boolean('allow_sms')->default(0);
			$table->integer('remote_limit')->default(0);
			$table->integer('sms_limit')->default(0);
			$table->string('frontline_sms_secret')->nullable();
			$table->string('frontline_sms_url')->nullable();
			$table->boolean('sms_current_number')->default(0);
			$table->boolean('sms_1_ahead')->default(0);
			$table->boolean('sms_5_ahead')->default(0);
			$table->boolean('sms_10_ahead')->default(0);
			$table->boolean('sms_blank_ahead')->default(0);
			$table->integer('input_sms_field')->default(0);
			$table->string('sms_gateway')->nullable();
			$table->text('sms_gateway_api', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('queue_settings');
	}

}
