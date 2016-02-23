<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Nixzen\Http\Requests\CreatePurchaseRequestRequest as Request;

class PurchaseRequestControllerTest extends TestCase
{
		//use DatabaseMigrations;

		public function __construct()
		{
			$this->mock = Mockery::mock('Nixzen\Repositories\PurchaseRequestRepository');
		}
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
			$this->mock->shouldReceive('all')->once()->andReturn('purchaserequest');

			$this->app->instance('Nixzen\Repositories\PurchaseRequestRepository', $this->mock);

      $response = $this->call('GET','purchaserequest');

			$this->assertResponseOk();

			$this->assertViewHas('purchaserequests');
    }

		public function testCreate()
		{
			$this->call('GET', 'purchaserequest/create');

			$this->assertResponseOk();
		}

		public function testStore()
		{
			$request = new Request;
			$request->replace([
				'requestedby' => '1',
				'type'	=>	'1',
				'date'	=>	'02/22/2016',
				'remarks'	=> 'this is a test',
				'items'	=> [
					"{'item_id': '1'}"
				];
			]);
			$prMock = Mockery::mock();

			$this->call('POST', 'purchaserequest');

			$this->assertResponseOk();

			$this->assertViewHas('purchaserequest');
		}

		public function testShow()
		{

			$this->mock->shouldReceive('find')->once()->with('1')->andReturn('purchaserequest');

			$this->app->instance('Nixzen\Repositories\PurchaseRequestRepository', $this->mock);

			$this->call('GET', 'purchaserequest/1');

			$this->assertResponseOk();

			$this->assertViewHas('purchaserequest');
		}

}
