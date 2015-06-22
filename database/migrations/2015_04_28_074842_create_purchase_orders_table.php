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
			$table->integer('name')->unsigned();
			$table->date('transdate');
			$table->integer('transnumber');
			$table->integer('purchaserequestcategory_id');
			$table->integer('paymenttype_id')->unsigned();
			$table->integer('terms_id')->unsigned();
			$table->integer('approvalstatus_id')->unsigned();
			$table->integer('purchaserequisition')->unsigned();
			$table->text('memo');
			$table->string('delivered_to');
			$table->double('subtotal', 9 , 5);
			$table->double('taxtotal', 9 , 5);
			$table->double('total_amount', 9 , 5);
			$table->integer('department_id')->unsigned();
			$table->integer('division_id')->unsigned();
			$table->integer('requested_by');
			$table->integer('stocklocation_id')->unsigned();
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
		Schema::drop('purchase_orders');
	}

}
