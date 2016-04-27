<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatePositions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state_id')->unsigned();
            $table->float('pos_x');
            $table->float('pos_y');
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
        Schema::drop('state_positions');
    }
}
