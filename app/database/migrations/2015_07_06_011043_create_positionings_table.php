<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePositioningsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('positionings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('installation_id')->unsigned();
			$table->integer('employee_id')->unsigned();
			$table->string('position', 50);
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
		Schema::drop('positionings');
	}

}
