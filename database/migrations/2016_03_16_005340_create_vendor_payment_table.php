<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_payment', function (Blueprint $table) {
            $table->increments('id');
						$table->integer('transno')->nullable();
						$table->integer('coa_id')->unsigned();
						$table->integer('payee_id')->unsigned();
						$table->date('date');
						$table->integer('posting_period_id')->unsigned();
						$table->integer('checkno');
						$table->date('checkdate');
						$table->integer('principal_id')->unsigned();
						$table->integer('branch_id')->unsigned();
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
        Schema::drop('vendor_payment');
    }
}
