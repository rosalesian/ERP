<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *f
     * @return void
     */
    public function run()
    {
        Model::unguard();

      /*  $this->call('BranchTableSeeder');
        $this->call('DivisionTableSeeder');
        $this->call('CompanyTableSeeder');
        $this->call('DepartmentTableSeeder');
        $this->call('EmployeeTableSeeder');
        $this->call('UnitsTypeTableSeeder');
        $this->call('UnitsTableSeeder');
        $this->call('ItemTypeTableSeeder');*/
        //$this->call('ItemTableSeeder');
        //$this->call('MaintenanceTypeSeeder');
         $this->call('PurchaseCategoryTableSeeder');
        Model::reguard();
    }
}
