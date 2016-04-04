<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service', function(Blueprint $table)
		{
			$table->increments('service_id');
			$table->string('code')->default('');
			$table->string('name')->default('');
			$table->integer('status')->default(1);
			$table->timestamp('time_created')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('branch_id')->default(0);
			$table->string('repeat_type', 10)->nullable()->default('daily');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('service');
	}

}
