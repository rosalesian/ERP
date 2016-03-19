<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VendorControllerTest extends TestCase
{
		use DatabaseMigrations, WithoutMiddleware;

		public $vendor;

		public function __construct()
		{
			$this->vendor = new Nixzen\Models\Vendor;
		}
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
      $response = $this->call('GET', 'vendor');
			$this->assertViewHas('vendors');
			$vendors = $response->original->getData()['vendors'];
			$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $vendors);
    }

		public function testCreate()
		{
			$response = $this->call('GET', 'vendor/create');
			$this->assertResponseOk();
		}

		public function testStore()
		{
			$data = factory(Nixzen\Models\Vendor::class)->make();
			$response = $this->call('POST', 'vendor', $data->attributesToArray());
			$vendor = $this->vendor->all()->last();
			$this->assertRedirectedToRoute('vendor.show',[$vendor]);
		}

		public function testShow()
		{
			$response = $this->call('GET', 'vendor/1');
			$this->assertViewHas('vendor');
		}

		public function testEdit()
		{
			$response = $this->call('GET', 'vendor/1/edit');
			$this->assertViewHas('vendor');
		}

		public function testUpdate()
		{
			$vendor = factory(Nixzen\Models\Vendor::class)->create();
			$request = factory(Nixzen\Models\Vendor::class)->make()->attributesToArray();
			$response = $this->call('PATCH', 'vendor/'.$vendor->id, $request);
			$this->assertRedirectedToRoute('vendor.show', [$vendor->id]);
		}

		public function testDestroy()
		{
			$response = $this->call('DELETE', 'vendor/1');
			$this->assertRedirectedToRoute('vendor.index');
		}
}
