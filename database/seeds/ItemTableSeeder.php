<?php

use Illuminate\Database\Seeder;
use Nixzen\Models\Item;

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
        
        $faker = Faker\Factory::create();

        // foreach(range(1,300) as $index) {
        //     Item::create([
        //         'description' => $faker->name,
        //         'itemcode' => $faker->phoneNumber,
        //         'itemtype_id' => 3,
        //         'unittype_id' =>3
        //     ]);
        // }

        Item::create([
            'description' => "EPSON L800 LIGHT CYAN INK LCT6735",
            'itemcode' => "NT01427",
            'itemtype_id' => 3,
            'unittype_id' =>rand(1,7)
        ]);
        Item::create([
            'description' => "PLATE LIGHT ASSY",
            'itemcode' => "NT1157",
            'itemtype_id' => 3,
            'unittype_id' =>rand(1,7)
        ]);
        Item::create([
            'description' => "PRIMARY CLUTCH MASTER ASSYMBLE #7/8",
            'itemcode' => "NT1168",
            'itemtype_id' => 3,
            'unittype_id' =>rand(1,7)
        ]);
        Item::create([
            'description' => "PROPELLER BOLT",
            'itemcode' => "NT1171",
            'itemtype_id' => 3,
            'unittype_id' =>rand(1,7)
        ]);
        Item::create([
            'description' => "RADIATOR ASSY EVERCOOL (MITS. 4D30)",
            'itemcode' => "NT1183",
            'itemtype_id' => 3,
            'unittype_id' =>rand(1,7)
        ]);
        Item::create([
            'description' => "REAR BRAKE FLEXIBLE HOSE",
            'itemcode' => "NT1189",
            'itemtype_id' => 3,
            'unittype_id' =>rand(1,7)
        ]);
        Item::create([
            'description' => "RECAPPED TIRES 825X20",
            'itemcode' => "NT1198",
            'itemtype_id' => 3,
            'unittype_id' =>rand(1,7)
        ]);
        Item::create([
            'description' => "U.Y CONNECTOR 100PCS",
            'itemcode' => "NT120",
            'itemtype_id' => 3,
            'unittype_id' =>rand(1,7)
        ]);
        Item::create([
            'description' => "SPARK PLUG WRENCH",
            'itemcode' => "NT1247",
            'itemtype_id' => 3,
            'unittype_id' =>rand(1,7)
        ]);
        Item::create([
            'description' => "SPECIAL CEMENT BL 350G/ 250ML",
            'itemcode' => "NT1248",
            'itemtype_id' => 3,
            'unittype_id' =>rand(1,7)
        ]);

    }
}
