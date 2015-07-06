<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNormalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('normals', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parameter_id')->unsigned();
			$table->integer('regulation_id')->unsigned()->nullable();
			$table->integer('method_id')->unsigned()->nullable();
			$table->text('normal', 65535);
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
		Schema::drop('normals');
	}

}
