<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorPaymentItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_payment_item', function (Blueprint $table) {
            $table->increments('id');
						$table->integer('vendor_payment_id')->unsigned();
						$table->boolean('apply')->default(false);
						$table->integer('bill_id')->unsigned();
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
        Schema::drop('vendor_payment_item');
    }
}
