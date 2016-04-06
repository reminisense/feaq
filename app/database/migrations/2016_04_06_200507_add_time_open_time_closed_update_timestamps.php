<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimeOpenTimeClosedUpdateTimestamps extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('business_list', function($table){
            $table->string('time_open');
            $table->string('time_close');
            $table->dropColumn('deleted_at');
            $table->dropColumn('updated_at');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('business_list', function($table){
            $table->dropColumn('time_open');
            $table->dropColumn('time_close');
        });
	}

}
