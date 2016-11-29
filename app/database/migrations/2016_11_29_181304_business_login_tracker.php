<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusinessLoginTracker extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_login', function(Blueprint $table){
			$table->integer('business_id');
			$table->integer('action');
			$table->string('device_token');
			$table->string('platform');
			$table->integer('added_on');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('business_login');
	}

}
