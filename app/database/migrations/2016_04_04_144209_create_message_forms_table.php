<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessageFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('message_forms', function(Blueprint $table)
		{
			$table->integer('message_id')->default(0);
			$table->integer('form_id')->default(0);
			$table->text('value');
			$table->primary(['message_id','form_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('message_forms');
	}

}
