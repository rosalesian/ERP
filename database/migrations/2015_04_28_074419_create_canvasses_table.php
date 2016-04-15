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
			$table->integer('vendor_id')->unsigned();
			$table->integer('terms_id')->unsigned();
			$table->decimal('cost', 10, 2)->default(0);
			$table->integer('purchaserequestitem_id')->unsigned();
			$table->boolean('approve')->default(false);
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
		Schema::drop('canvasses');
	}

}
