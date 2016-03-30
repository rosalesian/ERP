<?php

use Illuminate\Database\Seeder;
use Nixzen\Models\Unit;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //clear table
        Unit::truncate();
         $faker = Faker\Factory::create();

        foreach(range(1, 300) as $index) {
            Unit::create([
            'name' => $faker->company(),
            'pluralname' => $faker->address(),
            'abbreviation' => 'Pc',
            'plural_abbreviation' => 'Pcs',
            'conversion_rate' => 1,
            'base_unit' => true,
            'unittype_id' => 1
        ]);
        }
        
        // Unit::create([
        // 	'name' => 'Piece',
        // 	'pluralname' => 'Pieces',
        // 	'abbreviation' => 'Pc',
        // 	'plural_abbreviation' => 'Pcs',
        // 	'conversion_rate' => 1,
        // 	'base_unit' => true,
        // 	'unittype_id' => 1
        // ]);

        // Unit::create([
        // 	'name' => 'Case',
        // 	'pluralname' => 'Cases',
        // 	'abbreviation' => 'Cs',
        // 	'plural_abbreviation' => 'Cs',
        // 	'conversion_rate' => 1,
        // 	'base_unit' => true,
        // 	'unittype_id' => 2
        // ]);

        // Unit::create([
        // 	'name' => 'Case',
        // 	'pluralname' => 'Cases',
        // 	'abbreviation' => 'Cs',
        // 	'plural_abbreviation' => 'Cs',
        // 	'conversion_rate' => 8,
        // 	'base_unit' => false,
        // 	'unittype_id' => 3
        // ]);

        // Unit::create([
        // 	'name' => 'Piece',
        // 	'pluralname' => 'Pieces',
        // 	'abbreviation' => 'Pc',
        // 	'plural_abbreviation' => 'Pcs',
        // 	'conversion_rate' => 1,
        // 	'base_unit' => true,
        // 	'unittype_id' => 3
        // ]);

        // Unit::create([
        // 	'name' => 'Case',
        // 	'pluralname' => 'Cases',
        // 	'abbreviation' => 'Cs',
        // 	'plural_abbreviation' => 'Cs',
        // 	'conversion_rate' => 16,
        // 	'base_unit' => false,
        // 	'unittype_id' => 3
        // ]);

        // Unit::create([
        // 	'name' => 'Piece',
        // 	'pluralname' => 'Pieces',
        // 	'abbreviation' => 'Pc',
        // 	'plural_abbreviation' => 'Pcs',
        // 	'conversion_rate' => 1,
        // 	'base_unit' => true,
        // 	'unittype_id' => 3
        // ]);
    }
}
