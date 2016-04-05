<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBusinessListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_list', function(Blueprint $table)
		{
			$table->foreign('created_by', 'business_list_ibfk_2')->references('user_id')->on('user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('business_id', 'business_list_ibfk_1')->references('business_id')->on('business')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business_list', function(Blueprint $table)
		{
			$table->dropForeign('business_list_ibfk_2');
			$table->dropForeign('business_list_ibfk_1');
		});
	}

}
