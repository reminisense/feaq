<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForms extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('forms', function($table){
            $table->dropColumn('business_id','field_type');
            $table->renameColumn('field_data','fields');
            $table->timestamp('time_created');
            $table->string('form_name',255)->default('');
            $table->string('xml_path',255)->default('');
        });
    }
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('forms', function($table){
            $table->integer('business_id')->default(0);
            $table->string('field_type',255);
            $table->renameColumn('fields','field_data');
            $table->dropColumn('time_created');
            $table->dropColumn('form_name');
            $table->dropColumn('xml_path');
        });
	}

}
