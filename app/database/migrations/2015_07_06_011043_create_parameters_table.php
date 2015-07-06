<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParametersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parameters', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('service_id')->unsigned();
			$table->string('name', 100);
			$table->string('datatype', 50);
			$table->string('unit', 50);
			$table->text('expression', 65535)->nullable();
			$table->text('normal', 65535)->nullable();
			$table->integer('regulation_id')->unsigned()->default(1);
			$table->integer('method_id')->unsigned()->default(1);
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
		Schema::drop('parameters');
	}

}
