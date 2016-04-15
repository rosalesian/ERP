<?php

use Illuminate\Database\Seeder;
use Nixzen\Models\Asset;


class AssetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //clear table
       // Asset::truncate();

        //1st row
        Asset::create([
        	'name' => 'ISUZU ELF VAN MDK994',
        	'description' => 'Aluminum Van',
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        ]);

        //2nd row
        Asset::create([
        	'name' => 'ALUM VAN YAH326',
        	'description' => '1unit aluminum van',
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        ]);

        //3rd row
        Asset::create([
        	'name' => 'ALUM VAN YHL 528',
        	'description' => 'isuzu forward alum van',
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        ]);

        //4th row
        Asset::create([
        	'name' => 'ALUM VAN GHD349',
        	'description' => 'mits L200 van',
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        ]);

        //5th row
        Asset::create([
        	'name' => 'ISUZU 6 WHEELER VAN133 YAH336',
        	'description' => 'Aluminum van133',
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        ]);

        //6th row
        Asset::create([
        	'name' => 'ALUM VAN GHV305',
        	'description' => '1 unit Mit. L300',
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        ]);

        //7th row
        Asset::create([
        	'name' => 'HONDA WAVE 100 8518SZ',
        	'description' => 'Motorcycle without side car',
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        ]);

         //8th row
        Asset::create([
        	'name' => 'MOTORELLA W/OUT SIDECAR 1721UQ',
        	'description' => 'Motorcycle w/out sidecar',
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        ]);

         //9th row
        Asset::create([
        	'name' => 'MOTORELLA W/SIDECAR 4881YZ',
        	'description' => 'Motorcycle w/sidecar',
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        ]);

         //10th row
        Asset::create([
        	'name' => 'MOTORELLA W/OUT SIDECAR 6991GI',
        	'description' => 'Motorcycle w/out sidecar',
        	'created_at' => date('Y-m-d h:i:s'),
        	'updated_at' => date('Y-m-d h:i:s')
        ]);
    }
}
