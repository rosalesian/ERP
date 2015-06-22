<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanvassesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('canvasses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('vendor_id')->unsigned();
			$table->integer('terms_id')->unsigned();
			$table->integer('purchaserequestitem_id')->unsigned();
			$table->boolean('approved');
			$table->text('description');
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
		Schema::drop('canvasses');
	}

}
