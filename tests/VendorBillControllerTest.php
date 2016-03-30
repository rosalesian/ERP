<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VendorBillControllerTest extends TestCase
{

	use DatabaseMigrations;

	public $vendorbill;

	function __construct()
	{
		$this->vendorbill = new Nixzen\Models\VendorBill;
	}

	public function testIndex()
    {
        $response = $this->call('GET', 'vendorbill');
		$this->assertResponseOk();
		$this->assertViewHas('vendorbills');
		$vendorbills = $response->original->getData()['vendorbills'];
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $vendorbills);
    }

    public function testCreate()
	{
		$this->call('GET', 'vendorbill/create');
		$this->assertResponseOk();
	}

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStore()
	{
		$this->withoutMiddleware();
		$items = [
			[
				'item_id' => 1,
				'quantity' => 2,
				'uom_id' => 2,
				'unit_cost' => 100,
				'amount' => 200,
				'taxcode_id' => 1,
				'tax_amount' => 0,
				'gross_amount' => 200
			]
		];

		$expenses = [
			[
				'coa_id' => 1,
				'amount' => 1000,
				'taxcode_id' => 1,
				'tax_amount' => 0,
				'gross_amount' => 1000,
				'department_id' => 1,
				'division_id' => 1,
				'branch_id' => 1,
				'vendor_id' => 1
			]
		];

		$request = [
			'vendor_id' => 1,
			'transno' => '001',
			'suppliers_inv_no' => '1', 
			'date' => '2016-03-29', 
			'duedate' => '2016-03-29', //date('Y/m/d')
			'billtype_id' => 2, 
			'billtype_nontrade_subtype_id' => 2,
			'coa_id' => 1,
			'terms_id' => 1,
			'posting_period_id' => 1,
			'department_id' => 1,
			'division_id' => 1,
			'branch_id' => 1,
			'memo' => 'test memo',
			'items' => json_encode($items),
			'expenses' => json_encode($expenses)
		];

		$response = $this->call('POST', 'vendorbill', $request);
		//$this->assertEquals(200, $response->getStatusCode());
		$this->assertResponseStatus(302);
		$this->seeInDatabase('vendor_bills', ['vendor_id' => 1]);
		$vendorbill = $this->vendorbill->all()->last();
		$this->assertRedirectedToRoute('vendorbill.show', [$vendorbill]);
	}

	public function testShow()
	{
		$response = $this->call('GET', 'vendorbill/1');
		$this->assertResponseOk();
		$this->assertViewHas('vendorbill');
	}

	public function testEdit()
	{
		$response = $this->call('GET', 'vendorbill/1/edit');
		$this->assertResponseOk();
		$this->assertViewHas('vendorbill');
	}

	public function testUpdate()
	{
		$this->withoutMiddleware();
		$items = [
			[
				'id' => '1',
				'item_id' => 1,
				'quantity' => 2,
				'uom_id' => 2,
				'unit_cost' => 100,
				'amount' => 200,
				'taxcode_id' => 1,
				'tax_amount' => 0,
				'gross_amount' => 200
			]
		];

		$expenses = [
			[
				'id' => '1',
				'coa_id' => 1,
				'amount' => 1000,
				'taxcode_id' => 1,
				'tax_amount' => 0,
				'gross_amount' => 1000,
				'department_id' => 1,
				'division_id' => 1,
				'branch_id' => 1,
				'vendor_id' => 1
			]
		];

		$request = [
			'vendor_id' => 2,
			'transno' => '001',
			'suppliers_inv_no' => '1', 
			'date' => '2016-03-29', 
			'duedate' => '2016-03-29', //date('Y/m/d')
			'billtype_id' => 2, 
			'billtype_nontrade_subtype_id' => 2,
			'coa_id' => 1,
			'terms_id' => 1,
			'posting_period_id' => 1,
			'department_id' => 1,
			'division_id' => 1,
			'branch_id' => 1,
			'memo' => 'test memo',
			'items' => json_encode($items),
			'expenses' => json_encode($expenses)
		];

		$this->makeFactoryVendorBill();

		$response = $this->call('PATCH', 'vendorbill/1', $request);
		$this->assertResponseStatus(302);
		$this->seeInDatabase('vendor_bills', ['id' => 1]);
		$this->assertRedirectedToRoute('vendorbill.show', [1]);
	}

	public function testDestroy()
	{
		$this->withoutMiddleware();
		$response = $this->call('DELETE', 'vendorbill/1');
		$this->assertResponseStatus(302);
		$this->assertRedirectedToRoute('vendorbill.index');
	}

	public function makeFactoryVendorBill()
	{
		factory(Nixzen\Models\VendorBill::class, 2)
			->create()
			->each(function($bill) {
				$bill->items()->saveMany(factory(Nixzen\Models\VendorBillItem::class, 2)->create(
					['vendorbill_id' => $bill->id]
				));
				$bill->expenses()->saveMany(factory(Nixzen\Models\VendorBillExpenses::class, 2)->create(
					['vendorbill_id' => $bill->id]
				));
				$bill->vendor()->associate(factory(Nixzen\Models\Vendor::class)->create());
				$bill->billtype()->associate(factory(Nixzen\Models\BillType::class)->create());
				$bill->billtypenontradesubtype()->associate(factory(Nixzen\Models\BillTypeNonTradeSubType::class)->create());
				$bill->term()->associate(factory(Nixzen\Models\Terms::class)->create());
				$bill->department()->associate(factory(Nixzen\Models\Lists\Department::class)->create());
				$bill->division()->associate(factory(Nixzen\Models\Lists\Division::class)->create());
				$bill->branch()->associate(factory(Nixzen\Models\Lists\Branch::class)->create());
			});
	}
}
