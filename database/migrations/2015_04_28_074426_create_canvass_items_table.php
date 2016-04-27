<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanvassItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('canvass_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->decimal('quantity', 8, 2); //max = 99,999,999.99
			$table->double('unit_price', 9, 5); //max = 999,999,999.99999
			$table->integer('canvass_id')->unsigned();
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
		Schema::drop('canvass_items');
	}

}
