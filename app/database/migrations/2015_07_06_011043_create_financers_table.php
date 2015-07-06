<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFinancersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('financers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 50);
			$table->string('address', 100)->nullable();
			$table->string('phone', 100)->nullable();
			$table->string('email', 100)->nullable();
			$table->text('description', 65535)->nullable();
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
		Schema::drop('financers');
	}

}
