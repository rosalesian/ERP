<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job_orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('transnumber')->unsigned()->unique(); //transaction number
			$table->date('transdate');
			$table->integer('asset')->unsigned(); //relation to item->id
			//$table->integer('branch_id')->unsigned();
			//$table->integer('approvalstatus_id')->unsigned();
			$table->integer('requested_by')->unsigned(); //relation to employee->id
			$table->integer('maintenancetype_id')->unsigned();
			$table->integer('prcategory_id')->unsigned();
			//$table->integer('division_id')->unsigned();
			$table->text('memo')->nullable();
			//$table->integer('department_id')->unsigned();
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
		Schema::drop('job_orders');
	}

}
