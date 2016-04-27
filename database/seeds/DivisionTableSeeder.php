<?php

use Illuminate\Database\Seeder;
use Nixzen\Models\Lists\Division;

class DivisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //clear table
        Division::truncate();

        //1st row
        Division::create([
        	'name'=>'PROCTER & GAMBLE',
            'company_id' => 2
        ]);
		//2nd row
        Division::create([
        	'name'=>'MONDELEZ',
            'company_id' => 2
        ]);
		//3rd row
        Division::create([
        	'name'=>'DEL MONTE PHILIPINES INC',
            'company_id' => 2
        ]);
		//4th row
        Division::create([
        	'name'=>'NUTRI ASIA INC',
            'company_id' => 2
        ]);
		//5th row
        Division::create([
        	'name'=>'MONDE NISSIN CORP',
            'company_id' => 2
        ]);
    }
}
