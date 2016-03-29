<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorBillExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_bill_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendorbill_id')->unsigned();
            $table->integer('coa_id');
            $table->double('amount', 9 , 5)->default(0);
            $table->integer('taxcode_id')->unsigned()->nullable();
            $table->double('tax_amount', 9 , 5)->default(0);
            $table->double('gross_amount', 9 , 5)->default(0);
            $table->integer('department_id')->unsigned();
            $table->integer('division_id')->unsigned();
            $table->integer('branch_id')->unsigned();
            $table->integer('vendor_id')->unsigned();
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
        Schema::drop('vendor_bill_expenses');
    }
}
