<?php

use Illuminate\Database\Seeder;
use Nixzen\Models\Lists\Department;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //clear table
        Department::truncate();

        //1st row
        Department::create([
        	'name' => 'Information Technology',
        	'company_id' => 1
        ]);

        //2nd row
        Department::create([
            'name' => 'Accounting',
            'company_id' => 1
        ]);

        //3rd row
        Department::create([
            'name' => 'Finance',
            'company_id' => 1
        ]);

        //4th row
        Department::create([
            'name' => 'Logistics',
            'company_id' => 1
        ]);

        //5th row
        Department::create([
            'name' => 'Sales',
            'company_id' => 1
        ]);

        //1st row
        Department::create([
            'name' => 'Information Technology',
            'company_id' => 2
        ]);

        //2nd row
        Department::create([
            'name' => 'Accounting',
            'company_id' => 2
        ]);

        //3rd row
        Department::create([
            'name' => 'Finance',
            'company_id' => 2
        ]);

        //4th row
        Department::create([
            'name' => 'Logistics',
            'company_id' => 2
        ]);

        //5th row
        Department::create([
            'name' => 'Sales',
            'company_id' => 2
        ]);
    }
}
