<?php

use Illuminate\Database\Seeder;
use Nixzen\Models\PurchaseRequest;

class PurchaseRequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        PurchaseRequest::truncate();
=======
        //PurchaseRequest::truncate();
>>>>>>> job_order_views

		$this->makeFactoryPurchaseRequest();

    }

	public function makeFactoryPurchaseRequest()
	{
		factory(Nixzen\Models\UnitType::class, 5)
			->create()
			->each(function($ut){
				$ut->save([
					factory(Nixzen\Models\Unit::class, 3)
						->create(['unittype_id' => $ut->id])
				]);
			});

		factory(Nixzen\Models\Item::class, 100)
			->create();

		$purchaserequest = factory(Nixzen\Models\PurchaseRequest::class, 10)
				->create();

		$purchaserequest->each(function($pr) {
				$items = factory(Nixzen\Models\PurchaseRequestItem::class, 3)->create(['purchaserequisition_id' => $pr->id]);
				$pr->items()->saveMany($items);
		});

		return $purchaserequest;
	}
}
