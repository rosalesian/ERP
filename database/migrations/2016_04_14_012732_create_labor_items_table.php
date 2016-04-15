<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaborItemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labor_items', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('item_id')->unsigned();//REFERENCE IN ITEM TABLE
            $table->integer('jobtype_id')->unsigned();//STATIC VALUE GENERIC TABLE
            $table->integer('joborder_id')->unsigned();
            $table->integer('no_of_days')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
            $table->foreign('item_id')
                  ->references('id')
                  ->on('items');
            $table->foreign('jobtype_id')
                  ->references('id')
                  ->on('job_order_types');
            $table->foreign('joborder_id')
                  ->references('id')
                  ->on('job_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('labor_items');
    }

}

