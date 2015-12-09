<?php

use Illuminate\Database\Seeder;
use Nixzen\Models\Lists\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //clear table
        Company::truncate();

        //1st company
        Company::create([
        	'name' => 'Philippine Golden Kaizen Holdings',
        	'description' => 'The holdings comapnay of Dranix, MJR, GKD',
        	'tin' => '123456789'
        ]);

        //2nd company
        Company::create([
        	'name' => 'Dranix Distributors Inc',
        	'description' => 'Dranix Distrubutor company',
        	'tin' => '0134344435'
        ]);
    }
}
