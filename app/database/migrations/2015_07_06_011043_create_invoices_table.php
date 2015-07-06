<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoices', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('code', 50)->nullable()->unique('code');
			$table->integer('laboratory_id')->unsigned();
			$table->string('financer_type', 50);
			$table->integer('financer_id')->unsigned();
			$table->string('insurance_id', 50)->nullable();
			$table->float('costs', 10)->unsigned()->default(0.00);
			$table->float('fee', 10)->unsigned()->default(0.00);
			$table->float('tax', 10)->unsigned()->default(0.00);
			$table->float('total', 10)->unsigned()->default(0.00);
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
		Schema::drop('invoices');
	}

}
