<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSamplingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('samplings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('code', 25)->nullable()->unique('code');
			$table->integer('laboratory_id');
			$table->integer('speciment_id');
			$table->string('name', 50)->nullable();
			$table->string('description', 250)->nullable();
			$table->string('form', 100)->nullable();
			$table->string('container', 100)->nullable();
			$table->string('volume', 100)->nullable();
			$table->boolean('taken')->default(0);
			$table->dateTime('samplingtime')->nullable();
			$table->dateTime('takentime')->nullable();
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
		Schema::drop('samplings');
	}

}
