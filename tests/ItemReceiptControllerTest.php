<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemReceiptControllerTest extends TestCase
{
	use DatabaseMigrations, WithoutMiddleware;

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
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $purchaseorders);
  }

	public function testCreate()
	{
		$response = $this->call('GET', 'purchaseorder/1/itemreceipt/create');
		$this->assertResponseOk();
		$this->assertViewHas('purchaseorder');
	}

	public function testStore()
	{
		$items = [
			['purchaseorderitem_id'=> 1,'quantity_received'=> 2],
			['purchaseorderitem_id'=> 2,'quantity_received'=> 2]
		];

		$request = [
			'date'	=> '2016-02-22',
			'remarks'	=> 'this is a test',
			'items'	=> json_encode($items)
		];

		$this->makeFactoryPurchaseOrder();
		//$this->expectsJobs(CreateItemReceiptCommand::class);
		$response = $this->call('POST', 'purchaseorder/1/itemreceipt', $request);
		$this->assertResponseStatus(302);

		$itemreceipt = $this->itemreceipt->all()->last();

		$this->assertRedirectedToRoute('purchaseorder.itemreceipt.show', [$itemreceipt]);
	}

	public function testShow()
	{
		$response = $this->call('GET', 'purchaseorder/1/itemreceipt/1');
		$this->assertResponseOk();
		$this->assertViewHas('itemreceipt');
	}

	public function testEdit()
	{
		$response = $this->call('GET', 'purchaseorder/1/itemreceipt/1/edit');
		$this->assertResponseOk();
		$this->assertViewHas('itemreceipt');
	}

	public function testUpdate()
	{
		$items = [
			['purchaseorderitem_id'=> 1,'quantity_received'=> 2],
			['purchaseorderitem_id'=> 2,'quantity_received'=> 2]
		];

		$request = [
			'date'	=> '2016-02-22',
			'remarks'	=> 'this is a test',
			'items'	=> json_encode($items)
		];

		$this->makeFactoryPurchaseOrder();

		$response = $this->call('PATCH', 'purchaseorder/1/itemreceipt/1', $request);
		$this->assertResponseStatus(302);
		$this->assertRedirectedToRoute('purchaseorder.itemreceipt.show', [1]);
	}

	public function testDestroy()
	{
		$response = $this->call('DELETE', 'purchaseorder/1/itemreceipt/1');
		$this->assertResponseStatus(302);
		$this->assertRedirectedToRoute('purchaseorder.itemreceipt.index');
	}

	public function makeFactoryPurchaseOrder()
	{
		factory(Nixzen\Models\PurchaseOrder::class, 3)
				->create()
				->each(function($po) {
						$po->items()->saveMany(factory(Nixzen\Models\PurchaseOrderItem::class, 3)->create(
							['purchaseorder_id' => $po->id]
					));
						$po->vendor()->associate(factory(Nixzen\Models\Vendor::class)->create());
						$po->term()->associate(factory(Nixzen\Models\Terms::class)->create());
						$po->paymenttype()->associate(factory(Nixzen\Models\PaymentType::class)->create());
						$po->itemreceipt()->saveMany(factory(Nixzen\Models\ItemReceipt::class, 2)->create(['purchaseorder_id' => $po->id]));
				});
	}
}
