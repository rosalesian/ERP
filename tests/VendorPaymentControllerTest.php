<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VendorPaymentControllerTest extends TestCase
{
		use DatabaseMigrations, WithoutMiddleware;

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
			$request = $this->makeVendorPaymentData();
			$response = $this->call('POST', 'vendorpayment', $request);
			$vendorpayment = $this->vendorpayment->all()->last();
			$this->assertRedirectedToRoute('vendorpayment.show', [$vendorpayment]);
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
			$request = $this->makeVendorPaymentData();
			factory(Nixzen\Models\VendorPayment::class)->create();
			$response = $this->call('PATCH', 'vendorpayment/1', $request);
			$this->assertRedirectedToRoute('vendorpayment.show', [1]);
		}

		public function testDestroy()
		{
			$this->call('DELETE', 'vendorpayment/1');
			$this->assertRedirectedToRoute('vendorpayment.index');
		}

		public function makeVendorPaymentData()
		{
			$items = [
				['apply'=> true,'bill_id'=> 1],
				['apply'=> true,'bill_id'=> 2]
			];

			$request = [
				'transno' => 1,
				'coa_id' => 2,
				'payee_id' => 1,
				'date' => '1/1/2016',
				'posting_period_id' => 1,
				'checkno' => '1232',
				'checkdate' => '1/1/2016',
				'principal_id' => 1,
				'branch_id' => 3,
				'items' => json_encode($items)
			];

			return $request;
		}
}
