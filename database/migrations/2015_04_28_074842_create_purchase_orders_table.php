<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchase_orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('vendor_id')->unsigned();
			$table->date('date');
			$table->integer('ponumber')->nullable();
			$table->integer('type_id')->unsigned();
			$table->integer('paymenttype_id')->unsigned();
			$table->integer('terms_id')->unsigned();
			$table->integer('approvalstatus_id')->unsigned()->nullable();
			$table->integer('purchaserequisition')->unsigned()->nullable();
			$table->text('memo')->nullable();
			$table->string('delivered_to')->nullable();
			$table->integer('requested_by')->unsigned()->nullable();
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
		Schema::drop('purchase_orders');
	}

}
