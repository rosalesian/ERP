<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiveWorkflowsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('active_workflows', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('workflow_id');
			$table->integer('state_id'); //current active state
			$table->integer('recordtype_id');
			$table->integer('record_id');
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
		Schema::drop('active_workflows');
	}

}
