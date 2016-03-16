<?php

use Illuminate\Database\Seeder;
use Nixzen\Models\Item\Item;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //clear table
        Item::truncate();

        Item::create([
            'name' => 'Flat Screw Driver',
            'itemcode' => 'NT01379',
            'itemtype_id' => 3
        ]);

        Item::create([
            'name' => 'Pliers',
            'itemcode' => 'NT01380',
            'itemtype_id' => 3
        ]);

        Item::create([
            'name' => 'Star Screw',
            'itemcode' => 'NT01381',
            'itemtype_id' => 3
        ]);

        Item::create([
            'name' => 'Crimper',
            'itemcode' => 'NT01382',
            'itemtype_id' => 3
        ]);

        Item::create([
            'name' => 'Tool Box (small)',
            'itemcode' => 'NT01384',
            'itemtype_id' => 3
        ]);

        Item::create([
            'name' => 'Network Tester',
            'itemcode' => 'NT01385',
            'itemtype_id' => 3
        ]);

        Item::create([
            'name' => 'Network Cable',
            'itemcode' => 'NT01385',
            'itemtype_id' => 3
        ]);
    }
}
