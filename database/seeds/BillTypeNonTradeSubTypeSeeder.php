<?php

use Illuminate\Database\Seeder;

class BillTypeNonTradeSubTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bill_type_non_trade_sub_types')->insert([
            'bill_type_id' => 2,
            'name' => 'Employee Incentives',
        ]);

        DB::table('bill_type_non_trade_sub_types')->insert([
            'bill_type_id' => 2,
            'name' => 'Non-Trade Expenses - Branch',
        ]);

        DB::table('bill_type_non_trade_sub_types')->insert([
            'bill_type_id' => 2,
            'name' => 'Non-Trade Purchases - Branch',
        ]);

        DB::table('bill_type_non_trade_sub_types')->insert([
            'bill_type_id' => 2,
            'name' => 'Payroll - Confi',
        ]);

        DB::table('bill_type_non_trade_sub_types')->insert([
            'bill_type_id' => 2,
            'name' => 'Payroll - Rank&File',
        ]);

        DB::table('bill_type_non_trade_sub_types')->insert([
            'bill_type_id' => 2,
            'name' => 'PCF Transactions',
        ]);

        DB::table('bill_type_non_trade_sub_types')->insert([
            'bill_type_id' => 2,
            'name' => 'Weekly Expense Report',
        ]);

        DB::table('bill_type_non_trade_sub_types')->insert([
            'bill_type_id' => 2,
            'name' => 'Cash Advance - Branch',
        ]);

        DB::table('bill_type_non_trade_sub_types')->insert([
            'bill_type_id' => 2,
            'name' => 'Revolving Fund',
        ]);

        DB::table('bill_type_non_trade_sub_types')->insert([
            'bill_type_id' => 2,
            'name' => 'LCF Transaction',
        ]);
    }
}
