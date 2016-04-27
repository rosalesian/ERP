<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowSetupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflow_setup', function (Blueprint $table) {
            $table->increments('id');
						$table->string('name');
						$table->text('description')->nullable();
						$table->integer('recordtype_id')->unsigned();
						$table->text('condition')->nullable();
						$table->integer('status')->unsigned();
						$table->boolean('oncreate')->default(false);
						$table->boolean('onupdate')->default(false);
						$table->integer('eventtype_id')->unsigned()->nullable();
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
        Schema::drop('workflow_setup');
    }
}
