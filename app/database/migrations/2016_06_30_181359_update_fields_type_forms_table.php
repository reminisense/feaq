<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFieldsTypeFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('forms', function (Blueprint $table) {
            $table->dropColumn('fields');
        });

        Schema::table('forms', function (Blueprint $table) {
            $table->longText('fields');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('forms', function (Blueprint $table) {
            $table->dropColumn('fields');
        });

        Schema::table('forms', function (Blueprint $table) {
            $table->string('fields');
        });
	}

}
