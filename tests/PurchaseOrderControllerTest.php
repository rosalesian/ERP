<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PurchaseOrderControllerTest extends TestCase
{
	use DatabaseMigrations, WithoutMiddleware;

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

		$purchaseorders = $response->original->getData()['purchaseorders'];

		$this->assertResponseOk();
		$this->assertViewHas('purchaseorders');
		$this->assertInstanceOf(
			'Illuminate\Database\Eloquent\Collection',
			$purchaseorders
		);
    }

	public function testCreate()
	{
			$this->call('GET', 'purchaseorder/create');
			$this->assertResponseOk();
	}

	public function testStore()
	{
		$items =
		[
			[
				'item_id'=> 1,
				'quantity'=> 2,
				'uom_id'=> 1,
				'unit_cost' => 10.00,
				'item_label' => 'bla bla bla',
				'description' => 'this is a test'
			],
			[
				'item_id'=> 2,
				'quantity'=> 2,
				'uom_id'=> 1,
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

		$response = $this->call('POST', 'purchaseorder', $request);
		$purchaseorder = $this->purchaseorder->all()->last();
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
		$poEditData = $response->original->getData()['purchaseorder'];
		//dd($this->response);
		$this->assertResponseOk();
		$this->assertViewHas('purchaseorder');
	}

	public function testUpdate()
	{
		$items =
		[
			[
				'id' => '1',
				'item_id'=> '1',
				'quantity'=> '2',
				'uom_id'=> '1',
				'unit_cost' => '10.00',
				'item_label' => 'bla bla bla',
				'description' => 'this is a test'
			],
			[
				'id' => '2',
				'item_id'=> '2',
				'quantity'=> '2',
				'uom_id'=> '1',
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
		//dd($response->original);
		$lineitem_count = $this->purchaseorder->find(1)->items()->get()->count();
		//dd($lineitem_count);
		$this->assertEquals(2, $lineitem_count);
		$this->assertResponseStatus(302);
		$this->seeInDatabase('purchase_orders', ['id' => 1, 'vendor_id' => 2]);
		$this->assertRedirectedToRoute('purchaseorder.show', [1]);
	}

	public function testDestroy()
	{
			$response = $this->call('DELETE', 'purchaseorder/1');
			$this->assertResponseStatus(302);
			$this->assertRedirectedToRoute('purchaseorder.index');
	}
	public function makeFactoryPurchaseOrder()
	{
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

	public function getEditData($data)
	{
		$this->data = $this->response->original->getData()[$data];

	}
}
