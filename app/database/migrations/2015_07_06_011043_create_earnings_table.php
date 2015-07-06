<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEarningsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('earnings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('code', 50)->nullable()->unique('code');
			$table->string('earnable_type', 50);
			$table->integer('earnable_id')->unsigned()->default(0);
			$table->date('earning_date');
			$table->float('costs', 10)->default(0.00);
			$table->float('fee', 10)->default(0.00);
			$table->float('tax', 10)->default(0.00);
			$table->float('total', 10)->default(0.00);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('earnings');
	}

}
