<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PurchaseOrderControllerTest extends TestCase
{
		use DatabaseMigrations, WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->call('GET', 'purchaseorder');
				$this->assertResponseOk();
				$this->assertViewHas('purchaseorders');
				$purchaseorders = $response->original->getData()['purchaseorders'];
				$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $purchaseorders);
    }

		public function testCreate()
		{
				$this->call('GET', 'purchaseorder/create');
				$this->assertResponseOk();
		}

		public function testStore()
		{
			$item = [
				['item_id'=> 1,'quantity'=> 2, 'uom_id'=> 1],
				['item_id'=> 2,'quantity'=> 2, 'uom_id'=> 1]
			];

			$request = [
				'vendor'	=> 1,
				'terms'	=> 1,
				'type'	=>	1,
				'date'	=> '2016-02-22',
				'paymenttype'	=> 1,
				'remarks'	=> 'this is a test',
				'items'	=> json_encode($item)
			];

			$response = $this->call('POST', 'purchaseorder', $request);
			$this->assertResponseStatus(302);
			$this->assertRedirectedToRoute('purchaseorder.show', [1]);
		}

		public function testShow()
		{
			$response = $this->call('GET', 'purchaseorder/1');
			$this->assertResponseOk();
			$this->assertViewHas('purchaseorder');
		}

}
