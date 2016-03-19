<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseRequestItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchase_request_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('purchaserequisition_id')->unsigned();
			$table->integer('item_id')->unsigned();
			$table->decimal('quantity', 8, 2);
			$table->integer('unit_id')->unsigned();
			$table->double('unit_cost', 9 , 5)->default(0);
			$table->double('amount', 9 , 5)->default(0);
			$table->integer('vendor_id')->unsigned()->nullable();
			$table->integer('term_id')->unsigned()->nullable();
			$table->integer('taxcode_id')->unsigned()->nullable();
			$table->decimal('taxrate', 8, 2)->nullable();
			$table->double('tax_amount', 9 , 5)->default(0);
			$table->double('gross_amount', 9 , 5)->default(0);
			$table->boolean('inactive')->default(false);
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
		Schema::drop('purchase_request_items');
	}

}
