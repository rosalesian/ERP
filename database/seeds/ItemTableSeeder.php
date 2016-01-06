<?php

use Illuminate\Database\Seeder;
use Nixzen\Models\Lists\Item;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //clear table
        Item::truncate();
    }
}
