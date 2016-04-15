<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VendorPaymentControllerTest extends TestCase
{
	use DatabaseMigrations;

	public $vendorpayment;

	public function __construct()
	{
		$this->vendorpayment = new Nixzen\Models\VendorPayment;
	}

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
		$response = $this->call('GET', 'vendorpayment');
		$this->assertViewHas('vendorpayments');
		$vendorpayments = $response->original->getData()['vendorpayments'];
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $vendorpayments);
    }

	public function testCreate()
	{
		$response = $this->call('GET', 'vendorpayment/create');
		$this->assertResponseOk();
	}

	public function testStore()
	{
		$this->withoutMiddleware();

		$items = [
			['id' => '', 'apply'=> true,'bill_id'=> '1'],
			['id' => '', 'apply'=> true,'bill_id'=> '2']
		];

		$request = [
			'transno' => '1',
			'coa_id' => '2',
			'payee_id' => '1',
			'date' => '1/1/2016',
			'posting_period_id' => '1',
			'checkno' => '1232',
			'checkdate' => '1/1/2016',
			'principal_id' => '1',
			'branch_id' => '3',
			'items' => json_encode($items)
		];

		$response = $this->call('POST', 'vendorpayment', $request);

		$vendorpayment = $this->vendorpayment->all()->last();

		$this->assertRedirectedToRoute('vendorpayment.show', [$vendorpayment]);
		$this->seeInDatabase('vendor_payment', ['id' => 1]);

		$count = $this->vendorpayment->find(1)->items->count();
		$this->assertEquals(2, $count);
	}

	public function testShow()
	{
		$this->call('GET', 'vendorpayment/1');
		$this->assertViewHas('vendorpayment');
	}

	public function testEdit()
	{
		$this->call('GET', 'vendorpayment/1/edit');
		$this->assertViewHas('vendorpayment');
	}

	public function testUpdate()
	{
		$this->withoutMiddleware();

		$items =
		[
			[
				'id' => '1',
				'apply'=> true,
				'bill_id'=> '1'
			],
			[
				'id' => '',
				'apply'=> true,
				'bill_id'=> '2'
			]
		];

		$request = [
			'transno' => '100100',
			'coa_id' => '2',
			'payee_id' => '1',
			'date' => '1/1/2016',
			'posting_period_id' => '1',
			'checkno' => '1-000-1-000',
			'checkdate' => '1/1/2016',
			'principal_id' => '1',
			'branch_id' => '3',
			'items' => json_encode($items)
		];


		$vendorpayment = factory(Nixzen\Models\VendorPayment::class)
							->create();

		$vendorpayment->save([
			factory(Nixzen\Models\VendorPaymentItem::class, 5)
				->create(['vendor_payment_id' => $vendorpayment->id])
		]);

		$response = $this->call('PATCH', 'vendorpayment/1', $request);

		$count = $this->vendorpayment->find(1)->items->count();

		$this->assertEquals(2, $count);
		$this->assertRedirectedToRoute('vendorpayment.show', [1]);
		$this->seeInDatabase('vendor_payment', [
			'id' => 1,
			'transno' => '100100',
			'checkno' => '1-000-1-000'
		]);
	}

	public function testDestroy()
	{
		$this->withoutMiddleware();

		$this->call('DELETE', 'vendorpayment/1');
		$this->assertRedirectedToRoute('vendorpayment.index');
		$vendorpayment = $this->vendorpayment->find(1);
		$this->assertNull($vendorpayment);
	}

	public function makeVendorPaymentData()
	{
		$items = [
			['id' => '1', 'apply'=> true,'bill_id'=> '1'],
			['id' => '', 'apply'=> true,'bill_id'=> '2']
		];

		$request = [
			'transno' => '1',
			'coa_id' => '2',
			'payee_id' => '1',
			'date' => '1/1/2016',
			'posting_period_id' => '1',
			'checkno' => '1232',
			'checkdate' => '1/1/2016',
			'principal_id' => '1',
			'branch_id' => '3',
			'items' => json_encode($items)
		];

		return $request;
	}
}
