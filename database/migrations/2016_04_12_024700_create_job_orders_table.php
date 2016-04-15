<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transnumber')->unsigned()->unique(); //transaction number
            $table->date('transdate');
            $table->integer('asset_id')->unsigned()->nullable(); //relation to asset table->id
            $table->integer('requested_by')->unsigned(); //relation to employee->id
            $table->integer('maintenancetype_id')->unsigned()->nullable()->default(NULL);
            $table->integer('prcategory_id')->unsigned();
            $table->integer('purchaserequest_id')->unsigned()->nullable()->default(NULL);
            $table->text('memo')->nullable();
            $table->boolean('inactive');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
            $table->foreign('asset_id')
                  ->references('id')
                  ->on('assets')
                  ->onDelete('cascade');
            $table->foreign('requested_by')
                  ->references('id')
                  ->on('employees')
                  ->onDelete('cascade');
            $table->foreign('maintenancetype_id')
                  ->references('id')
                  ->on('maintenance_types')
                  ->onDelete('cascade');
            $table->foreign('prcategory_id')
                  ->references('id')
                  ->on('purchase_request_categories')
                  ->onDelete('cascade');
            $table->foreign('purchaserequest_id')
                  ->references('id')
                  ->on('purchase_requests')
                  ->onDelete('cascade');
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
