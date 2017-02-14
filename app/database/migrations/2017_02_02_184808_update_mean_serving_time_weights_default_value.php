<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMeanServingTimeWeightsDefaultValue extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		DB::statement('ALTER TABLE `mean_serving_time` CHANGE COLUMN `weight_today` `weight_today` INTEGER NOT NULL DEFAULT 0;');
		DB::statement('ALTER TABLE `mean_serving_time` CHANGE COLUMN `weight_yesterday` `weight_yesterday` INTEGER NOT NULL DEFAULT 0;');
		DB::statement('ALTER TABLE `mean_serving_time` CHANGE COLUMN `weight_three_days` `weight_three_days` INTEGER NOT NULL DEFAULT 0;');
		DB::statement('ALTER TABLE `mean_serving_time` CHANGE COLUMN `weight_this_week` `weight_this_week` INTEGER NOT NULL DEFAULT 0;');
		DB::statement('ALTER TABLE `mean_serving_time` CHANGE COLUMN `weight_last_week` `weight_last_week` INTEGER NOT NULL DEFAULT 0;');
		DB::statement('ALTER TABLE `mean_serving_time` CHANGE COLUMN `weight_this_month` `weight_this_month` INTEGER NOT NULL DEFAULT 0;');
		DB::statement('ALTER TABLE `mean_serving_time` CHANGE COLUMN `weight_last_month` `weight_last_month` INTEGER NOT NULL DEFAULT 0;');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
