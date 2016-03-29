<?php

use Illuminate\Database\Seeder;
use Nixzen\Models\Vendor;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Faker\Factory::create();

        foreach(range(1,100) as $index) {
            Vendor::create([
                'description' => $faker->name,
                'name' => $faker->name,
				'email'=> $faker->email ,
				'phone' => $faker->phoneNumber,
				'faxno'=> $faker->postcode,
				'contact_person' => $faker->name,
				'auto_apply_wtax' => 1,
				'vendorcategories_id' => 1,
				'tin' => $faker->randomNumber($nbDigits = NULL),
				'branch_id' => 1,
				'taxcode_id' => 1,
				'term_id' => 1,
				'inactive' => 1,
				'created_by' => 1,
				'updated_by' => 1
            ]);
        }
    }
}
