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
			$table->decimal('quantity', 8, 2)->default(1);
			$table->integer('unit_id')->unsigned();
			$table->double('unit_cost', 9 , 5)->default(0);
			$table->double('amount', 9 , 5)->default(0);
			$table->integer('taxcode')->unsigned()->nullable();
			$table->double('tax_amount', 9 , 5)->default(0);
			$table->double('gross_amount', 9 , 5)->default(0);
			$table->boolean('closed')->default(false);
			$table->boolean('inactive')->default(false);
			$table->integer('created_by')->unsigned()->nullable();
			$table->integer('updated_by')->unsigned()->nullable();
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
