<?php

use Illuminate\Database\Seeder;
use Nixzen\Models\ItemCategory;

class ItemCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         ItemCategory::truncate();

          //1
         ItemCategory::create([
        	'name' => 'Furniture & Fixtures',
        	'description' => 'Description for Furniture & Fixtures',
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        ]);
    }
}
