<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVirtualAliasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('virtual_aliases', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('domain_id')->index('domain_id');
			$table->string('source', 100);
			$table->string('destination', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('virtual_aliases');
	}

}
