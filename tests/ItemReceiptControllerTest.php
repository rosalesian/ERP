<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Nixzen\Repositories\PurchaseOrderRepository;
class ItemReceiptControllerTest extends TestCase
{
		use DatabaseMigrations, WithoutMiddleware;

		public $po;

		public function setUp()
		{
			parent::setUp();
			$this->po = $this->app->make('Nixzen\Repositories\PurchaseOrderRepository');
		}
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
				$this->po->create([
						'vendor_id'	=> 1,
						'date'	=> '2016-02-22',
						'type_id'	=> 1,
						'paymenttype_id'	=> 1,
						'terms_id'	=> 1
				]);

        $response = $this->call('GET', 'purchaseorder/1/itemreceipt');
				//dd($response->original->getData());
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
			$item = [
				['item_id'=> 1,'quantity'=> 2],
				['item_id'=> 2,'quantity'=> 2]
			];

			$request = [
				'date'	=> '2016-02-22',
				'remarks'	=> 'this is a test',
				'items'	=> json_encode($item)
			];

			$response = $this->call('POST', 'purchaseorder/1/itemreceipt');

			//$this->assertResponseStatus(302);
			//$this->assertRedirectedToRoute('purchaseorder.show', [1]);
		}
}
