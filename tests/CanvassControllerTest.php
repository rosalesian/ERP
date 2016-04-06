<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CanvassControllerTest extends TestCase
{
	use DatabaseMigrations, WithoutMiddleware;

	public $canvass;

	public function __construct()
	{
		$this->canvass = new Nixzen\Models\Canvass;
	}

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
		//create mock data to database
		$pr = $this->makePurchaseRequestFactory();

		//get first line of pr
		$prItem = $pr->first()->items()->first();

		//assertion
      	$this->get('api/1.0/pritem/'. $prItem->id .'/canvass')
					->seeJson([
							'canvasses' => $prItem->canvasses->toJson()
					]);
	}

	public function testSave()
	{
		//create mock data to database
		$pr = $this->makePurchaseRequestFactory();

		$canvasses =
		[
			[
				'id' => '1',
				'vendor_id' => '1',
				'cost' => '1000.00',
				'terms_id' => '1'
			],
			[
				'id' => '',
				'vendor_id' => '3',
				'cost' => '1010.00',
				'terms_id' => '1'
			],
		];

		//mock input data
		$data = ['canvasses' => json_encode($canvasses)];
		//get first item from pr
		$prItem = $pr->first()->items()->first();
		//assertion
		$this->post('api/1.0/pritem/1/canvass', $data)
				->seeJson([
					'message' => 'canvass was created'
				])
				->seeInDatabase('canvasses', [
					'vendor_id' => 1, 'cost'=> '1000.00'
				]);

		$this->assertEquals(2, $prItem->canvasses->count());
	}

	public function makePurchaseRequestFactory()
	{
		factory(Nixzen\Models\Vendor::class, 50)->create();
		factory(Nixzen\Models\Terms::class, 3)->create();

		$pr = factory(Nixzen\Models\PurchaseRequest::class, 3)
				->create()
				->each(function($pr){
						$item = factory(Nixzen\Models\PurchaseRequestItem::class, 10)
						->create(['purchaserequisition_id' => $pr->id])
						->each(function($prItem){
							$canvasses = factory(Nixzen\Models\Canvass::class, 3)->create(['purchaserequestitem_id' => $prItem->id]);
							$prItem->save([$canvasses]);
						});
						$pr->save([$item]);
				});

		return $pr;
	}
}
