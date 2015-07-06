<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('choices', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('laboratory_id')->unsigned();
			$table->string('examinable_type', 50);
			$table->integer('examinable_id')->unsigned();
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
		Schema::drop('choices');
	}

}
