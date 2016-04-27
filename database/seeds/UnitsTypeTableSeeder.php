// <?php

use Illuminate\Database\Seeder;
use Nixzen\Models\UnitType;

class UnitsTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //clear table
        UnitType::truncate();

        UnitType::create([
        	'name' => 'In Piece'
        ]);

        UnitType::create([
        	'name' => 'In Case'
        ]);

        UnitType::create([
        	'name' => '1 Case x 8 Pieces'
        ]);

        UnitType::create([
        	'name' => '1 Case x 16 Pieces'
        ]);

        UnitType::create([
        	'name' => '1 Case x 24 Pieces'
        ]);
        UnitType::create([
        	'name' => '1 Case x 36 Pieces'
        ]);
        UnitType::create([
        	'name' => '1 Case x 48 Pieces'
        ]);
    }
}
