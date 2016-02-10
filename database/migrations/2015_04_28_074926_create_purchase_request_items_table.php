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
			$table->integer('item')->unsigned();
			$table->decimal('quantity', 8, 2);
			$table->integer('unit_id')->unsigned();
			$table->double('unit_cost', 9 , 5);
			$table->double('amount', 9 , 5);
			$table->integer('vendor_id')->unsigned();
			$table->integer('term_id')->unsigned();
			$table->integer('taxcode')->unsigned();
			$table->decimal('taxrate', 8, 2);
			$table->double('tax_amount', 9 , 5);
			$table->double('gross_amount', 9 , 5);
			$table->boolean('inactive');
			$table->integer('created_by')->unsigned();
			$table->integer('updated_by')->unsigned();
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
