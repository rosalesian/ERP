<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchase_order_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('purchaseorder_id')->unsigned();
			$table->integer('item_id')->unsigned();
			$table->decimal('quantity', 8, 2);
			$table->decimal('quantity_received', 8, 2);
			$table->decimal('quantity_billed', 8, 2);
			$table->integer('unit_id')->unsigned();
			$table->double('unit_cost', 9 , 5);
			$table->double('amount', 9 , 5);
			$table->integer('taxcode')->unsigned();
			$table->double('tax_amount', 9 , 5);
			$table->double('gross_amount', 9 , 5);
			$table->boolean('closed');
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
		Schema::drop('purchase_order_items');
	}

}
