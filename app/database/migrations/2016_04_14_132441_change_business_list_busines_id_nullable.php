<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeBusinessListBusinesIdNullable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::statement('ALTER TABLE `business_list` MODIFY `business_id` INTEGER UNSIGNED NULL;');

    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::statement('ALTER TABLE `business_list` MODIFY `business_id` INTEGER UNSIGNED NULL;');
	}

}
