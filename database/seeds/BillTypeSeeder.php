<?php

use Illuminate\Database\Seeder;

class BillTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bill_types')->insert([
            'name' => 'TRADE'
        ]);

        DB::table('bill_types')->insert([
            'name' => 'NON-TRADE'
        ]);
    }
}
