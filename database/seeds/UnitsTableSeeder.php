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

        Unit::create([
        	'name' => 'Piece',
        	'pluralname' => 'Pieces',
        	'abbreviation' => 'PC',
        	'plural_abbreviation' => 'PCS',
        	'conversion_rate' => 1,
        	'base_unit' => true,
        	'unittype_id' => 1
        ]);

        Unit::create([
        	'name' => 'Case',
        	'pluralname' => 'Cases',
        	'abbreviation' => 'CS',
        	'plural_abbreviation' => 'CS',
        	'conversion_rate' => 1,
        	'base_unit' => true,
        	'unittype_id' => 2
        ]);

        Unit::create([
        	'name' => 'Case',
        	'pluralname' => 'Cases',
        	'abbreviation' => 'CS',
        	'plural_abbreviation' => 'CS',
        	'conversion_rate' => 1,
        	'base_unit' => false,
        	'unittype_id' => 3
        ]);

        Unit::create([
        	'name' => 'Piece',
        	'pluralname' => 'Pieces',
        	'abbreviation' => 'PC',
        	'plural_abbreviation' => 'PCS',
        	'conversion_rate' => 8,
        	'base_unit' => true,
        	'unittype_id' => 3
        ]);

        Unit::create([
            'name' => 'Case',
            'pluralname' => 'Cases',
            'abbreviation' => 'CS',
            'plural_abbreviation' => 'CS',
            'conversion_rate' => 1,
            'base_unit' => false,
            'unittype_id' => 4
        ]);

        Unit::create([
            'name' => 'Piece',
            'pluralname' => 'Pieces',
            'abbreviation' => 'PC',
            'plural_abbreviation' => 'PCS',
            'conversion_rate' => 16,
            'base_unit' => true,
            'unittype_id' => 4
        ]);

        Unit::create([
            'name' => 'Case',
            'pluralname' => 'Cases',
            'abbreviation' => 'CS',
            'plural_abbreviation' => 'CS',
            'conversion_rate' => 1,
            'base_unit' => false,
            'unittype_id' => 5
        ]);

        Unit::create([
            'name' => 'Piece',
            'pluralname' => 'Pieces',
            'abbreviation' => 'PC',
            'plural_abbreviation' => 'PCS',
            'conversion_rate' => 24,
            'base_unit' => true,
            'unittype_id' => 5
        ]);

        Unit::create([
            'name' => 'Case',
            'pluralname' => 'Cases',
            'abbreviation' => 'CS',
            'plural_abbreviation' => 'CS',
            'conversion_rate' => 1,
            'base_unit' => false,
            'unittype_id' => 6
        ]);

        Unit::create([
            'name' => 'Piece',
            'pluralname' => 'Pieces',
            'abbreviation' => 'PC',
            'plural_abbreviation' => 'PCS',
            'conversion_rate' => 36,
            'base_unit' => true,
            'unittype_id' => 6
        ]);

        Unit::create([
            'name' => 'Case',
            'pluralname' => 'Cases',
            'abbreviation' => 'CS',
            'plural_abbreviation' => 'CS',
            'conversion_rate' => 1,
            'base_unit' => false,
            'unittype_id' => 6
        ]);

        Unit::create([
            'name' => 'Piece',
            'pluralname' => 'Pieces',
            'abbreviation' => 'PC',
            'plural_abbreviation' => 'PCS',
            'conversion_rate' => 48,
            'base_unit' => true,
            'unittype_id' => 6
        ]);
    }
}
