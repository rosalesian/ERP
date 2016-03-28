<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id')->unsigned();
            $table->string('transno');
            $table->string('suppliers_inv_no');
            $table->date('date');
            $table->date('duedate');
            $table->integer('billtype_id');
            $table->integer('billtype_nontrade_subtype_id')->unsigned()->nullable();
            $table->integer('coa_id')->unsigned();
            $table->integer('terms_id')->unsigned();
            $table->integer('posting_period_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->integer('division_id')->unsigned();
            $table->integer('branch_id')->unsigned();
            $table->integer('approvalstatus_id')->unsigned()->nullable();
            $table->text('memo')->nullable();
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
        Schema::drop('vendor_bills');
    }
}
