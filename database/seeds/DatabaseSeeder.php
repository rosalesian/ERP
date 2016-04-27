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

        $this->call('BranchTableSeeder');
        $this->call('DivisionTableSeeder');
        $this->call('CompanyTableSeeder');
        $this->call('DepartmentTableSeeder');
        $this->call('EmployeeTableSeeder');
        $this->call('UnitsTypeTableSeeder');
        $this->call('UnitsTableSeeder');

        $this->call('ItemTableSeeder');
        $this->call('MaintenanceTypeSeeder');
        $this->call('PurchaseCategoryTableSeeder');

        $this->call('BillTypeSeeder');
        $this->call('BillTypeNonTradeSubTypeSeeder');
        $this->call('VendorsTableSeeder');
        $this->call('PurchaseRequestTableSeeder');

        /*
            Description: Seeder for  
                        "assets",
                        "item_types" as job_order_types,
                        "item_categories",
                        "repair_types"
            Created By: Ian Rosales
            Created On: April 11, 2016 
                        11:39
        */

        $this->call('ItemTypeTableSeeder');
        $this->call('AssetTableSeeder');
        $this->call('JobOrderTypeTableSeeder');
        //$this->call('ItemCategoryTableSeeder');
        Model::reguard();
    }
}
