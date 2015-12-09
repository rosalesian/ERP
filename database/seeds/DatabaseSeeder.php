<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('BranchTableSeeder');
        $this->call('DivisionTableSeeder');
        $this->call('CompanyTableSeeder');
        $this->call('DepartmentTableSeeder');
        $this->call('EmployeeTableSeeder');

        Model::reguard();
    }
}
