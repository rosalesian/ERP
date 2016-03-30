<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorBillItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_bill_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendorbill_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->decimal('quantity', 8, 2)->default(1);
            $table->integer('uom_id')->unsigned();
            $table->double('unit_cost', 9 , 5)->default(0);
            $table->double('amount', 9 , 5)->default(0);
            $table->integer('taxcode_id')->unsigned()->nullable();
            $table->double('tax_amount', 9 , 5)->default(0);
            $table->double('gross_amount', 9 , 5)->default(0);
            $table->boolean('inactive')->default(false);
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
        Schema::drop('vendor_bill_items');
    }
}
