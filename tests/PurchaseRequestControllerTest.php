<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Nixzen\Http\Requests\CreatePurchaseRequestRequest as Request;

class PurchaseRequestControllerTest extends TestCase
{
	use DatabaseMigrations;

	public function __construct()
	{
		$this->purchaserequest = new Nixzen\Models\PurchaseRequest;
	}
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
		$this->makeFactoryPurchaseRequest();
      	$response = $this->call('GET','purchaserequest');
		//$this->assertViewHas('purchaserequests');
    }

	public function testCreate()
	{
		$this->call('GET', 'purchaserequest/create');
		$this->assertResponseOk();
	}

	public function testStore()
	{
		$this->withoutMiddleware();
		$request = $this->makeInputFactory();
		$response = $this->call('POST', 'purchaserequest', $request);
		$purchaserequest = $this->purchaserequest->all()->last();
		$this->assertRedirectedToRoute('purchaserequest.show',[$purchaserequest]);
	}

	public function testShow()
	{
		$this->makeFactoryPurchaseRequest();
		$this->call('GET', 'purchaserequest/1');
		$this->assertResponseOk();
		$this->assertViewHas('purchaserequest');
	}

	public function testEdit()
	{
		$this->makeFactoryPurchaseRequest();
		$response = $this->call('GET', 'purchaserequest/1/edit');
		$this->assertResponseOk();
		$this->assertViewHas('purchaserequest');
	}

	public function testUpdate()
	{
		$this->withoutMiddleware();

		$item =
		[
			[
				'id' => '1',
				'itemcode' => '12345',
				'description' => 'Item 1',
				'item_id'=> '1',
				'quantity'=> '2',
				'unit_id'=> '1'
			],
			[
				'id' => '2',
				'itemcode' => '3456',
				'description' => 'Item 2',
				'item_id'=> '2',
				'quantity'=> '2',
				'unit_id'=> '1'
			],
			[
				'id' => '3',
				'itemcode' => '543',
				'description' => 'Item 3',
				'item_id'=> '1',
				'quantity'=> '2',
				'unit_id'=> '2'
			]
		];

		$request =[
			'requester' => '3',
			'type_id'	=>	'2',
			'date'	=>	'2016-02-22',
			'remarks'	=> 'this is a test',
			'deliver_to' => 'target',
			'items'	=> json_encode($item)
		];

		$this->makeFactoryPurchaseRequest();

		$this->call('PATCH', 'purchaserequest/1', $request);
		$this->assertRedirectedToRoute('purchaserequest.show',[1]);
		$this->seeInDatabase('purchase_requests', [
			'id' => '1',
			'deliver_to' => 'target',
			'type_id' => '2'
		]);
	}

	public function testDestroy()
	{
		$this->withoutMiddleware();
		$response = $this->call('DELETE', 'purchaserequest/1');
		$this->assertResponseStatus(302);
		$this->assertRedirectedToRoute('purchaserequest.index');
	}

	public function testApprove()
	{
		$this->withoutMiddleware();
		$this->call('POST', 'purchaserequest/1/approve');
	}

	public function testDatatable()
	{
		$this->makeFactoryPurchaseRequest();
		$this->call('GET','prtable');
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

	public function makeInputFactory()
	{
		$item =
		[
			[
				'id' => '1',
				'item_id'=> '1',
				'quantity'=> '2',
				'unit_id'=> '1'
			],
			[
				'id' => '2',
				'item_id'=> '2',
				'quantity'=> '2',
				'unit_id'=> '1'
			],
			[
				'id' => '3',
				'item_id'=> '1',
				'quantity'=> '2',
				'unit_id'=> '2'
			]
		];

		$request =[
			'requester' => '3',
			'type_id'	=>	'2',
			'date'	=>	'2016-02-22',
			'remarks'	=> 'this is a test',
			'deliver_to' => '1',
			'items'	=> json_encode($item)
		];

		return $request;
	}

	public function dumpResponse()
	{
		dd($this->response->original);
	}
}
