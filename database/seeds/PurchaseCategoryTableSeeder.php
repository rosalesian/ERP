<?php

use Illuminate\Database\Seeder;
use Nixzen\Models\PurchaseRequestCategory;

class PurchaseCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //PurchaseRequestCategory::truncate();
        $faker = Faker\Factory::create();

        foreach(range(1, 300) as $index) {
        	PurchaseRequestCategory::create([
        		'name' => $faker->company,
        		'description' => $faker->address,
        		'inactive' => 1,
        		'created_by' => 1,
        		'updated_by' => 1
        	]);
        }
    }
}
