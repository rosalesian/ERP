<?php

use Illuminate\Database\Seeder;
use Nixzen\Models\Item;

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
        
        $faker = Faker\Factory::create();

        foreach(range(1,300) as $index) {
            Item::create([
                'description' => $faker->name,
                'itemcode' => $faker->phoneNumber,
                'itemtype_id' => 3,
                'unittype_id' =>3
            ]);
        }
    }
}
