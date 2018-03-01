<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteCreatedAtAndUpdatedAt extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('business_list', function ($table) {
            $table->dropColumn('created_at');
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
        Schema::table('business_list', function ($table) {
            $table->timestamps();
        });
	}

}
