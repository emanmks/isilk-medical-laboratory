<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLaboratoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('laboratories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('code', 50)->nullable()->unique('code');
			$table->string('registrant_type', 50);
			$table->integer('registrant_id')->unsigned();
			$table->integer('employee_id')->unsigned();
			$table->integer('regulation_id')->unsigned()->default(1);
			$table->integer('recommender')->unsigned()->default(1);
			$table->string('recommender_name', 100)->nullable();
			$table->timestamp('registrationtime')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->boolean('verified')->default(0);
			$table->boolean('released')->default(0);
			$table->boolean('multiplier')->default(1);
			$table->text('messages', 65535)->nullable();
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
		Schema::drop('laboratories');
	}

}
