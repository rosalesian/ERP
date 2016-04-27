<?php

use Illuminate\Database\Seeder;
use Nixzen\Models\MaintenanceType;

class MaintenanceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //MaintenanceType::truncate();

       //1st row
        MaintenanceType::create([
            'name' => 'Regular/Preventive',
            'description' => 'Description for Regular/Preventive',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);

        //2nd row
        MaintenanceType::create([
            'name' => 'Corrective',
            'description' => 'Descriptin for Corrective',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);

        //3rd row
        MaintenanceType::create([
            'name' => 'Breakdown',
            'description' => 'Description for Breakdown',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);
    }
}
