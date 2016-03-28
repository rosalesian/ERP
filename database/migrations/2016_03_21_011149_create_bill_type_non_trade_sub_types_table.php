<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillTypeNonTradeSubTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_type_non_trade_sub_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_type_id')->unsigned();
            $table->string('name', 100);
            $table->text('description')->nullable();
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
        Schema::drop('bill_type_non_trade_sub_types');
    }
}
