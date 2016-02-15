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
			$table->integer('type_id')->unsigned();
			$table->date('date');
			$table->double('total_amount', 9 , 5);
			$table->integer('requester');
			$table->text('remarks');
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
