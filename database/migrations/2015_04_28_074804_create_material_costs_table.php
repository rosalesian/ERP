<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialCostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('material_costs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('joborder_id');
			$table->integer('item_id')->unsigned();//item_id
			$table->integer('units_id')->unsigned();
			$table->decimal('quantity', 8, 2); // max 99,999,999.99
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
		Schema::drop('material_costs');
	}

}
