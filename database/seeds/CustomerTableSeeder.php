<?php

use Illuminate\Database\Seeder;
use Nixzen\Models\Lists\Customer

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//clear table
        Customer::truncate();

    }
}
