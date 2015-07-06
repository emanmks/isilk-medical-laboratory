<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOfficesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('offices', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100)->default('0');
			$table->string('address', 200)->nullable()->default('0');
			$table->string('phone', 50)->nullable()->default('0');
			$table->string('fax', 50)->nullable()->default('0');
			$table->string('email', 50)->nullable()->default('0');
			$table->integer('city_id')->unsigned();
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
		Schema::drop('offices');
	}

}
