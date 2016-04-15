<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemReceiptControllerTest extends TestCase
{
	use DatabaseMigrations;

	public $itemreceipt;

	public function __construct()
	{
		$this->itemreceipt = new Nixzen\Models\ItemReceipt;
	}

   /**
    * A basic test example.
    *
    * @return void
    */
    public function testIndex()
    {
    	$response = $this->call('GET', 'purchaseorder/1/itemreceipt');
		$this->assertResponseOk();
		$this->assertViewHas('itemreceipts');
		$purchaseorders = $response->original->getData()['itemreceipts'];
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', 	$purchaseorders);
    }

	public function testCreate()
	{
		$po = $this->makeFactoryPurchaseOrder();

		$response = $this->call('GET', 'purchaseorder/1/itemreceipt/create');

		$this->assertResponseOk();
		$this->assertViewHas('purchaseorder');
	}

	public function testStore()
	{
		$this->withoutMiddleware();
		$items =
		[
			[
				'id' => '',
				'purchaseorderitem_id'=> '1',
				'quantity_received'=> '2'
			],
			[
				'id' => '',
				'purchaseorderitem_id'=> '2',
				'quantity_received'=> '2'
			]
		];

		$request = [
			'date'	=> '2016-02-22',
			'remarks'	=> 'this is a test',
			'items'	=> json_encode($items)
		];

		$this->makeFactoryPurchaseOrder();
		$response = $this->call('POST', 'purchaseorder/1/itemreceipt', $request);

		$this->assertResponseStatus(302);

		$itemreceipt = $this->itemreceipt->all()->last();

		$this->assertRedirectedToRoute('purchaseorder.itemreceipt.show', [$itemreceipt]);
		$this->assertEquals(2, $itemreceipt->items->count());
	}

	public function testShow()
	{
		$purchaseorders = $this->makeFactoryPurchaseOrder();
		$purchaseorders->each(function($po) {
			$po->save([
				factory(Nixzen\Models\ItemReceipt::class, 3)
					->create(['purchaseorder_id' => $po->id])
					->each(function ($ir) {
						$ir->save([
							factory(Nixzen\Models\ItemReceiptItem::class, 5)
								->create(['itemreceipt_id' => $ir->id])
						]);
					})
			]);
		});

		$response = $this->call('GET', 'purchaseorder/1/itemreceipt/1');

		$this->assertResponseOk();
		$this->assertViewHas('itemreceipt');
	}

	public function testEdit()
	{
		$purchaseorders = $this->makeFactoryPurchaseOrder();
		$purchaseorders->each(function($po) {
			$po->save([
				factory(Nixzen\Models\ItemReceipt::class, 3)
					->create(['purchaseorder_id' => $po->id])
					->each(function ($ir) {
						$ir->save([
							factory(Nixzen\Models\ItemReceiptItem::class, 5)
								->create(['itemreceipt_id' => $ir->id])
						]);
					})
			]);
		});

		$response = $this->call('GET', 'purchaseorder/1/itemreceipt/1/edit');

		$this->assertResponseOk();
		$this->assertViewHas('itemreceipt');
	}

	public function testUpdate()
	{
		$this->withoutMiddleware();

		$items =
		[
			[
				'id'=>'1',
				'purchaseorderitem_id'=> '1',
				'quantity_received'=> '2'
			],
			[
				'id'=>'',
				'purchaseorderitem_id'=> '2',
				'quantity_received'=> '2'
			]
		];

		$request = [
			'date'	=> '2016-02-22',
			'remarks'	=> 'this is a test',
			'items'	=> json_encode($items)
		];

		$purchaseorders = $this->makeFactoryPurchaseOrder();
		$purchaseorders->each(function($po) {
			$po->save([
				factory(Nixzen\Models\ItemReceipt::class, 5)
					->create(['purchaseorder_id' => $po->id])
					->each(function ($ir) {
						$ir->save([
							factory(Nixzen\Models\ItemReceiptItem::class, 5)
								->create(['itemreceipt_id' => $ir->id])
						]);
					})
			]);
		});

		$response = $this->call('PATCH', 'purchaseorder/1/itemreceipt/1', $request);

		$this->assertResponseStatus(302);		$this->assertRedirectedToRoute('purchaseorder.itemreceipt.show', [1]);

		$count = $this->itemreceipt->find(1)->items->count();
		$this->assertEquals(2, $count);
	}

	public function testDestroy()
	{
		$this->withoutMiddleware();

		$purchaseorders = $this->makeFactoryPurchaseOrder();
		$purchaseorders->each(function($po) {
			$po->save([
				factory(Nixzen\Models\ItemReceipt::class, 3)
					->create(['purchaseorder_id' => $po->id])
					->each(function ($ir) {
						$ir->save([
							factory(Nixzen\Models\ItemReceiptItem::class, 5)
								->create(['itemreceipt_id' => $ir->id])
						]);
					})
			]);
		});

		$response = $this->call('DELETE', 'purchaseorder/1/itemreceipt/1');

		$this->assertResponseStatus(302);
		$this->assertRedirectedToRoute('purchaseorder.itemreceipt.index');
	}

	public function makeFactoryPurchaseOrder()
	{
		factory(Nixzen\Models\UnitType::class, 10)
			->create()
			->each(function ($ut) {
				$ut->save([
					factory(Nixzen\Models\Unit::class, 2)
						->create(['unittype_id' => $ut->id])
				]);
			});

		factory(Nixzen\Models\Item::class, 10)->create();

		return factory(Nixzen\Models\PurchaseOrder::class, 3)
			->create()
			->each(function ($po) {
				$po->save([
					factory(Nixzen\Models\PurchaseOrderItem::class, 3)
						->create(['purchaseorder_id'=> $po->id])
				]);
			});
	}
}
