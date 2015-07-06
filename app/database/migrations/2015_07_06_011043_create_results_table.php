<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('results', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('examination_id')->unsigned();
			$table->integer('parameter_id')->unsigned();
			$table->text('result', 65535)->nullable();
			$table->text('normal', 65535)->nullable();
			$table->string('regulation', 100)->nullable();
			$table->string('method', 100)->nullable();
			$table->boolean('attention')->default(0);
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
		Schema::drop('results');
	}

}
