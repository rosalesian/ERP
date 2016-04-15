<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemReceiptItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemreceipt_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('itemreceipt_id')->unsigned();
            $table->integer('purchaseorderitem_id')->unsigned();
            $table->decimal('quantity_received');
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
        Schema::drop('itemreceipt_item');
    }
}
