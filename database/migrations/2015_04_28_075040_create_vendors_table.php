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
			$table->string('name');
			$table->text('description')->nullable();
			$table->string('email');
			$table->string('phone');
			$table->string('faxno');
			$table->string('contact_person');
			$table->boolean('auto_apply_wtax');
			$table->integer('vendorcategories_id')->unsigned();
			$table->string('tin');
			$table->integer('branch_id')->unsigned();
			$table->integer('taxcode_id')->unsigned();
			$table->integer('term_id')->unsigned();
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
		Schema::drop('vendors');
	}

}
