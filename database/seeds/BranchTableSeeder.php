<?php

use Illuminate\Database\Seeder;
use Nixzen\Models\Lists\Branch;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //clear table
        Branch::truncate();

        //1st row
    	Branch::create([
    		'name' => 'HQ',
    		'description' => 'Corporate Office',
            'company_id' => 1
    	]);

        //2nd row
    	Branch::create([
    		'name' => 'PAKNAAN',
    		'description' => 'Paknaan Mandaue Cebu',
            'company_id' => 2
    	]);

        //3rd row
    	Branch::create([
    		'name' => 'TAGUNOL',
    		'description' => 'Tagunol Cebu',
            'company_id' => 2
    	]);
    }
}
