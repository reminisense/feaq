<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVirtualAliasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('virtual_aliases', function(Blueprint $table)
		{
			$table->foreign('domain_id', 'virtual_aliases_ibfk_1')->references('id')->on('virtual_domains')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('virtual_aliases', function(Blueprint $table)
		{
			$table->dropForeign('virtual_aliases_ibfk_1');
		});
	}

}
