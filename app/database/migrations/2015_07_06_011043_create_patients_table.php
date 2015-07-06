<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePatientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patients', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('code', 25)->nullable();
			$table->string('name', 100)->nullable();
			$table->enum('sex', array('L','P'))->nullable()->default('L');
			$table->date('birthdate')->default('0000-00-00');
			$table->string('address', 200)->nullable();
			$table->string('contact', 50)->nullable();
			$table->integer('city_id')->unsigned()->default(0);
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
		Schema::drop('patients');
	}

}
