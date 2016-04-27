<?php

use Illuminate\Database\Seeder;
use Nixzen\Models\Item\JobOrderType;

class JobOrderTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //clear table
        //JobOrderType::truncate();

        //1st row
        JobOrderType::create([
        	'name' => 'In-house',
        	'description' => 'Description for In-house',
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        ]);

         //2nd row
        JobOrderType::create([
        	'name' => 'Job out',
        	'description' => 'Description for Job out',
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        ]);
    }
}
