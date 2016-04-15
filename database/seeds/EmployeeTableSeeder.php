<?php

use Illuminate\Database\Seeder;
use Nixzen\Models\Lists\Employee;

class EmployeeTableSeeder extends Seeder
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
        Employee::truncate();
=======
        //Employee::truncate();
>>>>>>> job_order_views

        //1st row
        Employee::create([
            'name' => 'Christian D. Gumera',
            'firstname' => 'Christian',
            'middlename' => 'Divinagracia',
            'lastname' => 'Gumera',
            'company_id' => 1,
            'branch_id' => 1,
            'department_id' => 1,
        ]);

        //2nd row
        Employee::create([
            'name' => 'Redemptor T. Enderes',
            'firstname' => 'Redemptor',
            'middlename' => 'Teves',
            'lastname' => 'Enderes',
            'company_id' => 1,
            'branch_id' => 1,
            'department_id' => 1,
        ]);

        //3rd row
        Employee::create([
            'name' => 'Albert S. Demillones',
            'firstname' => 'Albert',
            'middlename' => 'Servano',
            'lastname' => 'Demillones',
            'company_id' => 1,
            'branch_id' => 1,
            'department_id' => 1,
        ]);

        //4th row
        Employee::create([
            'name' => 'Juan N. Luna',
            'firstname' => 'Juan',
            'middlename' => 'Novicio',
            'lastname' => 'Luna',
            'company_id' => 2,
            'branch_id' => 3,
            'department_id' => 7,
        ]);

        //5th row
        Employee::create([
            'name' => 'Emilio F. Aguinaldo',
            'firstname' => 'Emilio',
            'middlename' => 'Famy',
            'lastname' => 'Aguinaldo',
            'company_id' => 2,
            'branch_id' => 3,
            'department_id' => 7,
        ]);

        //6th row
        Employee::create([
            'name' => 'Jose M. Rizal',
            'firstname' => 'Jose',
            'middlename' => 'Mercado',
            'lastname' => 'Rizal',
            'company_id' => 2,
            'branch_id' => 3,
            'department_id' => 8,
        ]);
    }
}
