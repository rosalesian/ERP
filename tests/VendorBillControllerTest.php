<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VendorBillControllerTest extends TestCase
{

	use DatabaseMigrations, WithoutMiddleware;

	private $vendorbill;

	function __construct()
	{
		$this->vendorbill = new Nixzen\Models\VendorBill;
	}

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStore()
	{
		$request = [
			'vendor_id' => 1,
			'suppliers_inv_no' => '1234', 
			'date' => date('Y/m/d'),
			'duedate' => date('Y/m/d'),
			'billtype_id' => 2, 
			'billtype_nontrade_subtype_id' => 2,
			'coa_id' => 1,
			'terms_id' => 1,
			'posting_period_id' => 1,
			'department_id' => 1,
			'division_id' => 1,
			'branch_id' => 1,
			'memo' => 'test memo'
		];

		$response = $this->call('POST', 'vendorbill', $request);
		//$this->assertResponseStatus(302);
		//$vendorbill = $this->vendorbill->all()->last();
		//$this->assertRedirectedToRoute('vendorbill.show', [$vendorbill]);
		//$this->seeInDatabase('vendor_bills', ['id' => 1]);
	}
}
