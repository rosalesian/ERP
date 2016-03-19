<?php

use Illuminate\Database\Seeder;
use Nixzen\Models\ItemTypes;

class ItemTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//clear table
        ItemTypes::truncate();

        //1
        ItemTypes::create([
        	'name' => 'Services'
        ]);

        //2
        ItemTypes::create([
        	'name' => 'Inventory'
        ]);

        //3
        ItemTypes::create([
        	'name' => 'Non-Inventory'
        ]);
    }
}
