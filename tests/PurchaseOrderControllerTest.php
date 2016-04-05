<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PurchaseOrderControllerTest extends TestCase
{
	use DatabaseMigrations;

	public $purchaseorder;

	public $poEditData;

	public function __construct()
	{
			$this->purchaseorder = new Nixzen\Models\PurchaseOrder;
	}
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->call('GET', 'purchaseorder');

		$purchaseorders = $this->getData('purchaseorders');

		$this->assertResponseOk();
		$this->assertViewHas('purchaseorders');
		$this->assertInstanceOf(
			'Illuminate\Database\Eloquent\Collection',
			$purchaseorders
		);
    }

	public function testCreate()
	{
		$this->makeFactoryPurchaseOrder();
		$this->call('GET', 'purchaseorder/create');
		$this->assertResponseOk();
	}

	public function testStore()
	{
		$this->withoutMiddleware();

		$items =
		[
			[
				'id' => '',
				'item_id'=> 1,
				'quantity'=> 2,
				'unit_id'=> 1,
				'unit_cost' => 10.00,
				'item_label' => 'bla bla bla',
				'description' => 'this is a test'
			],
			[
				'id' => '',
				'item_id'=> 2,
				'quantity'=> 2,
				'unit_id'=> 1,
				'unit_cost' => 5.50,
				'item_label' => 'bla bla bla',
				'description' => 'this is a test'
			]
		];

		$request =
		[
			'id' => 1,
			'vendor_id'	=> 1,
			'terms_id'	=> 1,
			'type_id'	=>	1,
			'date'	=> '2016-02-22',
			'paymenttype_id'	=> 1,
			'memo'	=> 'this is a test',
			'items'	=> json_encode($items)
		];

		$this->call('POST', 'purchaseorder', $request);
		$purchaseorder = $this->purchaseorder->all()->last();
		
		$this->assertPOItemsIs(2);
		$this->assertResponseStatus(302);
		$this->seeInDatabase('purchase_orders', ['vendor_id' => 1]);
		$this->assertRedirectedToRoute(
			'purchaseorder.show',
			[$purchaseorder]
		);
	}

	public function testShow()
	{
		$this->makeFactoryPurchaseOrder();

		$response = $this->call('GET', 'purchaseorder/1');

		$this->assertResponseOk();
		$this->assertViewHas('purchaseorder');
	}

	public function testEdit()
	{
		$this->makeFactoryPurchaseOrder();
		$response = $this->call('GET', 'purchaseorder/1/edit');
		$this->assertResponseOk();
		$this->assertViewHas('purchaseorder');
	}

	public function testUpdate()
	{
		$this->withoutMiddleware();

		$items =
		[
			[
				'id' => '1',
				'item_id'=> '1',
				'quantity'=> '2',
				'unit_id'=> '1',
				'unit_cost' => '10.00',
				'item_label' => 'bla bla bla',
				'description' => 'this is a test'
			],
			[
				'id' => '',
				'item_id'=> '2',
				'quantity'=> '2',
				'unit_id'=> '1',
				'unit_cost' => '5.50',
				'item_label' => 'bla bla bla',
				'description' => 'this is a test'
			]
		];

		$request =
		[
			'id' => '1',
			'vendor_id'	=> '2',
			'terms_id'	=> '1',
			'type_id'	=>	'1',
			'date'	=> '2016-02-22',
			'paymenttype_id'	=> '1',
			'memo'	=> 'this is a test',
			'items'	=> json_encode($items)
		];

		$this->makeFactoryPurchaseOrder();
		$response = $this->call('PATCH', 'purchaseorder/1', $request);
		$count = $this->purchaseorder->find(1)->items->count();
		$this->assertEquals(2, $count);
		$this->assertResponseStatus(302);
		$this->seeInDatabase('purchase_orders', ['id' => 1, 'vendor_id' => 2]);
		$this->assertRedirectedToRoute('purchaseorder.show', [1]);
	}

	public function testDestroy()
	{
		$this->withoutMiddleware();

		$response = $this->call('DELETE', 'purchaseorder/1');
		$this->assertResponseStatus(302);
		$this->assertRedirectedToRoute('purchaseorder.index');
	}
	public function makeFactoryPurchaseOrder()
	{
		factory(Nixzen\Models\UnitType::class, 5)
			->create()
			->each(function($ut){
				$ut->save([
					factory(Nixzen\Models\Unit::class, 3)
						->create(['unittype_id' => $ut->id])
				]);
			});

		$items = factory(Nixzen\Models\Item::class, 20)->create();

		//dd($items->first()->unitType->first()->units);
		factory(Nixzen\Models\PurchaseOrder::class, 3)
			->create()
			->each(function($po) {

				$po->items()->saveMany(
					factory(Nixzen\Models\PurchaseOrderItem::class, 10)
						->create(['purchaseorder_id' => $po->id])
				);

				$po->vendor()->associate(
					factory(Nixzen\Models\Vendor::class)->create()
				);

				$po->term()->associate(
					factory(Nixzen\Models\Terms::class)->create()
				);

				$po->paymenttype()->associate(
					factory(Nixzen\Models\PaymentType::class)->create()
				);
			});
	}

	public function getData($type)
	{
		return $this->response->original->getData()[$type];
	}

	public function dumpResponse()
	{
		dd($this->original);
	}

	public function assertPOItemsIs($count)
	{
		$item_count = $this->purchaseorder->find(1)->items->count();
		return $this->assertEquals($count, $item_count);
	}
}
