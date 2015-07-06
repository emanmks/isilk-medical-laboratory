<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExaminationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('examinations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('choice_id')->unsigned();
			$table->integer('service_id')->unsigned();
			$table->integer('sampling_id')->unsigned();
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
		Schema::drop('examinations');
	}

}
