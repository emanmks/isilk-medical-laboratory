<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('services', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('classification_id')->unsigned()->default(0);
			$table->string('code', 10)->nullable();
			$table->string('name', 100);
			$table->float('price', 9)->unsigned()->default(0.00);
			$table->boolean('clinical')->default(1);
			$table->integer('speciment_id')->unsigned()->default(0);
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
		Schema::drop('services');
	}

}
