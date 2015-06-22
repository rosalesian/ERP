<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchase_requests', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('purchaserequestcategory_id');
			$table->integer('approvalstatus_id')->unsigned();
			$table->integer('nextapprover_role')->unsigned();
			$table->double('total_amount', 9 , 5);
			$table->integer('division_id')->unsigned();
			$table->string('delivered_to');
			$table->integer('requested_by');
			$table->integer('department_id')->unsigned();
			$table->integer('joborder_id');
			$table->integer('recordtype')->unsigned();
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
		Schema::drop('purchase_requests');
	}

}
