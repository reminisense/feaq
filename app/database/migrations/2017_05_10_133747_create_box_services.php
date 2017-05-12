<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxServices extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_boxes', function(Blueprint $table)
		{
			$table->integer('box_num')->default(0);
      $table->integer('service_id')->default(0);
      $table->string('service_name')->default('');
      $table->primary('box_num');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('service_boxes');
	}

}
