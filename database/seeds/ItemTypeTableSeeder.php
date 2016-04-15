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
<<<<<<< HEAD
        // ItemTypes::truncate();

        //1
        //  ItemTypes::create([
        // 	'name' => 'Services'
        // ]);

        //2
        // ItemTypes::create([
        // 	'name' => 'Inventory'
        // ]);

        //3
        // ItemTypes::create([
        // 	'name' => 'Non-Inventory'
        // ]);
=======
        ItemTypes::truncate();

        //1
         ItemTypes::create([
        	'name' => 'Services',
            'description' => 'Description for Services',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);

        //2
        ItemTypes::create([
        	'name' => 'Inventory',
            'description' => 'Description for Inventory',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);

        //3
        ItemTypes::create([
        	'name' => 'Non-Inventory',
            'description' => 'Description for Non-Inventory',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);

         //4
        ItemTypes::create([
            'name' => 'Other Charge',
            'description' => 'Description for Other Charge',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);

         //3
        ItemTypes::create([
            'name' => 'Payment',
            'description' => 'Description for Payment',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);
>>>>>>> job_order_views
    }
}
