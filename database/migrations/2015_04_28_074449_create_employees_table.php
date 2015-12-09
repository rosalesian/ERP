<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('firstname', 100);
			$table->string('middlename', 100);
			$table->string('lastname', 100);
			$table->text('description')->nullable();
			$table->integer('company_id')->unsigned();
			$table->integer('branch_id')->unsigned();
			$table->integer('department_id')->unsigned();
			$table->integer('division_id')->unsigned();
			$table->boolean('inactive')->default(false);
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
		Schema::drop('employees');
	}

}
