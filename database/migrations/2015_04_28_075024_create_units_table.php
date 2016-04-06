<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('units', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->string('pluralname', 100);
			$table->string('abbreviation', 10);
			$table->string('plural_abbreviation', 10)->nullable();
			$table->integer('conversion_rate')->unsigned();
			$table->boolean('base_unit')->default(false);
			$table->integer('unittype_id')->unsigned();
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
		Schema::drop('units');
	}

}
