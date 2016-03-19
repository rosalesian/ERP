<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->text('description')->nullable();
			$table->string('email', 100);
			$table->string('phone', 15);
			$table->string('faxno', 15)->nullable();
			$table->string('contact_person', 200)->nullable();
			$table->boolean('auto_apply_wtax')->default(false);
			$table->integer('vendorcategories_id')->unsigned();
			$table->string('tin', 20);
			$table->integer('branch_id')->unsigned();
			$table->integer('taxcode_id')->unsigned();
			$table->integer('term_id')->unsigned();
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
		Schema::drop('vendors');
	}

}
