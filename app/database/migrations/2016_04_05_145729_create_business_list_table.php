<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_list', function(Blueprint $table)
		{
			$table->increments('business_list_id');
			$table->string('name');
			$table->string('local_address');
			$table->string('email');
			$table->string('phone', 24)->default('0');
			$table->integer('up_vote')->default(0);
			$table->integer('down_vote')->default(0);
			$table->integer('business_id')->unsigned()->default(0)->index('business_id');
			$table->integer('created_by')->unsigned()->index('created_by');
			$table->timestamps();
			$table->dateTime('deleted_at');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('business_list');
	}

}
