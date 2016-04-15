<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBranchHoursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('branch_hours', function(Blueprint $table)
		{
			$table->increments('track_id');
			$table->integer('branch_id')->default(0);
			$table->integer('date')->default(0);
			$table->integer('status')->default(0);
			$table->string('day_week')->default('');
			$table->integer('open_hour')->default(0);
			$table->integer('open_minute')->default(0);
			$table->string('open_ampm')->default('');
			$table->integer('close_hour')->default(0);
			$table->integer('close_minute')->default(0);
			$table->string('close_ampm')->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('branch_hours');
	}

}
