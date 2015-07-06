<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToInvoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('invoices', function(Blueprint $table)
		{
			$table->float("balance")->default(0)->before("created_at");
			$table->string("guarantor_name")->nullable()->before("created_at");
			$table->string("guarantor_id_card")->nullable()->before("created_at");
			$table->string("guarantor_id_address")->nullable()->before("created_at");
			$table->string("guarantor_address")->nullable()->before("created_at");
			$table->string("guarantor_contact")->nullable()->before("created_at");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('invoices', function(Blueprint $table)
		{
			$table->removeColumn('guarantor_name');
			$table->removeColumn('guarantor_id_card');
			$table->removeColumn('guarantor_id_address');
			$table->removeColumn('guarantor_address');
			$table->removeColumn('guarantor_contact');
		});
	}

}
