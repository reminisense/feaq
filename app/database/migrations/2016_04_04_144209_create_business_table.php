<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business', function(Blueprint $table)
		{
			$table->increments('business_id');
			$table->string('name')->default('');
			$table->string('raw_code')->default('');
			$table->string('industry')->default('');
			$table->integer('country_code')->default(0);
			$table->integer('area_code')->default(0);
			$table->integer('open_hour')->default(0);
			$table->integer('open_minute')->default(0);
			$table->string('open_ampm')->default('');
			$table->integer('close_hour')->default(0);
			$table->integer('close_minute')->default(0);
			$table->string('close_ampm')->default('');
			$table->timestamp('registration_date')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('last_active_date')->default(0);
			$table->integer('status')->default(1);
			$table->integer('override')->default(0);
			$table->string('timezone')->default('Asia/Manila');
			$table->string('local_address')->default('');
			$table->integer('zip_code')->default(0);
			$table->integer('num_terminals');
			$table->integer('queue_limit');
			$table->string('fb_url');
			$table->float('latitude', 10, 0)->default(0);
			$table->float('longitude', 10, 0)->default(0);
			$table->text('business_features', 65535);
			$table->string('vanity_url')->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('business');
	}

}
