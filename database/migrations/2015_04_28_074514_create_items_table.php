<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('itemcode');
			$table->text('description')->nullable();
			$table->integer('unittype_id')->unsigned();
			$table->integer('itemtype_id')->unsigned();
			$table->integer('default_purchaseunit_id')->unsigned();
			$table->integer('default_salesunit_id')->unsigned();
			$table->integer('default_stockunit_id')->unsigned();
			$table->integer('itemcategory_id')->unsigned();
			$table->integer('expensecategory_id')->unsigned();
			$table->integer('taxcode_id')->unsigned();
			$table->integer('account_id')->unsigned();
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
		Schema::drop('items');
	}

}
