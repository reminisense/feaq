<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteDownvoteColumnInBusinessList extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('business_list', function ($table) {
            $table->dropColumn('down_vote');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('business_list', function ($table) {
            $table->integer('down_vote')->default(0);
        });
	}

}
