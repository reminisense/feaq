<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormRecordTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form_record', function(Blueprint $table)
		{
			$table->increments('record_id');
			$table->integer('transaction_number')->default(0);
			$table->integer('form_id')->default(0);
			$table->integer('user_id')->default(0);
			$table->timestamp('time_created')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('record_path',255)->default('');
			$table->string('assessments_path',255)->default('');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('form_record');
	}

}
