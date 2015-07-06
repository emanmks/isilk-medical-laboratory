<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classifications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parent_id')->unsigned()->default(0);
			$table->string('code', 5)->nullable();
			$table->string('name', 100);
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
		Schema::drop('classifications');
	}

}
