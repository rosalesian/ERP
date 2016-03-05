<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Nixzen\Http\Requests\CreatePurchaseRequestRequest as Request;

class PurchaseRequestControllerTest extends TestCase
{
		use DatabaseMigrations, WithoutMiddleware;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {

      $response = $this->call('GET','purchaserequest');

			$this->assertResponseOk();

			$this->assertViewHas('purchaserequests');

			$purchaserequests = $response->original->getData()['purchaserequests'];

			$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $purchaserequests);
    }

		public function testCreate()
		{
			$this->call('GET', 'purchaserequest/create');

			$this->assertResponseOk();
		}

		public function testStore()
		{
			$item = [
				['item_id'=> 1,'quantity'=> 2, 'unit_id'=> 1],
				['item_id'=> 2,'quantity'=> 2, 'unit_id'=> 1]
			];
			$request =[
				'requestedby' => '1',
				'type'	=>	'1',
				'date'	=>	'2016-02-22',
				'remarks'	=> 'this is a test',
				'items'	=> json_encode($item)
			];

			$response = $this->call('POST', 'purchaserequest', $request);

			$this->assertResponseStatus(302);
			$this->assertRedirectedToRoute('purchaserequest.show',[1]);
		}

		public function testShow()
		{

			$response = $this->call('GET', 'purchaserequest/1');

			$this->assertResponseOk();

			$this->assertViewHas('purchaserequest');
		}

}
