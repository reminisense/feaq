<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSkippedTerminalTransaction extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('terminal_transaction', function(Blueprint $table)
		{
            $table->boolean('skipped');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('terminal_transaction', function(Blueprint $table)
		{
            $table->dropColumn('skipped');
		});
	}

}
