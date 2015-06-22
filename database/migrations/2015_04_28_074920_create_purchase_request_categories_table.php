<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseRequestCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchase_request_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->text('description')->nullable();
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
		Schema::drop('purchase_request_categories');
	}

}
